/* MAP
 * Features:
 * - Mode resolution + html classes: getFoleoNavState(), toggles foleo-binder/foleo-standalone.
 * - VNAV build + active tracking: buildFoleoVnav(), setInitialFoleoVnavActive(), initFoleoVnavActiveTracking().
 * - Switcher (binder pill): buildFoleoSwitcher(), localStorage open state handlers.
 * - Cinema mode (video play/pause nav fade): initFoleoCinemaModeAllVideos() + helpers.
 * - Popup relocation/layering: relocateBreakdancePopup() (move popup root to body).
 * - Misc: cookie banner target handling, CF card hover/playing states, Cloudflare Stream SDK, Vidstack replacement.
 *
 * Event listeners:
 * - document.addEventListener: pointerdown (cinema intent), play/pause/ended (cinema), DOMContentLoaded (cookie links + nav init + popup relocate + CF SDK + Vidstack), pointerdown/pointerout (card hover), click/keydown (switcher), hashchange (vnav).
 * - window.addEventListener: scroll (cinema scroll pause), load (initial vnav active), scroll (player out-of-view pause).
 *
 * Timers:
 * - setTimeout: vnav build retries (300/900, 250/1000), switcher build retry (250), vnav active tracking (0/500), initial vnav active (250), vidstack applyNoCast/tryPlay retries.
 * - setInterval: cinema safety poll (500ms).
 *
 * Observers:
 * - MutationObserver: vnav build when sections appear, vidstack iframe replacement.
 *
 * Direct style / innerHTML:
 * - style.display: vnav/switcher/hamburger visibility, iframe visibility, noCast slot display.
 * - innerHTML: vnav dots, switcher panel links.
 */
// Debug toggle: default false, enable via ?debug=1 or localStorage FOLEO_DEBUG=1.
(() => {
  if (typeof window === "undefined") return;
  if (window.FOLEO_DEBUG === true) return;
  let enabled = false;
  try {
    const params = new URLSearchParams(window.location.search || "");
    enabled = params.get("debug") === "1";
  } catch (e) {}
  if (!enabled) {
    try {
      enabled = window.localStorage?.getItem("FOLEO_DEBUG") === "1";
    } catch (e) {}
  }
  window.FOLEO_DEBUG = enabled;
})();

if (typeof window !== "undefined") {
  const path = window.location?.pathname || "";
  const search = window.location?.search || "";
  const isCompiler = path.startsWith("/compiler/");
  const isBuilder = search.includes("breakdance=builder");
  const isIframe = search.includes("breakdance_iframe");
  if (isCompiler || isBuilder || isIframe) {
    console.log("[FOLEO] Body.js disabled on compiler/builder", { path, search });
    window.FOLEO_SKIP_BODY_JS = true;
  }
}

if (!window.FOLEO_SKIP_BODY_JS) {
console.log("[FOLEO] Body.js boot", {
  host: location.hostname,
  path: location.pathname,
  search: location.search
});

// to make the GDPR link to HCG site in new tab //

function getQueryParam(name) {
  try {
    return new URLSearchParams(window.location.search).get(name);
  } catch (e) {
    return null;
  }
}

const FOLEO_PROFILE_STORAGE_KEY = 'foleoProfile';
const FOLEO_SWITCH_OPEN_KEY = 'foleoSwitchOpen';
const FOLEO_DEBUG = window.FOLEO_DEBUG === true;
const FOLEO_ASSETS_BASE_URL = (() => {
  let base = window.FOLEO_ASSETS_BASE_URL;
  if (typeof base !== 'string' || !base) {
    const ns = (typeof window.FOLEO_ASSETS_NAMESPACE === 'string' && window.FOLEO_ASSETS_NAMESPACE)
      ? window.FOLEO_ASSETS_NAMESPACE
      : '';
    const host = (typeof window !== 'undefined' && window.location && window.location.hostname)
      ? window.location.hostname
      : '';
    const hostNs = host && host.includes('.') ? host.split('.')[0] : '';
    const derived = ns || (hostNs && hostNs !== 'www' ? hostNs : '');
    if (derived) {
      base = `/wp-content/assets/${derived}/`;
    }
  }
  if (typeof base !== 'string' || !base) base = '/wp-content/assets/catalyst/';
  if (!base.endsWith('/')) base += '/';
  return base;
})();
}

function loadNavRegistrySync() {
  return window.__FOLEO_NAV_REGISTRY__ || null;
}

function loadNavRegistryAsync() {
  if (window.__FOLEO_NAV_REGISTRY__) {
    return Promise.resolve(window.__FOLEO_NAV_REGISTRY__);
  }
  if (window.__FOLEO_NAV_REGISTRY_PROMISE__) {
    return window.__FOLEO_NAV_REGISTRY_PROMISE__;
  }

  const url = `${FOLEO_ASSETS_BASE_URL}nav-registry.json`;
  window.__FOLEO_NAV_REGISTRY_PROMISE__ = fetch(url, { cache: 'force-cache' })
    .then((res) => {
      if (!res.ok) throw new Error('nav-registry fetch failed');
      return res.json();
    })
    .then((registry) => {
      window.__FOLEO_NAV_REGISTRY__ = registry;
      console.log("[FOLEO] registry assigned", Object.keys(registry?.binders || {}));
      return registry;
    })
    .catch(() => null);

  return window.__FOLEO_NAV_REGISTRY_PROMISE__;
}

// Force registry fetch early when profile/binder is present.
(() => {
  try {
    const qs = new URLSearchParams(window.location.search || "");
    if (qs.get("profile") || qs.get("binder")) {
      loadNavRegistryAsync().then((data) => {
        if (FOLEO_DEBUG) {
          console.log("[FOLEO] nav-registry preload", {
            ok: !!data,
            base: FOLEO_ASSETS_BASE_URL
          });
        }
      });
    }
  } catch (e) {
    if (FOLEO_DEBUG) {
      console.warn("[FOLEO] nav-registry preload failed", e);
    }
  }
})();

function readStoredProfile() {
  try {
    return sessionStorage.getItem(FOLEO_PROFILE_STORAGE_KEY);
  } catch (e) {
    return null;
  }
}

function writeStoredProfile(value) {
  try {
    sessionStorage.setItem(FOLEO_PROFILE_STORAGE_KEY, value);
  } catch (e) {}
}

function clearStoredProfile() {
  try {
    sessionStorage.removeItem(FOLEO_PROFILE_STORAGE_KEY);
  } catch (e) {}
}

function resolveFoleoEditMode() {
  if (typeof window === "undefined") return false;
  if (typeof window.FOLEO_EDIT_MODE === "boolean") return window.FOLEO_EDIT_MODE;
  if (window.__FOLEO_EDIT_MODE__ !== undefined) {
    window.FOLEO_EDIT_MODE = !!window.__FOLEO_EDIT_MODE__;
    return window.FOLEO_EDIT_MODE;
  }

  let isEdit = false;
  try {
    const html = document.documentElement;
    const body = document.body;
    const path = window.location.pathname || "";
    const params = new URLSearchParams(window.location.search || "");

    const isLoggedIn = (() => {
      try {
        return (
          !!(body && body.classList && body.classList.contains("logged-in")) ||
          !!document.getElementById("wpadminbar")
        );
      } catch (e) {
        return false;
      }
    })();

    const hasBreakdanceClass =
      html.classList.contains("breakdance") ||
      (body && body.classList.contains("breakdance"));

    const hasBreakdanceQuery =
      params.has("breakdance") ||
      params.has("bdbuilder") ||
      params.has("breakdance_iframe");

    const isCxPath = /^\/cx(\/|$)/.test(path);
    const isForcedEdit =
      params.get("foleo_edit") === "1" || params.get("foleo_edit") === "true";

    const isEditorSession =
      (hasBreakdanceClass && isLoggedIn) ||
      ((hasBreakdanceQuery || isCxPath) && isLoggedIn);

    isEdit = isEditorSession || isForcedEdit;
  } catch (e) {
    isEdit = false;
  }

  window.FOLEO_EDIT_MODE = isEdit;
  window.__FOLEO_EDIT_MODE__ = isEdit;
  return isEdit;
}

function applyFoleoProfileLabels() {
  try {
    const params = new URLSearchParams(window.location.search || '');
    const profileParam = params.get('profile') || readStoredProfile();
    if (!profileParam) return;

    const key = String(profileParam).toLowerCase();
    const labelMap = { tim: 'Tim', alison: 'Alison' };
    const label = labelMap[key];
    if (!label) return;

    document.querySelectorAll('[data-foleo-profile-name]').forEach((el) => {
      el.textContent = label;
    });
  } catch (e) {}
}

function initFoleoVideoOverlay() {
  const hero = document.querySelector(".foleo-snap-hero");
  if (!hero) return;

  const isMobile = () => window.matchMedia("(max-width: 768px)").matches;
  if (!isMobile()) return;
  hero.querySelectorAll(".cf-stream-placeholder").forEach((placeholder) => {
    placeholder.dataset.foleoOverlayOnly = "1";
    placeholder.style.pointerEvents = "auto";
    const spinner = placeholder.querySelector(".cf-stream-spinner");
    if (spinner) spinner.remove();
  });
  let overlay = document.querySelector(".foleo-video-overlay");
  if (!overlay) {
    overlay = document.createElement("div");
    overlay.className = "foleo-video-overlay";
    overlay.innerHTML =
      '<button class="foleo-video-overlay__close" type="button" aria-label="Close">×</button>' +
      '<button class="foleo-video-overlay__tapplay" type="button" aria-label="Tap to play">▶</button>' +
      '<div class="foleo-video-overlay__content"></div>';
    document.body.appendChild(overlay);
  }

  const overlayContent = overlay.querySelector(".foleo-video-overlay__content");
  const closeBtn = overlay.querySelector(".foleo-video-overlay__close");
  const tapBtn = overlay.querySelector(".foleo-video-overlay__tapplay");
  const state = { activeWrap: null, restore: null, iframe: null, video: null };

  const closeOverlay = () => {
    if (state.restore) state.restore();
    state.activeWrap = null;
    state.restore = null;
    if (state.iframe) {
      state.iframe.remove();
      state.iframe = null;
    }
    if (state.video) {
      try { state.video.pause(); } catch (e) {}
      state.video.remove();
      state.video = null;
    }
    overlay.classList.remove("is-open");
    document.documentElement.classList.remove("foleo-video-overlay-open");
    document.body.classList.remove("foleo-video-overlay-open");
  };

  closeBtn?.addEventListener("click", closeOverlay);
  tapBtn?.addEventListener("click", () => {
    const iframe = state.iframe;
    if (iframe) {
      try { iframe.contentWindow?.focus?.(); } catch (e) {}
    }
  });
  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) closeOverlay();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && overlay.classList.contains("is-open")) {
      closeOverlay();
    }
  });

  window.FoleoOpenVideoFullscreen = (wrap) => {
    if (!wrap || !isMobile()) return;
    if (state.activeWrap && state.activeWrap !== wrap && state.restore) {
      state.restore();
    }
    const parent = wrap.parentElement;
    const next = wrap.nextSibling;
    state.activeWrap = wrap;
    state.restore = () => {
      wrap.classList.remove("foleo-video-fullscreen");
      if (!parent) return;
      if (next && next.parentElement === parent) {
        parent.insertBefore(wrap, next);
      } else {
        parent.appendChild(wrap);
      }
    };

    wrap.classList.add("foleo-video-fullscreen");
    if (overlayContent) overlayContent.appendChild(wrap);
    overlay.classList.add("is-open");
    if (tapBtn) tapBtn.hidden = false;
    document.documentElement.classList.add("foleo-video-overlay-open");
    document.body.classList.add("foleo-video-overlay-open");
  };

  hero.addEventListener("click", (e) => {
    const placeholder = e.target?.closest?.(".cf-stream-placeholder");
    if (!placeholder || !isMobile()) return;
    const customer = placeholder.getAttribute("data-foleo-customer");
    const videoId = placeholder.getAttribute("data-foleo-video-id");
    const poster = placeholder.getAttribute("data-poster");
    if (!customer || !videoId) return;
    e.preventDefault();
    e.stopPropagation();

    if (state.iframe) {
      state.iframe.remove();
      state.iframe = null;
    }

    const manifest = `https://${customer}/${videoId}/manifest/video.m3u8`;
    const video = document.createElement("video");
    video.className = "foleo-video-overlay__video";
    video.src = manifest;
    video.autoplay = false;
    video.muted = false;
    video.playsInline = true;
    video.setAttribute("playsinline", "");
    video.setAttribute("webkit-playsinline", "");
    video.controls = false;
    if (poster) video.poster = poster;
    overlayContent?.appendChild(video);
    state.video = video;

    if (tapBtn) {
      tapBtn.hidden = true;
      tapBtn.onclick = null;
    }

    overlay.classList.add("is-open");
    document.documentElement.classList.add("foleo-video-overlay-open");
    document.body.classList.add("foleo-video-overlay-open");

    try { video.play(); } catch (e) {}
  });
}

resolveFoleoEditMode();

function initFoleoAccordionMobile() {
  if (!window.matchMedia || !window.matchMedia("(max-width: 768px)").matches) return;
  const blocks = Array.from(document.querySelectorAll(".foleo-accordion-block"));
  if (!blocks.length) return;

  blocks.forEach((block) => {
    const columns = Array.from(block.querySelectorAll(".bde-column"));
    columns.forEach((col) => {
      if (col.dataset.foleoAccordionInit === "1") return;
      const headerCandidates = Array.from(
        col.querySelectorAll("[data-foleo-accordion-title], h1, h2, h3, h4, h5, h6")
      );
      const header = headerCandidates.find((el) => {
        const text = (el.textContent || "").trim();
        return text.length > 0;
      });
      if (!header) return;
      header.classList.add("foleo-accordion__header");

      const content = document.createElement("div");
      content.className = "foleo-accordion__content";

      let node = header.nextSibling;
      while (node) {
        const next = node.nextSibling;
        content.appendChild(node);
        node = next;
      }

      col.appendChild(content);
      col.dataset.foleoAccordionInit = "1";

      const setClosed = () => {
        col.classList.remove("is-open");
        const height = content.scrollHeight;
        content.style.maxHeight = height + "px";
        if (content.animate) {
          content.animate(
            [{ maxHeight: height + "px" }, { maxHeight: "0px" }],
            { duration: 520, easing: "cubic-bezier(0.2, 0.8, 0.2, 1)" }
          );
        }
        content.style.maxHeight = "0px";
        content.style.paddingTop = "0px";
        content.style.paddingBottom = "0px";
      };

      const setOpen = () => {
        col.classList.add("is-open");
        content.style.maxHeight = "0px";
        content.style.paddingTop = "12px";
        content.style.paddingBottom = "40px";
        const height = content.scrollHeight;
        if (content.animate) {
          content.animate(
            [{ maxHeight: "0px" }, { maxHeight: height + "px" }],
            { duration: 520, easing: "cubic-bezier(0.2, 0.8, 0.2, 1)" }
          );
        }
        content.style.maxHeight = height + "px";
      };

      setClosed();

      header.addEventListener("click", (e) => {
        e.stopPropagation();
        const isOpen = col.classList.contains("is-open");
        if (isOpen) setClosed();
        else setOpen();
      });

      col.addEventListener("click", (e) => {
        if (e.target.closest(".foleo-accordion__content")) return;
        if (e.target.closest("a, button, input, textarea, select, label")) return;
        const isOpen = col.classList.contains("is-open");
        if (isOpen) setClosed();
        else setOpen();
      });

      window.addEventListener("resize", () => {
        if (col.classList.contains("is-open")) {
          content.style.maxHeight = content.scrollHeight + "px";
        }
      });
    });
  });
}

function initFoleoEditPerfLogger() {
  try {
    const params = new URLSearchParams(window.location.search || "");
    const enabled = FOLEO_DEBUG && (
      params.get("foleo_perf") === "1" || params.get("foleo_perf") === "true"
    );
    if (!enabled) return;
    if (!resolveFoleoEditMode()) return;
  } catch (e) {
    return;
  }

  if (window.__FOLEO_PERF_LOGGER__) return;
  window.__FOLEO_PERF_LOGGER__ = true;

  const state = {
    longTasks: [],
    layoutShifts: 0,
    paints: {},
    lcp: null,
    resourceSummary: null,
    mutationSummary: { added: 0, removed: 0 }
  };
  window.__FOLEO_PERF_STATE__ = state;

  const now = () => Math.round(performance.now());

  const logSummary = (label) => {
    const nav = performance.getEntriesByType("navigation")[0];
    const resources = performance.getEntriesByType("resource");
    const byType = {};
    resources.forEach((r) => {
      const t = r.initiatorType || "other";
      byType[t] = (byType[t] || 0) + 1;
    });
    state.resourceSummary = byType;

    console.groupCollapsed(
      `[foleo-perf] ${label} @ ${now()}ms`
    );
    if (nav) {
      console.log("navigation", {
        type: nav.type,
        domInteractive: Math.round(nav.domInteractive),
        domContentLoaded: Math.round(nav.domContentLoadedEventEnd),
        load: Math.round(nav.loadEventEnd)
      });
    }
    console.log("longTasks", state.longTasks.length, state.longTasks.slice(0, 5));
    console.log("layoutShifts", state.layoutShifts);
    console.log("paints", state.paints);
    console.log("lcp", state.lcp);
    console.log("resourcesByType", state.resourceSummary);
    console.log("mutations", state.mutationSummary);
    console.groupEnd();
  };

  try {
    const longObs = new PerformanceObserver((list) => {
      list.getEntries().forEach((e) => {
        state.longTasks.push({
          start: Math.round(e.startTime),
          duration: Math.round(e.duration)
        });
      });
    });
    longObs.observe({ entryTypes: ["longtask"] });
  } catch (e) {}

  try {
    const lsObs = new PerformanceObserver((list) => {
      list.getEntries().forEach((e) => {
        if (!e.hadRecentInput) {
          state.layoutShifts += e.value || 0;
        }
      });
    });
    lsObs.observe({ entryTypes: ["layout-shift"] });
  } catch (e) {}

  try {
    const paintObs = new PerformanceObserver((list) => {
      list.getEntries().forEach((e) => {
        state.paints[e.name] = Math.round(e.startTime);
      });
    });
    paintObs.observe({ entryTypes: ["paint"] });
  } catch (e) {}

  try {
    const lcpObs = new PerformanceObserver((list) => {
      const entries = list.getEntries();
      const last = entries[entries.length - 1];
      if (last) {
        state.lcp = {
          start: Math.round(last.startTime),
          size: last.size || null
        };
      }
    });
    lcpObs.observe({ entryTypes: ["largest-contentful-paint"] });
  } catch (e) {}

  try {
    const mutObs = new MutationObserver((mutations) => {
      mutations.forEach((m) => {
        state.mutationSummary.added += m.addedNodes ? m.addedNodes.length : 0;
        state.mutationSummary.removed += m.removedNodes ? m.removedNodes.length : 0;
      });
    });
    mutObs.observe(document.documentElement || document.body, {
      childList: true,
      subtree: true
    });
  } catch (e) {}

  document.addEventListener(
    "DOMContentLoaded",
    () => logSummary("DOMContentLoaded"),
    { once: true }
  );
  window.addEventListener("load", () => logSummary("load"), { once: true });
  setTimeout(() => logSummary("t+3000"), 3000);
  setTimeout(() => logSummary("t+8000"), 8000);
}

initFoleoEditPerfLogger();

const FOLEO_SVG_PATH = '/wp-content/uploads/foleo/svg/';

function scheduleOnce(fn, delays) {
  if (!Array.isArray(delays)) return;
  delays.forEach((delay) => setTimeout(fn, delay));
}

/* ===============================
   FOLEO Responsive Breakpoints v1
   =============================== */

const FOLEO_BP = {
  mobilePortraitMax: 479,
  mobileLandscapeMax: 767,
  tabletPortraitMax: 1023,
  tabletLandscapeMax: 1119
};

function getFoleoTier() {
  const w = window.innerWidth;
  if (w <= FOLEO_BP.mobileLandscapeMax) return 'mobile';
  if (w <= FOLEO_BP.tabletLandscapeMax) return 'tablet';
  return 'desktop';
}

function ensureGsap(cb) {
  if (window.gsap && window.ScrollTrigger) {
    cb();
    return;
  }

  const gsapScript = document.createElement("script");
  gsapScript.src = "https://unpkg.com/gsap@3.12.5/dist/gsap.min.js";
  gsapScript.onload = () => {
    const stScript = document.createElement("script");
    stScript.src = "https://unpkg.com/gsap@3.12.5/dist/ScrollTrigger.min.js";
    stScript.onload = cb;
    document.head.appendChild(stScript);
  };
  document.head.appendChild(gsapScript);
}

function initCanvasStory() {
  const section = document.querySelector(".canvas-story");
  if (!section) return;
  if (section.classList.contains("canvas-story--edit")) return;
  const mq = window.matchMedia ? window.matchMedia("(max-width: 767px)") : null;
  const applyStackedMode = (isStacked) => {
    document.documentElement.classList.toggle("foleo-canvas-story-stacked", !!isStacked);
    if (isStacked) {
      section.classList.add("canvas-story--stacked");
      const panels = Array.from(section.querySelectorAll(".canvas-story__panel"));
      panels.forEach((panel) => {
        panel.style.position = "static";
        panel.style.opacity = "1";
        panel.style.visibility = "visible";
        panel.style.pointerEvents = "auto";
        panel.style.transform = "none";
        panel.style.willChange = "auto";
        panel.style.height = "auto";
      });
      window.gsap?.set?.(panels, { clearProps: "all" });
      if (window.ScrollTrigger && typeof window.ScrollTrigger.getAll === "function") {
        window.ScrollTrigger.getAll().forEach((t) => {
          if (t?.vars?.trigger === section) t.kill();
        });
      }
    } else {
      section.classList.remove("canvas-story--stacked");
    }
  };
  if (mq && mq.matches) {
    applyStackedMode(true);
    return;
  }

  const panels = Array.from(section.querySelectorAll(".canvas-story__panel"));
  if (panels.length < 2) return;
  const dots = section.querySelector(".canvas-story__dots");
  if (dots && dots.parentElement !== section) {
    section.appendChild(dots);
  }
  if (dots) {
    dots.innerHTML = panels.map(() => `<span class="canvas-story__dot"></span>`).join("");
  }

  window.gsap.registerPlugin(window.ScrollTrigger);

  window.ScrollTrigger.getAll().forEach((t) => {
    if (t?.vars?.trigger === section) t.kill();
  });

  window.gsap.set(panels, { opacity: 1, visibility: "visible" });

  const keyPanels = panels.map((panel) => {
    const img = panel.querySelector(".canvas-panel-keyimg");
    const profile = panel.querySelector(".canvas-panel-keyprofile");
    const copy = panel.querySelector(".canvas-panel-keycopy");
    return { panel, img, profile, copy };
  });

  keyPanels.forEach(({ img, profile, copy }) => {
    if (img) window.gsap.set(img, { opacity: 0 });
    if (profile) window.gsap.set(profile, { opacity: 0 });
    if (copy) window.gsap.set(copy, { opacity: 0 });
  });

  const first = keyPanels[0];
  if (first?.img) window.gsap.set(first.img, { opacity: 1 });
  if (first?.profile) window.gsap.set(first.profile, { opacity: 1 });
  if (first?.copy) window.gsap.set(first.copy, { opacity: 1 });

  const unitsPerPanel = 0.9;
  const endPct = panels.length * 100 * unitsPerPanel;

  const tl = window.gsap.timeline({
    scrollTrigger: {
      trigger: section,
      start: "top top",
      end: "+=" + endPct + "%",
      scrub: 0.2,
      snap: {
        snapTo: "labels",
        duration: 0.2,
        ease: "power1.inOut"
      },
      pin: true,
      anticipatePin: 1
    }
  });

  if (mq && typeof mq.addEventListener === "function") {
    mq.addEventListener("change", (e) => {
      applyStackedMode(e.matches);
    });
  } else if (mq && typeof mq.addListener === "function") {
    mq.addListener((e) => {
      applyStackedMode(e.matches);
    });
  }

  if (dots) {
    const dotEls = Array.from(dots.querySelectorAll(".canvas-story__dot"));
    const totalSteps = panels.length - 1;

    window.ScrollTrigger.addEventListener("refresh", () => {
      dotEls.forEach((d, i) => d.classList.toggle("is-active", i === 0));
    });

    tl.eventCallback("onUpdate", () => {
      const progress = tl.progress();
      const idx = Math.min(totalSteps, Math.round(progress * totalSteps));
      dotEls.forEach((d, i) => d.classList.toggle("is-active", i === idx));
    });
  }

  const hold = 0.08;
  const fade = 0.05;
  const imgFade = 0.12;
  const quickFade = 0.03;

  const tweenIf = (target, vars, position) => {
    if (!target) return;
    tl.to(target, vars, position);
  };

  for (let i = 0; i < panels.length - 1; i++) {
    tl.addLabel(`panel-${i}`);
    const current = keyPanels[i] || {};
    const next = keyPanels[i + 1] || {};
    tl.to({}, { duration: hold });
    tweenIf(next.img, { opacity: 1, duration: imgFade, ease: "sine.inOut" }, ">");
    tweenIf(next.profile, { opacity: 1, duration: quickFade, ease: "none" }, "<");
    tweenIf(next.copy, { opacity: 1, duration: quickFade, ease: "none" }, "<");

    tweenIf(current.img, { opacity: 0, duration: imgFade, ease: "sine.inOut" }, ">+0.02");
    tweenIf(current.profile, { opacity: 0, duration: quickFade, ease: "none" }, "<");
    tweenIf(current.copy, { opacity: 0, duration: quickFade, ease: "none" }, "<");
    tl.to({}, { duration: hold });
  }
  tl.addLabel(`panel-${panels.length - 1}`);

  if (window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    tl.scrollTrigger.disable();
    window.gsap.set(panels, { clearProps: "all" });
    panels.forEach((p, idx) => {
      p.style.opacity = idx === 0 ? "1" : "0";
      p.style.visibility = idx === 0 ? "visible" : "hidden";
    });
  }
}

function forceCanvasStoryStackedOnMobile() {
  if (!window.matchMedia || !window.matchMedia("(max-width: 767px)").matches) return;
  const sections = document.querySelectorAll(".canvas-story");
  if (!sections.length) return;
  document.documentElement.classList.add("foleo-canvas-story-stacked");
  sections.forEach((section) => {
    section.classList.add("canvas-story--stacked");
    const panels = Array.from(section.querySelectorAll(".canvas-story__panel"));
    panels.forEach((panel) => {
      panel.style.position = "static";
      panel.style.opacity = "1";
      panel.style.visibility = "visible";
      panel.style.pointerEvents = "auto";
      panel.style.transform = "none";
      panel.style.willChange = "auto";
      panel.style.height = "auto";
    });
  });
}

function initFoleoWaitForScrollParallax() {
  const roots = document.querySelectorAll(".foleo-wait-scroll");
  if (!roots.length) return;

  const parallaxNodes = [];
  roots.forEach((root) => {
    const nodes = root.querySelectorAll("[data-parallax='true']");
    nodes.forEach((node) => {
      if (node.dataset.foleoParallaxHold === "1") return;
      node.dataset.foleoParallaxHold = "1";
      node.dataset.foleoParallaxOriginal = "true";
      node.removeAttribute("data-parallax");
      node.classList.remove("is-parallax-active");
      parallaxNodes.push(node);
    });
  });

  if (!parallaxNodes.length) return;

  const enableOnScroll = () => {
    parallaxNodes.forEach((node) => {
      if (node.dataset.foleoParallaxOriginal === "true") {
        node.setAttribute("data-parallax", "true");
      }
    });
  };

  window.addEventListener("scroll", enableOnScroll, { once: true, passive: true });
}


// Video-bug is owned by Foleo_Modules.js. Do not add new video-bug code here.

function resolveFoleoNavState() {
  const params = new URLSearchParams(window.location.search || '');
  const profileParam = params.get('profile');
  if (profileParam === 'clear') {
    clearStoredProfile();
  } else if (profileParam) {
    writeStoredProfile(profileParam);
  }

  const profileId = profileParam && profileParam !== 'clear'
    ? profileParam
    : null;

  if (profileId) {
    const registry = loadNavRegistrySync();
    const profileCfg = registry?.profiles?.[profileId];
    if (profileCfg) {
      const mode = profileCfg.mode || 'standalone';
      if (mode === 'binder') {
        const binderId = profileCfg.binder || '';
        const binderList = registry?.binders?.[binderId] || [];
        const pages = binderList
          .map((item) => {
            const href = typeof item?.href === 'string' ? item.href : '';
            const slug = href.replace(/\/+$/, '').replace(/^\//, '');
            return slug;
          })
          .filter(Boolean);

        const state = {
          mode: 'binder',
          binder: binderId,
          binderId,
          pages,
          page: window.location.pathname,
          profile: profileId
        };
        window.__FOLEO_NAV_STATE_OVERRIDE__ = state;
        return state;
      }

      const state = {
        mode: 'standalone',
        binder: null,
        page: window.location.pathname,
        profile: profileId
      };
      window.__FOLEO_NAV_STATE_OVERRIDE__ = state;
      return state;
    }
  }

  const binder = params.get('binder');
  const page = window.location.pathname;

  // Standalone is the default when binder is absent
  if (!binder) {
    return {
      mode: 'standalone',
      binder: null,
      page
    };
  }

  // Binder mode only when explicitly present
  const registry = loadNavRegistrySync();
  const resolved = resolveBinderStateFromRegistry(binder, registry, page);
  if (resolved) return resolved;
  return {
    mode: 'binder',
    binder,
    page
  };
}

function computeFoleoNavStateFromRegistry(profileId, registry) {
  const profileCfg = registry?.profiles?.[profileId];
  if (!profileCfg) return null;
  const mode = profileCfg.mode || 'standalone';
  if (mode === 'binder') {
    const binderId = profileCfg.binder || '';
    const binderList = registry?.binders?.[binderId] || [];
    const pages = binderList
      .map((item) => {
        const href = typeof item?.href === 'string' ? item.href : '';
        const slug = href.replace(/\/+$/, '').replace(/^\//, '');
        return slug;
      })
      .filter(Boolean);

    return {
      mode: 'binder',
      binder: binderId,
      binderId,
      pages,
      page: window.location.pathname,
      profile: profileId
    };
  }

  return {
    mode: 'standalone',
    binder: null,
    page: window.location.pathname,
    profile: profileId
  };
}

function resolveBinderStateFromRegistry(binderParam, registry, page) {
  if (!binderParam || !registry) return null;
  const directList = registry?.binders?.[binderParam];
  if (Array.isArray(directList) && directList.length) {
    const pages = directList
      .map((item) => {
        const href = typeof item?.href === 'string' ? item.href : '';
        const slug = href.replace(/\/+$/, '').replace(/^\//, '');
        return slug;
      })
      .filter(Boolean);
    return {
      mode: 'binder',
      binder: binderParam,
      binderId: binderParam,
      pages,
      page
    };
  }

  const profileCfg = registry?.profiles?.[binderParam];
  if (profileCfg && profileCfg.mode === 'binder') {
    const binderId = profileCfg.binder || '';
    const binderList = registry?.binders?.[binderId] || [];
    const pages = binderList
      .map((item) => {
        const href = typeof item?.href === 'string' ? item.href : '';
        const slug = href.replace(/\/+$/, '').replace(/^\//, '');
        return slug;
      })
      .filter(Boolean);
    if (pages.length) {
      return {
        mode: 'binder',
        binder: binderId,
        binderId,
        pages,
        page,
        profile: binderParam
      };
    }
  }
  return null;
}

function resolveFoleoNavStateAsync() {
  const params = new URLSearchParams(window.location.search || '');
  const profileParam = params.get('profile');
  const profileId = profileParam && profileParam !== 'clear'
    ? profileParam
    : null;
  if (!profileId) return Promise.resolve(null);
  return loadNavRegistryAsync().then((registry) => {
    if (!registry) return null;
    const state = computeFoleoNavStateFromRegistry(profileId, registry);
    if (state) {
      window.__FOLEO_NAV_STATE_OVERRIDE__ = state;
    }
    return state;
  });
}

// Export globally for debugging and other modules
window.getFoleoNavState = function () {
  return resolveFoleoNavState();
};
window.FOLEO_NAV_STATE = window.getFoleoNavState();

let foleoVnavObserverStarted = false;
let foleoVnavLockUntil = 0;
let foleoActiveVideo = null;
let foleoCinemaInitDone = false;
let foleoNavRevealTimer = null;
let foleoUserInitiated = false;

function lockFoleoVnav(ms) {
  foleoVnavLockUntil = Date.now() + ms;
}

function isFoleoVnavLocked() {
  return Date.now() < foleoVnavLockUntil;
}

function setFoleoCinemaActive(isActive) {
  document.documentElement.classList.toggle('foleo-video-playing', !!isActive);
}

function clearFoleoVideoState() {
  foleoActiveVideo = null;
  foleoUserInitiated = false;
  setFoleoCinemaActive(false);
}

function revealFoleoNavTemporarily(ms) {
  document.documentElement.classList.add('foleo-nav-reveal');
  if (foleoNavRevealTimer) clearTimeout(foleoNavRevealTimer);
  foleoNavRevealTimer = setTimeout(() => {
    document.documentElement.classList.remove('foleo-nav-reveal');
  }, ms || 900);
}

function isVideoOutOfViewBy20Percent(v) {
  if (!v) return false;
  const r = v.getBoundingClientRect();
  const vh = window.innerHeight || document.documentElement.clientHeight;
  const h = r.height || 0;
  if (!h) return false;

  const thresh = h * 0.20;
  const pastTop = r.bottom <= thresh;
  const pastBottom = r.top >= (vh - thresh);
  return pastTop || pastBottom;
}

function pauseActiveVideo() {
  if (!foleoActiveVideo) return;
  try { foleoActiveVideo.pause(); } catch (e) {}
}

function initFoleoCinemaModeAllVideos() {
  if (foleoCinemaInitDone) return;
  foleoCinemaInitDone = true;

  clearFoleoVideoState();

  function getPlayingVideos() {
    return Array.from(document.querySelectorAll('video'))
      .filter((v) => !v.paused && !v.ended);
  }

  const initialPlaying = getPlayingVideos();
  if (initialPlaying.length) {
    foleoActiveVideo = initialPlaying[0];
    foleoUserInitiated = false;
    setFoleoCinemaActive(false);
  }

  document.addEventListener('pointerdown', (e) => {
    const mp = e.target.closest('media-player, [data-media-player], .vds-video-layout');
    const v = e.target.closest('video');
    if (mp || v) {
      foleoUserInitiated = true;
    }
  }, true);

  document.addEventListener('play', (e) => {
    const v = e.target;
    if (!(v instanceof HTMLVideoElement)) return;

    foleoActiveVideo = v;
    setFoleoCinemaActive(!!foleoUserInitiated);
  }, true);

  document.addEventListener('pause', (e) => {
    const v = e.target;
    if (!(v instanceof HTMLVideoElement)) return;

    if (foleoActiveVideo === v) {
      clearFoleoVideoState();
    }
  }, true);

  document.addEventListener('ended', (e) => {
    const v = e.target;
    if (!(v instanceof HTMLVideoElement)) return;

    if (foleoActiveVideo === v) {
      clearFoleoVideoState();
    }
  }, true);

  window.addEventListener('scroll', () => {
    if (!foleoActiveVideo) return;
    if (!foleoUserInitiated) return;

    if (isVideoOutOfViewBy20Percent(foleoActiveVideo)) {
      revealFoleoNavTemporarily(900);
      pauseActiveVideo();
      clearFoleoVideoState();
    }
  }, { passive: true });

  setInterval(() => {
    const anyPlaying = getPlayingVideos().length > 0;
    if (!anyPlaying) {
      clearFoleoVideoState();
    }
  }, 500);
}

function buildFoleoVnav() {
  const state = window.getFoleoNavState?.();
  if (!state) return;
  if (state.mode !== 'binder' && state.mode !== 'standalone') return;

  const mount = document.querySelector('[data-foleo-vnav]');
  if (!mount) return;

  const sections = Array.from(document.querySelectorAll('section[id]')).filter((sec) => {
    if (!sec) return false;
    if (sec.hasAttribute('hidden')) return false;
    const style = window.getComputedStyle(sec);
    if (style.display === 'none' || style.visibility === 'hidden') return false;
    return true;
  });

  // If no meaningful sections, remove vnav entirely.
  if (!sections || sections.length < 2) {
    const vnav = document.querySelector('.foleo-vnav');
    if (vnav) {
      vnav.remove();
    }
    return;
  }

  if (!sections.length) {
    // Breakdance can render sections after DOMContentLoaded on the homepage.
    scheduleOnce(buildFoleoVnav, [300, 900]);
    return;
  }
  mount.style.display = '';

  const items = sections.map((sec) => {
    const id = sec.id.trim();
    const label = formatFoleoLabel(id);
    return { id, label };
  });

  mount.innerHTML = items
    .map((it) => {
      const labelEsc = String(it.label || it.id)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;');

      return `<a class="foleo-vnav__item" href="#${it.id}" data-label="${labelEsc}"></a>`;
    })
    .join('');

  // Re-apply active state after rerender (rebuilds wipe classes).
  const hashId = (location.hash || '').replace('#', '').trim();
  const lastId = window.__foleoActiveSectionId;

  if (hashId && document.getElementById(hashId)) {
    activateFoleoVnavDot(hashId);
  } else if (lastId && document.getElementById(lastId)) {
    activateFoleoVnavDot(lastId);
  } else {
    const first = document.querySelector('section[id]');
    if (first?.id) activateFoleoVnavDot(first.id);
  }

  if (!mount.dataset.foleoVnavClickBound) {
    mount.dataset.foleoVnavClickBound = 'true';
    mount.addEventListener('click', (e) => {
      const a = e.target.closest('.foleo-vnav__item');
      if (!a) return;

      const href = a.getAttribute('href') || '';
      const id = href.startsWith('#') ? href.slice(1) : '';
      if (!id) return;

      lockFoleoVnav(700);
      activateFoleoVnavDot(id);
    });
  }
}

function getFoleoNavMetaState() {
  if (window.__FOLEO_NAV_STATE_OVERRIDE__) return window.__FOLEO_NAV_STATE_OVERRIDE__;
  const el = document.getElementById('foleo-nav-state');
  if (!el) return null;
  try {
    return JSON.parse(el.textContent || '');
  } catch (e) {
    return null;
  }
}

function formatFoleoLabel(slug) {
  return String(slug || '')
    .replace(/[-_]+/g, ' ')
    .replace(/\b\w/g, (char) => char.toUpperCase());
}

function escapeFoleoHtml(value) {
  return String(value || '')
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;');
}

function buildFoleoSwitcher() {
  const meta = getFoleoNavMetaState();
  const state = meta && meta.mode ? meta : window.getFoleoNavState?.();
  if (!state || state.mode !== 'binder') return;

  const needsRegistry = !!(getQueryParam('profile') || getQueryParam('binder'));
  if (needsRegistry && !window.__FOLEO_NAV_REGISTRY__) return;

  const mount = document.querySelector('[data-foleo-switcher]');
  if (!mount) return;
  const root = mount.closest('.foleo-switch') || mount;
  const setFoleoSwitchOpen = (isOpen) => {
    root.classList.toggle('is-open', !!isOpen);
    document.documentElement.classList.toggle('foleo-switch-open', !!isOpen);
    try {
      window.localStorage.setItem(FOLEO_SWITCH_OPEN_KEY, isOpen ? '1' : '0');
    } catch (e) {}
  };
  try {
    if (window.localStorage.getItem(FOLEO_SWITCH_OPEN_KEY) === '1') {
      setFoleoSwitchOpen(true);
    }
  } catch (e) {}

  const binderId = state.binderId || state.binder || getQueryParam('binder');
  const pages = Array.isArray(state.pages) ? state.pages : [];
  if (!binderId || !pages.length) return;
  const profileId = state.profile || getQueryParam('profile') || readStoredProfile();
  const queryString = profileId
    ? `?profile=${encodeURIComponent(profileId)}`
    : `?binder=${encodeURIComponent(binderId)}`;

  let panel = mount.querySelector('.foleo-switch__panel');
  if (!panel) {
    panel = document.createElement('div');
    panel.className = 'foleo-switch__panel';
    mount.appendChild(panel);
  }
  if (!mount.querySelector('.foleo-switch__close')) {
    const closeBtn = document.createElement('button');
    closeBtn.className = 'foleo-switch__close';
    closeBtn.type = 'button';
    closeBtn.setAttribute('aria-label', 'Close binder navigation');
    closeBtn.innerHTML = '&times;';
    document.body.appendChild(closeBtn);
  }
  if (mount.querySelector('.foleo-switch__link')) return;
  if (!panel.dataset.foleoSwitchBound) {
    panel.dataset.foleoSwitchBound = 'true';
  }

  const pathSlug = window.location.pathname.replace(/\/+$/, '').split('/').pop() || '';
  const defaultSlug = pages[0] || '';
  const activeSlug = state.activeSlug || pathSlug || defaultSlug;

  panel.innerHTML = pages
    .map((slug) => {
      const label = escapeFoleoHtml(formatFoleoLabel(slug));
      const href = `${window.location.origin}/${slug}/${queryString}`;
      const isActive = slug === activeSlug || slug === pathSlug;
      return `<a class="foleo-switch__link${isActive ? ' is-active' : ''}" href="${href}">${label}</a>`;
    })
    .join('');
}

function activateFoleoVnavDot(activeId) {
  window.__foleoActiveSectionId = activeId;
  const items = document.querySelectorAll('.foleo-vnav__item');
  items.forEach((a) => {
    const href = a.getAttribute('href') || '';
    const id = href.startsWith('#') ? href.slice(1) : '';
    a.classList.toggle('is-active', id === activeId);
  });
}

function setInitialFoleoVnavActive() {
  const sections = Array.from(document.querySelectorAll('section[id]'));
  if (!sections.length) return;

  const hashId = (location.hash || '').replace('#', '').trim();
  if (hashId && document.getElementById(hashId)) {
    activateFoleoVnavDot(hashId);
    return;
  }

  if (window.scrollY < 40) {
    activateFoleoVnavDot(sections[0].id);
    return;
  }

  const targetY = 120;
  const tops = sections.map((sec) => ({ id: sec.id, top: sec.getBoundingClientRect().top }));

  const above = tops.filter((s) => s.top <= targetY).sort((a, b) => b.top - a.top);
  if (above.length) {
    activateFoleoVnavDot(above[0].id);
    return;
  }

  const below = tops.sort((a, b) => a.top - b.top);
  activateFoleoVnavDot(below[0].id);
}

function initFoleoVnavActiveTracking() {
  const state = window.getFoleoNavState?.();
  if (!state || state.mode !== 'binder') return;
  if (foleoVnavObserverStarted) return;
  foleoVnavObserverStarted = true;

  const sections = Array.from(document.querySelectorAll('section[id]'));
  if (!sections.length) {
    setTimeout(initFoleoVnavActiveTracking, 300);
    return;
  }

  setInitialFoleoVnavActive();

  const obs = new IntersectionObserver((entries) => {
    if (isFoleoVnavLocked()) return;
    if (window.scrollY < 40) {
      const first = document.querySelector('section[id]');
      if (first?.id) activateFoleoVnavDot(first.id);
      return;
    }

    const targetY = 120;
    const candidates = entries
      .filter((e) => e.isIntersecting && e.target && e.target.id)
      .map((e) => ({ id: e.target.id, top: e.target.getBoundingClientRect().top }));

    if (!candidates.length) return;

    const above = candidates
      .filter((c) => c.top <= targetY)
      .sort((a, b) => b.top - a.top);
    if (above.length) {
      activateFoleoVnavDot(above[0].id);
      return;
    }

    const below = candidates.sort((a, b) => a.top - b.top);
    activateFoleoVnavDot(below[0].id);
  }, {
    root: null,
    rootMargin: '-10% 0px -70% 0px',
    threshold: [0, 0.1, 0.2, 0.3]
  });

  sections.forEach((sec) => obs.observe(sec));

  window.addEventListener('hashchange', () => {
    setInitialFoleoVnavActive();
  });
}

function initFoleoTrayBottom() {
  if (window.__foleoTrayBottomInit) return;
  const trayOpen = document.querySelector('.foleo-tray-bot.tray-open');
  const trayClosed = document.querySelector('.foleo-tray-bot.tray-closed');
  if (!trayOpen || !trayClosed) {
    setTimeout(initFoleoTrayBottom, 300);
    setTimeout(initFoleoTrayBottom, 1000);
    const obs = new MutationObserver(() => {
      const hasOpen = document.querySelector('.foleo-tray-bot.tray-open');
      const hasClosed = document.querySelector('.foleo-tray-bot.tray-closed');
      if (hasOpen && hasClosed) {
        obs.disconnect();
        initFoleoTrayBottom();
      }
    });
    obs.observe(document.body, { childList: true, subtree: true });
    return;
  }
  window.__foleoTrayBottomInit = true;

  const portalTray = (tray) => {
    if (!tray || tray.parentElement === document.body) return;
    document.body.appendChild(tray);
    tray.classList.add('foleo-tray-portal');
  };

  portalTray(trayOpen);
  portalTray(trayClosed);
  document.documentElement.classList.add('foleo-tray-present');

  const prefersReduced =
    window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const isMobile = () =>
    window.matchMedia && window.matchMedia("(max-width: 767px)").matches;
  const setMobileScrollLock = (locked) => {
    if (!isMobile()) return;
    const html = document.documentElement;
    const body = document.body;
    if (locked) {
      html.classList.add("drawer-scroll-locked");
      body.classList.add("drawer-scroll-locked");
    } else {
      html.classList.remove("drawer-scroll-locked");
      body.classList.remove("drawer-scroll-locked");
    }
  };

  const findToggle = (root, kind) => {
    return (
      root.querySelector(`.data-foleo-tray-toggle-${kind}`) ||
      root.querySelector(`.data-foleo-tray-toggle`) ||
      root.querySelector('.bde-icon')
    );
  };

  const openToggle = findToggle(trayClosed, "open");
  const closeToggle = findToggle(trayOpen, "close");

  const updateBodyOffset = () => {
    const isOpen = trayOpen.classList.contains('is-open');
    const openH = trayOpen.offsetHeight || 0;
    const closedH = trayClosed.offsetHeight || 0;
    if (FOLEO_DEBUG) {
      console.log('[foleo-tray] updateBodyOffset', {
        isOpen,
        height: openH,
        scrollTop: trayOpen.scrollTop,
        scrollHeight: trayOpen.scrollHeight
      });
    }
    document.documentElement.style.setProperty('--foleo-tray-closed-height', `${closedH}px`);
    if (!isOpen || openH === 0) {
      document.documentElement.classList.remove('foleo-tray-opened');
      document.documentElement.style.setProperty('--foleo-tray-open-height', '0px');
      document.documentElement.style.setProperty('--foleo-tray-safe-height', `${closedH}px`);
      return;
    }
    document.documentElement.style.setProperty('--foleo-tray-open-height', `${openH}px`);
    document.documentElement.style.setProperty('--foleo-tray-safe-height', `${openH}px`);
    document.documentElement.classList.add('foleo-tray-opened');
  };

  const forceBodyOffset = () => {
    if (!trayOpen.classList.contains('is-open')) return;
    const h = trayOpen.offsetHeight || 0;
    if (h === 0) return;
    document.documentElement.style.setProperty('--foleo-tray-open-height', `${h}px`);
    document.documentElement.style.setProperty('--foleo-tray-safe-height', `${h}px`);
    document.documentElement.classList.add('foleo-tray-opened');
  };

  let offsetSyncTimer = null;
  const scheduleOffsetSync = () => {
    if (offsetSyncTimer) {
      clearInterval(offsetSyncTimer);
      offsetSyncTimer = null;
    }
    let ticks = 0;
    offsetSyncTimer = setInterval(() => {
      ticks += 1;
      updateBodyOffset();
      if (ticks >= 12) {
        clearInterval(offsetSyncTimer);
        offsetSyncTimer = null;
      }
    }, 100);
  };

  const setExpanded = (isOpen) => {
    if (isOpen) {
      trayOpen.classList.remove('is-hidden');
      trayClosed.classList.add('is-hidden');
      trayClosed.classList.remove('is-visible');
      window.requestAnimationFrame(() => {
        trayOpen.classList.add('is-open');
        trayOpen.scrollTop = 0;
        if (FOLEO_DEBUG) console.log('[foleo-tray] opened');
        window.requestAnimationFrame(updateBodyOffset);
        scheduleOffsetSync();
        setTimeout(forceBodyOffset, 320);
        setMobileScrollLock(true);
      });
      return;
    }

    trayOpen.classList.remove('is-open');
    if (FOLEO_DEBUG) console.log('[foleo-tray] closed');
    setTimeout(() => {
      trayOpen.classList.add('is-hidden');
    }, 280);
    trayClosed.classList.remove('is-hidden');
    updateBodyOffset();
    setMobileScrollLock(false);
    if (prefersReduced) {
      trayClosed.classList.add('is-visible');
    } else {
      setTimeout(() => trayClosed.classList.add('is-visible'), 140);
    }
    scheduleOffsetSync();
    setTimeout(forceBodyOffset, 360);
  };

  const handleToggle = (isOpen) => (e) => {
    if (e && e.type === "keydown") {
      if (e.key !== "Enter" && e.key !== " ") return;
    }
    e?.preventDefault?.();
    setExpanded(isOpen);
  };

  if (openToggle) {
    openToggle.addEventListener("click", handleToggle(true));
    openToggle.addEventListener("keydown", handleToggle(true));
  }

  if (closeToggle) {
    closeToggle.addEventListener("click", handleToggle(false));
    closeToggle.addEventListener("keydown", handleToggle(false));
  }

  trayClosed.addEventListener("click", (e) => {
    const link = e.target.closest("a");
    if (link) return;
    setExpanded(true);
  });

  trayOpen.addEventListener("click", (e) => {
    const link = e.target.closest("a");
    if (link) return;
    setExpanded(false);
  });

  trayOpen.classList.add('is-hidden');
  trayOpen.classList.remove('is-open');
  trayClosed.classList.remove('is-hidden');
  trayClosed.classList.remove('is-visible');
  if (prefersReduced) {
    trayClosed.classList.add('is-visible');
  } else {
    setTimeout(() => trayClosed.classList.add('is-visible'), 500);
  }

  updateBodyOffset();

  let openedByScroll = false;
  let ticking = false;
  const maybeOpenAtBottom = () => {
    if (openedByScroll) return;
    const doc = document.documentElement;
    const scrollY = window.scrollY || window.pageYOffset || 0;
    const threshold = 24;
    if (window.innerHeight + scrollY >= doc.scrollHeight - threshold) {
      openedByScroll = true;
      setExpanded(true);
    }
  };

  const onScroll = () => {
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(() => {
      ticking = false;
      maybeOpenAtBottom();
      updateBodyOffset();
    });
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('load', maybeOpenAtBottom, { once: true });
  setTimeout(maybeOpenAtBottom, 250);
  trayOpen.addEventListener('scroll', () => {
    if (!FOLEO_DEBUG) return;
    console.log('[foleo-tray] tray scroll', {
      scrollTop: trayOpen.scrollTop,
      scrollHeight: trayOpen.scrollHeight,
      clientHeight: trayOpen.clientHeight
    });
  }, { passive: true });
  window.addEventListener('resize', () => {
    updateBodyOffset();
  });
}

function foleoGetBodyJsSrc() {
  const cs = document.currentScript && document.currentScript.src ? document.currentScript.src : '';
  if (cs && cs.includes('Body.js')) return cs;

  const scripts = Array.from(document.scripts || []);
  const match = scripts.find((s) => (s.src || '').includes('/Body.js'));
  return match ? match.src : '';
}

function foleoBuildCompileUrls() {
  const bodySrc = foleoGetBodyJsSrc();
  if (!bodySrc) return null;

  const url = new URL(bodySrc, location.href);
  const ver = url.search || '';

  url.search = '';
  const base = url.href.replace(/Body\.js$/, '');

  return {
    css: base + 'Compile.css' + ver,
    js: base + 'Compile.js' + ver
  };
}

function maybeLoadCompileAssets() {
  let isCompile = false;
  try {
    isCompile = new URLSearchParams(location.search).get('compile') === '1';
  } catch (e) {
    return;
  }
  if (!isCompile) return;

  const urls = foleoBuildCompileUrls();
  if (!urls) return;
  const compileBust = `compilev=${Date.now()}`;
  const withCompileBust = (value) => {
    if (!value) return value;
    return value.includes('?') ? `${value}&${compileBust}` : `${value}?${compileBust}`;
  };
  urls.css = withCompileBust(urls.css);
  urls.js = withCompileBust(urls.js);

  let isFresh = false;
  try {
    isFresh = new URLSearchParams(location.search).get('fresh') === '1';
  } catch (e) {}
  if (isFresh) {
    const cb = `cb=${Date.now()}`;
    const withFresh = (value) => {
      if (!value) return value;
      return value.includes('?') ? `${value}&${cb}` : `${value}?${cb}`;
    };
    urls.css = withFresh(urls.css);
    urls.js = withFresh(urls.js);
  }

  if (!document.getElementById('foleo-compile-css')) {
    const link = document.createElement('link');
    link.id = 'foleo-compile-css';
    link.rel = 'stylesheet';
    link.href = urls.css;
    link.onload = () => console.log('[compile] css loaded', link.href);
    link.onerror = () => console.warn('[compile] css failed', link.href);
    (document.head || document.documentElement).appendChild(link);
  }

  if (!document.getElementById('foleo-compile-js')) {
    const script = document.createElement('script');
    script.id = 'foleo-compile-js';
    script.src = urls.js;
    script.defer = true;
    script.onload = () => console.log('[compile] js loaded', script.src);
    script.onerror = () => console.warn('[compile] js failed', script.src);
    (document.head || document.body || document.documentElement).appendChild(script);
  }
}

maybeLoadCompileAssets();

document.addEventListener('DOMContentLoaded', () => {
  const isEditMode = resolveFoleoEditMode();
  const safeIsEditMode = (typeof isEditMode !== "undefined" && !!isEditMode);
  if (!safeIsEditMode) {
    document.querySelectorAll('.canvas-story--edit').forEach((el) => {
      el.classList.remove('canvas-story--edit');
    });
  }
  if (isEditMode) {
    document.documentElement.classList.add('foleo-edit');
  } else {
    if (document.querySelector(".canvas-story")) {
      forceCanvasStoryStackedOnMobile();
      ensureGsap(initCanvasStory);
    }
    if (document.querySelector(".foleo-accordion-block")) {
      initFoleoAccordionMobile();
    }
    if (document.querySelector("[data-parallax]")) {
      initFoleoWaitForScrollParallax();
    }
    if (document.querySelector(".foleo-tray-bot")) {
      initFoleoTrayBottom();
    }
    applyFoleoProfileLabels();
    initFoleoVideoOverlay();
    document
      .querySelectorAll(
        '.cmplz-cookiebanner a[href], .cmplz-cookiebanner a.cmplz-document'
      )
      .forEach(function (link) {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
      });
  }

  if (!safeIsEditMode) {
    const isMobile = window.matchMedia && window.matchMedia("(max-width: 768px)").matches;
    if (isMobile && document.querySelector(".foleo-snap-hero")) {
      document.querySelectorAll(".foleo-snap-hero .cf-name-panel").forEach((el) => {
        el.removeAttribute("data-parallax");
        el.style.transform = "none";
      });
    }
    const state = window.getFoleoNavState?.();
    const switcher = document.querySelector('[data-foleo-switcher]');
    if (state) {
      document.documentElement.classList.toggle('foleo-binder', state.mode === 'binder');
      document.documentElement.classList.toggle('foleo-standalone', state.mode === 'standalone');
      document.documentElement.classList.remove('foleo-nav-reveal');

      if (state.mode === 'standalone') {
        if (switcher) switcher.style.display = 'none';
        const hamburger = document.querySelector('.hamburger');
        if (hamburger) hamburger.style.display = 'none';
      } else {
        bindFoleoSwitcherDelegatedHandlers();
        const hamburger = document.querySelector('.hamburger');
        if (hamburger) hamburger.style.display = '';
        if (switcher) switcher.style.display = '';
        if (switcher) buildFoleoSwitcher();
        setTimeout(buildFoleoSwitcher, 250);
        scheduleOnce(initFoleoVnavActiveTracking, [0, 500]);
      }

      buildFoleoVnav();
      scheduleOnce(buildFoleoVnav, [250, 1000]);
      setInitialFoleoVnavActive();
      scheduleOnce(setInitialFoleoVnavActive, [250]);
      window.addEventListener('load', setInitialFoleoVnavActive, { once: true });
    }

    resolveFoleoNavStateAsync().then((asyncState) => {
      if (!asyncState) return;
      const switcherEl = document.querySelector('[data-foleo-switcher]');
      document.documentElement.classList.toggle('foleo-binder', asyncState.mode === 'binder');
      document.documentElement.classList.toggle('foleo-standalone', asyncState.mode === 'standalone');
      document.documentElement.classList.remove('foleo-nav-reveal');

      if (asyncState.mode === 'standalone') {
        if (switcherEl) switcherEl.style.display = 'none';
        const hamburger = document.querySelector('.hamburger');
        if (hamburger) hamburger.style.display = 'none';
      } else {
        bindFoleoSwitcherDelegatedHandlers();
        const hamburger = document.querySelector('.hamburger');
        if (hamburger) hamburger.style.display = '';
        if (switcherEl) switcherEl.style.display = '';
        if (switcherEl) buildFoleoSwitcher();
        setTimeout(buildFoleoSwitcher, 250);
        scheduleOnce(initFoleoVnavActiveTracking, [0, 500]);
      }

      buildFoleoVnav();
      scheduleOnce(buildFoleoVnav, [250, 1000]);
      setInitialFoleoVnavActive();
      scheduleOnce(setInitialFoleoVnavActive, [250]);
      window.addEventListener('load', setInitialFoleoVnavActive, { once: true });
    });
  }

  if (!safeIsEditMode) {
    try {
      const qs = new URLSearchParams(window.location.search || "");
      if (qs.get("profile") || qs.get("binder")) {
        loadNavRegistryAsync().then(() => {
          const state = window.getFoleoNavState?.();
          if (state && state.mode === 'binder') {
            buildFoleoSwitcher();
            buildFoleoVnav();
            setInitialFoleoVnavActive();
          }
        });
      }
    } catch (e) {}
  }

  if (!safeIsEditMode) {
    initFoleoCinemaModeAllVideos();
    if (window.FoleoModules && typeof window.FoleoModules.init === "function") {
      window.FoleoModules.init();
      window.initFoleoModules = window.FoleoModules.init;
    }

    (() => {
      const binderState = window.getFoleoNavState?.();
      if (!binderState || binderState.mode !== 'binder') return;

      const root = document.querySelector('.foleo-switch');
      const btn = document.querySelector('.foleo-switch__btn');
      const closeBtn = document.querySelector('.foleo-switch__close');
      if (!root || !btn) return;

      const setPersistedOpen = (isOpen) => {
        try {
          window.localStorage.setItem(FOLEO_SWITCH_OPEN_KEY, isOpen ? '1' : '0');
        } catch (e) {}
      };

      try {
        if (window.localStorage.getItem(FOLEO_SWITCH_OPEN_KEY) === '1') {
          root.classList.add('is-open');
        }
      } catch (e) {}

      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        root.classList.toggle('is-open');
        setPersistedOpen(root.classList.contains('is-open'));
      });

      if (closeBtn) {
        closeBtn.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          root.classList.remove('is-open');
          setPersistedOpen(false);
        });
      }

      document.addEventListener('click', (e) => {
        if (!root.classList.contains('is-open')) return;
        if (root.contains(e.target)) return;
        root.classList.remove('is-open');
        setPersistedOpen(false);
      });

      document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        root.classList.remove('is-open');
        setPersistedOpen(false);
      });
    })();

    (() => {
      const binderState = window.getFoleoNavState?.();
      if (!binderState || binderState.mode !== 'binder') return;

      // Observe body for section[id] appearing
      const obs = new MutationObserver(() => {
        if (document.querySelector('section[id]')) {
          buildFoleoVnav();
          obs.disconnect();
        }
      });

      obs.observe(document.body, { childList: true, subtree: true });
    })();

    (function relocateBreakdancePopup() {
      const popupRoot =
        document.querySelector('.bde-popup') ||
        document.querySelector('.breakdance-popup') ||
        document.querySelector('[class*="popup"]');

      if (!popupRoot) return;

      // Move popup to body to escape stacking contexts.
      if (popupRoot.parentElement !== document.body) {
        document.body.appendChild(popupRoot);
      }
    })();

    const shouldSkipCfStream = (() => {
      try {
        const path = window.location && window.location.pathname ? window.location.pathname : "";
        const search = window.location && window.location.search ? window.location.search : "";
        const isCompiler = path.indexOf("/compiler/") === 0;
        const isBuilder = search.indexOf("breakdance=builder") !== -1;
        const isIframe = search.indexOf("breakdance_iframe") !== -1 || search.indexOf("breakdance_open_document") !== -1;
        return isCompiler || isBuilder || isIframe;
      } catch (e) {
        return false;
      }
    })();

    if (!shouldSkipCfStream) {
      const iframes = document.querySelectorAll('iframe[class*="vid"]');
      if (iframes.length) {
        const script = document.createElement("script");
        script.src = "https://embed.cloudflarestream.com/embed/sdk.latest.js";
        script.async = true;

        script.addEventListener("load", () => {
          if (typeof Stream !== "function") return;

          const players = [];

          iframes.forEach((iframe) => {
            const card = iframe.closest(".cf-card");
            if (!card) return;

            const player = Stream(iframe);
            if (!player || !player.addEventListener) return;

            players.push({ player, card });

            player.addEventListener("play", () => {
              // Pause all other videos
              players.forEach(({ player: p, card: c }) => {
                if (p !== player) {
                  try { p.pause(); } catch (e) {}
                  c.classList.remove("is-playing");
                }
              });

              card.classList.add("is-playing");
            });

            const clear = () => card.classList.remove("is-playing");
            player.addEventListener("pause", clear);
            player.addEventListener("ended", clear);
          });
        });

        document.head.appendChild(script);
      }

    function initCfStreamPlaceholders() {
      const placeholders = document.querySelectorAll(".cf-stream-placeholder");
      const hasPlaceholders = !!placeholders.length;


      const isCxPage = (() => {
        const path = (window.location && window.location.pathname) ? window.location.pathname : "";
        const clean = path.replace(/\/+$/, "");
        return clean === "" || clean === "/cx";
      })();

      const idleRun = (fn) => {
        if (typeof window.requestIdleCallback === "function") {
          window.requestIdleCallback(fn, { timeout: 2000 });
        } else {
          setTimeout(fn, 400);
        }
      };

      const iframeToPlaceholder = new WeakMap();
      const iframeMeta = new WeakMap();
      let sdkPromise = null;
      let messageListenerBound = false;

      const normalizeCustomer = (value) => {
        if (!value) return null;
        let raw = String(value).trim();
        raw = raw.replace(/^https?:\/\//i, "");
        raw = raw.replace(/\/.*$/, "");
        const subdomain = raw.replace(/\.cloudflarestream\.com$/i, "");
        if (!subdomain) return null;
        return {
          subdomain,
          origin: `https://${subdomain}.cloudflarestream.com`
        };
      };

      const isPlayingMessage = (data) => {
        if (!data) return false;
        if (typeof data === "string") {
          return /playing|play/.test(data);
        }
        if (typeof data === "object") {
          const evt = (data.event || data.type || data.state || "").toString().toLowerCase();
          return evt === "playing" || evt === "play";
        }
        return false;
      };

      const bindMessageListener = () => {
        if (messageListenerBound) return;
        messageListenerBound = true;
        window.addEventListener("message", (event) => {
          try {
            if (!event || !event.origin) return;
            const placeholder = iframeToPlaceholder.get(event.source);
            if (placeholder) {
              const meta = iframeMeta.get(placeholder.__foleoIframe) || {};
              if (meta.origin && event.origin !== meta.origin) return;
              if (isPlayingMessage(event.data)) {
                markPlaying(placeholder);
              }
              return;
            }
            const iframe = Array.from(document.querySelectorAll(".cf-stream-embed iframe"))
              .find((node) => node.contentWindow === event.source);
            if (!iframe) return;
            if (isPlayingMessage(event.data)) {
              pauseOtherStreams(iframe);
            }
          } catch (e) {}
        });
      };

      const ensureCfSdk = () => {
        if (typeof Stream === "function") return Promise.resolve();
        if (sdkPromise) return sdkPromise;
        sdkPromise = new Promise((resolve, reject) => {
          const script = document.createElement("script");
          script.src = "https://embed.cloudflarestream.com/embed/sdk.latest.js";
          script.async = true;
          script.onload = () => resolve();
          script.onerror = reject;
          document.head.appendChild(script);
        }).catch(() => {});
        return sdkPromise;
      };

      const addLinkHint = (rel, href) => {
        if (!href) return;
        const existing = document.querySelector(`link[rel="${rel}"][href="${href}"]`);
        if (existing) return;
        const link = document.createElement("link");
        link.rel = rel;
        link.href = href;
        document.head.appendChild(link);
      };

      const preconnectForCustomer = (customerInfo) => {
        if (!customerInfo || !customerInfo.origin) return;
        addLinkHint("dns-prefetch", customerInfo.origin);
        addLinkHint("preconnect", customerInfo.origin);
        addLinkHint("dns-prefetch", "https://embed.cloudflarestream.com");
        addLinkHint("preconnect", "https://embed.cloudflarestream.com");
      };

      let warmupBound = false;
      const warmupSdkOnFirstInteraction = () => {
        if (warmupBound) return;
        warmupBound = true;
        const handler = () => {
          ensureCfSdk();
          window.removeEventListener("pointerdown", handler, { passive: true });
          window.removeEventListener("touchstart", handler, { passive: true });
          window.removeEventListener("keydown", handler);
        };
        window.addEventListener("pointerdown", handler, { passive: true, once: true });
        window.addEventListener("touchstart", handler, { passive: true, once: true });
        window.addEventListener("keydown", handler, { once: true });
      };

      warmupSdkOnFirstInteraction();

      const ensureHint = (placeholder, text) => {
        if (!placeholder) return;
        if (placeholder.querySelector(".cf-stream-hint")) return;
        const spinner = placeholder.querySelector(".cf-stream-spinner");
        if (spinner) spinner.remove();
        const hint = document.createElement("div");
        hint.className = "cf-stream-hint";
        hint.textContent = text;
        hint.style.position = "absolute";
        hint.style.left = "50%";
        hint.style.bottom = "14px";
        hint.style.transform = "translateX(-50%)";
        hint.style.padding = "6px 10px";
        hint.style.borderRadius = "999px";
        hint.style.background = "rgba(0,0,0,0.6)";
        hint.style.color = "#fff";
        hint.style.fontSize = "12px";
        hint.style.lineHeight = "1";
        hint.style.pointerEvents = "none";
        hint.style.zIndex = "2";
        placeholder.appendChild(hint);
        // Let the iframe play button receive the next tap if autoplay fails.
        placeholder.style.pointerEvents = "none";
        placeholder.style.opacity = "0.35";
      };

      const applyPoster = (placeholder) => {
        if (!placeholder) return;
        if (placeholder.dataset.foleoPosterApplied === "1") return;
        const poster = readDataAttr(placeholder, "data-poster");
        if (!poster) return;
        placeholder.style.backgroundImage = `url("${poster}")`;
        placeholder.style.backgroundRepeat = "no-repeat";
        placeholder.style.backgroundSize = "cover";
        placeholder.dataset.foleoPosterApplied = "1";
      };

      const markPlaying = (placeholder) => {
        if (!placeholder) return;
        const iframe = placeholder.__foleoIframe;
        if (!iframe || !iframe.isConnected) return;
        const userInit = placeholder.dataset.foleoUserInit === "1";
        pauseOtherStreams(iframe, { initial: !userInit });
        if (placeholder.dataset.foleoState === "playing") return;
        placeholder.dataset.foleoState = "playing";
        iframe.style.opacity = "1";
        iframe.style.visibility = "visible";
        const spinner = placeholder.querySelector(".cf-stream-spinner");
        if (spinner) spinner.remove();
        placeholder.style.pointerEvents = "none";
        placeholder.style.opacity = "0";
        if (window.FoleoOpenVideoFullscreen) {
          const wrap = placeholder.closest(".cf-video-wrap");
          const isMobile = window.matchMedia && window.matchMedia("(max-width: 768px)").matches;
          const shouldFullscreen =
            isMobile &&
            !!placeholder.closest(".foleo-snap-hero, .foleo-fullscreen-on-play");
          if (wrap && shouldFullscreen) {
            window.FoleoOpenVideoFullscreen(wrap);
            const tapBtn = document.querySelector(".foleo-video-overlay__tapplay");
            if (tapBtn) tapBtn.hidden = true;
          }
        }
        setTimeout(() => {
          placeholder.remove();
        }, 220);
      };

      const tryPostMessagePlay = (iframe, origin) => {
        if (!iframe || !iframe.contentWindow) return;
        const messages = [
          { type: "play" },
          { event: "play" },
          { action: "play" },
          "play"
        ];
        messages.forEach((msg) => {
          try { iframe.contentWindow.postMessage(msg, origin); } catch (e) {}
        });
      };

      const tryPostMessagePause = (iframe, origin) => {
        if (!iframe || !iframe.contentWindow) return;
        const messages = [
          { __privateUnstableMessageType: "pauseCommand" },
          { type: "pause" },
          { event: "pause" },
          { action: "pause" },
          "pause"
        ];
        messages.forEach((msg) => {
          try { iframe.contentWindow.postMessage(msg, origin); } catch (e) {}
        });
      };

      let pauseOtherStreamsInitialDone = false;
      const pauseOtherStreams = (currentIframe, options) => {
        const initial = options && options.initial === true;
        if (initial && pauseOtherStreamsInitialDone) return;
        if (initial) pauseOtherStreamsInitialDone = true;
        if (FOLEO_DEBUG) {
          console.log("[CFStream] pauseOtherStreams", {
            current: !!currentIframe,
            iframes: document.querySelectorAll(".cf-stream-embed iframe").length
          });
        }
        const currentEmbed = currentIframe?.closest?.(".cf-stream-embed") || null;
        const iframes = document.querySelectorAll(".cf-stream-embed iframe");
        iframes.forEach((iframe) => {
          if (currentIframe && iframe === currentIframe) return;
          const meta = iframeMeta.get(iframe) || {};
          const origin = meta.origin || "*";
          tryPostMessagePause(iframe, origin);
          tryPostMessagePause(iframe, "*");
          ensureCfSdk().then(() => {
            try {
              const player = Stream?.(iframe);
              player?.pause?.();
            } catch (e) {}
          });
        });
        // Retry once shortly after to catch late-ready players (only when we know the current iframe).
        if (currentIframe) {
          setTimeout(() => {
            document.querySelectorAll(".cf-stream-embed iframe").forEach((iframe) => {
              if (iframe === currentIframe) return;
              const meta = iframeMeta.get(iframe) || {};
              const origin = meta.origin || "*";
              tryPostMessagePause(iframe, origin);
              tryPostMessagePause(iframe, "*");
              try {
                const player = Stream?.(iframe);
                player?.pause?.();
              } catch (e) {}
            });
            document.querySelectorAll(".cf-stream-embed video").forEach((video) => {
              if (currentEmbed && video.closest(".cf-stream-embed") === currentEmbed) return;
              try { video.pause(); } catch (e) {}
            });
          }, 120);
        }
        // Pause any direct video elements inside other CF embeds (vidstack/web component path).
        document.querySelectorAll(".cf-stream-embed video").forEach((video) => {
          if (currentEmbed && video.closest(".cf-stream-embed") === currentEmbed) return;
          try { video.pause(); } catch (e) {}
        });
        // Pause any fullscreen overlay video if present.
        document.querySelectorAll(".foleo-video-overlay__video").forEach((v) => {
          try { v.pause(); } catch (e) {}
        });
      };

      const bindDirectIframeControls = () => {
        const iframes = document.querySelectorAll(".cf-stream-embed iframe");
        iframes.forEach((iframe) => {
          if (iframe.dataset.foleoStreamBound === "1") return;
          iframe.dataset.foleoStreamBound = "1";
          const origin = (() => {
            try {
              const url = new URL(iframe.src);
              return `${url.protocol}//${url.host}`;
            } catch (e) {
              return "*";
            }
          })();
          iframeMeta.set(iframe, { origin });
          ensureCfSdk().then(() => {
            try {
              const player = Stream?.(iframe);
              if (player && player.addEventListener) {
                player.addEventListener("play", () => pauseOtherStreams(iframe));
                player.addEventListener("playing", () => pauseOtherStreams(iframe));
              }
            } catch (e) {}
          });
        });
      };

      const readDataAttr = (placeholder, name) => {
        if (!placeholder) return "";
        const direct = placeholder.getAttribute(name) || "";
        if (direct) return direct;
        const wrapper = placeholder.closest(".cf-stream-embed");
        return wrapper ? (wrapper.getAttribute(name) || "") : "";
      };

      const hasRequiredData = (placeholder) => {
        const customer = normalizeCustomer(readDataAttr(placeholder, "data-foleo-customer"));
        const videoId = readDataAttr(placeholder, "data-foleo-video-id");
        return !!(customer && videoId);
      };

      const isIframeLive = (iframe) => {
        if (!iframe) return false;
        return iframe.isConnected && iframe.tagName === "IFRAME";
      };

      const initFromPlaceholder = (placeholder, isUserIntent) => {
        if (!placeholder) return;
        if (placeholder.dataset.foleoOverlayOnly === "1") return false;
        if (!hasRequiredData(placeholder)) return;
        const userIntent = isUserIntent === true;
        if (!userIntent && isCxPage) return false;

        const state = placeholder.dataset.foleoState || "idle";
        const existing = placeholder.__foleoIframe;
        const existingLive = isIframeLive(existing);
        if (existingLive && (state === "loading" || state === "ready")) {
          pauseOtherStreams(existing, { initial: !userIntent });
          const meta = iframeMeta.get(existing) || {};
          tryPostMessagePlay(existing, meta.origin || "*");
          ensureCfSdk().then(() => {
            try {
              const p = Stream?.(existing);
              p?.play?.().catch?.(() => {});
            } catch (e) {}
          });
          return true;
        }
        if (state === "playing") {
          pauseOtherStreams(existing || null, { initial: !userIntent });
          return;
        }
        if (!existingLive) {
          placeholder.dataset.foleoState = "idle";
        }
        const customerInfo = normalizeCustomer(readDataAttr(placeholder, "data-foleo-customer"));
        const videoId = readDataAttr(placeholder, "data-foleo-video-id");
        const poster = readDataAttr(placeholder, "data-poster");
        if (!customerInfo || !videoId) return false;
        if (placeholder.dataset.foleoLazyInit === "1" && existingLive) return false;
        placeholder.dataset.foleoLazyInit = "1";
        placeholder.dataset.foleoUserInit = userIntent ? "1" : "0";
        placeholder.dataset.foleoState = "loading";
        if (!placeholder.querySelector(".cf-stream-spinner")) {
          const spinner = document.createElement("div");
          spinner.className = "cf-stream-spinner";
          placeholder.appendChild(spinner);
        }
        preconnectForCustomer(customerInfo);

        const iframe = document.createElement("iframe");
        const params = new URLSearchParams();
        if (poster) params.set("poster", poster);
        params.set("api", "1");
        params.set("autoplay", "true");
        params.set("muted", "true");
        params.set("controls", "true");
        params.set("playsinline", "true");
        iframe.src = `${customerInfo.origin}/${videoId}/iframe?${params.toString()}`;
        iframe.allow = "accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;";
        iframe.allowFullscreen = true;
        iframe.loading = "lazy";
        iframe.style.border = "none";
        iframe.style.position = "absolute";
        iframe.style.top = "0";
        iframe.style.left = "0";
        iframe.style.height = "100%";
        iframe.style.width = "100%";
        iframe.style.zIndex = "0";
        iframe.style.opacity = "0";
        iframe.style.visibility = "hidden";

        const parent = placeholder.parentElement;
        if (parent) {
          placeholder.style.zIndex = "1";
          placeholder.style.transition = "opacity 240ms ease";
          parent.insertBefore(iframe, placeholder);
          placeholder.__foleoIframe = iframe;
          iframeToPlaceholder.set(iframe.contentWindow, placeholder);
          const origin = customerInfo.origin;
          iframeMeta.set(iframe, { origin });
          bindMessageListener();

          iframe.addEventListener("load", () => {
            placeholder.dataset.foleoState = "ready";
            iframe.style.opacity = "1";
            iframe.style.visibility = "visible";
            pauseOtherStreams(iframe, { initial: !userIntent });
            const tryPlay = () => {
              tryPostMessagePlay(iframe, origin);
              ensureCfSdk().then(() => {
                try {
                  const player = Stream?.(iframe);
                  if (player && player.addEventListener) {
                    const onPlay = () => {
                      const userInit = placeholder.dataset.foleoUserInit === "1";
                      pauseOtherStreams(iframe, { initial: !userInit });
                      markPlaying(placeholder);
                    };
                    player.addEventListener("play", onPlay, { once: true });
                    player.addEventListener("playing", onPlay, { once: true });
                  }
                  player?.play?.().catch?.(() => {});
                } catch (e) {}
              });
            };
            tryPlay();
            setTimeout(tryPlay, 250);
            setTimeout(tryPlay, 700);
            setTimeout(tryPlay, 1200);
            setTimeout(tryPlay, 1800);

            setTimeout(() => {
              if (placeholder.dataset.foleoState !== "playing") {
                ensureHint(placeholder, "Tap to play");
                placeholder.dataset.foleoState = "ready";
              }
            }, 1600);
          }, { once: true });
          return true;
        } else {
          placeholder.replaceWith(iframe);
          return true;
        }
      };

      const observer = ("IntersectionObserver" in window)
        ? new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
              if (!entry.isIntersecting) return;
              const target = entry.target;
              observer.unobserve(target);
              idleRun(() => initFromPlaceholder(target, false));
            });
          }, { rootMargin: "200px 0px", threshold: 0.1 })
        : null;

      const posterObserver = ("IntersectionObserver" in window)
        ? new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
              if (!entry.isIntersecting) return;
              const target = entry.target;
              posterObserver.unobserve(target);
              applyPoster(target);
            });
          }, { rootMargin: "300px 0px", threshold: 0.01 })
        : null;

      const processEmbeds = () => {
        const embeds = document.querySelectorAll(".cf-stream-embed");
        embeds.forEach((embed) => {
          const candidates = Array.from(embed.querySelectorAll(".cf-stream-placeholder"));
          if (!candidates.length) return;
          const valid = candidates.find(hasRequiredData);
          if (!valid) return;
          if (candidates.length > 1 && FOLEO_DEBUG) {
            console.warn("[CFStream] Multiple placeholders found; using first valid only.", embed);
          }
          candidates.forEach((node) => {
            if (node !== valid) node.remove();
          });

          valid.dataset.foleoState = "idle";
          valid.dataset.foleoLazyInit = "0";
          valid.style.pointerEvents = "auto";

          // Remove inline poster styles so below-the-fold posters don't download early.
          if (readDataAttr(valid, "data-poster")) {
            valid.style.backgroundImage = "";
            valid.style.backgroundRepeat = "";
            valid.style.backgroundSize = "";
            valid.dataset.foleoPosterApplied = "0";
          }

          if (valid.dataset.foleoBound !== "1") {
            const onIntent = (e) => {
              if (FOLEO_DEBUG) {
                console.log("[CFStream] intent", {
                  target: e?.target,
                  placeholder: valid,
                  state: valid.dataset.foleoState
                });
              }
              const started = initFromPlaceholder(valid, true);
              if (!started && FOLEO_DEBUG) {
                const styles = window.getComputedStyle(valid);
                console.warn("[CFStream] Click did not start init", {
                  target: e?.target,
                  placeholder: valid,
                  pointerEvents: styles.pointerEvents,
                  state: valid.dataset.foleoState
                });
              }
            };
            valid.addEventListener("click", onIntent);
            valid.addEventListener("keydown", (e) => {
              if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                onIntent(e);
              }
            });
            valid.dataset.foleoBound = "1";
          }

          const isHero = !!valid.closest('[data-foleo-hero="1"]');
          if (isHero) {
            applyPoster(valid);
          } else if (posterObserver) {
            posterObserver.observe(valid);
            valid.dataset.foleoLazyInit = "1";
          } else {
            applyPoster(valid);
          }
          if (!isCxPage && !isHero) {
        if (observer) {
              observer.observe(valid);
            } else {
              idleRun(() => initFromPlaceholder(valid, false));
            }
          }
        });
      };

      window.FoleoInitCfStream = initFromPlaceholder;
      window.FoleoPauseOtherStreams = pauseOtherStreams;

      bindMessageListener();
      bindDirectIframeControls();
      if (hasPlaceholders) {
        processEmbeds();
      }

      const embedObserver = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
          if (mutation.addedNodes && mutation.addedNodes.length) {
            bindDirectIframeControls();
            if (hasPlaceholders) {
              processEmbeds();
            }
            break;
          }
        }
      });
      embedObserver.observe(document.body, { childList: true, subtree: true });

    }

      initCfStreamPlaceholders();

    // Vidstack Stream Replacement (legacy path for non-CX pages)
    const playingPlayers = new Set();
    // CX uses the placeholder-first CF Stream flow above; keep legacy swap for non-CX pages.
    const readPageConfig = () => {
      const direct =
        window.foleo_page_config_json ||
        window.FOLEO_PAGE_CONFIG_JSON ||
        window.FOLEO_PAGE_CONFIG ||
        window.foleoPageConfig ||
        window.__FOLEO_PAGE_CONFIG__;
      if (!direct) return null;
      if (typeof direct === "string") {
        try {
          const parsed = JSON.parse(direct);
          return (parsed && typeof parsed === "object") ? parsed : null;
        } catch (e) {
          return null;
        }
      }
      return (typeof direct === "object") ? direct : null;
    };

    const readConfigFlag = (config, key) => {
      if (!config || typeof config !== "object") return false;
      const raw =
        (key in config) ? config[key] :
        (config.flags && key in config.flags) ? config.flags[key] :
        (config.modules && key in config.modules) ? config.modules[key] :
        (config.modules && config.modules.cfStream && key === "cfStream_enabled")
          ? config.modules.cfStream.enabled
          : undefined;
      return raw === true || raw === 1 || raw === "1" || raw === "true";
    };

    const readConfigString = (config, key) => {
      if (!config || typeof config !== "object") return "";
      const raw =
        (key in config) ? config[key] :
        (config.flags && key in config.flags) ? config.flags[key] :
        (config.modules && key in config.modules) ? config.modules[key] :
        (key === "cfStream_mode" && config.modules && config.modules.cfStream)
          ? config.modules.cfStream.mode
          : undefined;
      return (raw === undefined || raw === null) ? "" : String(raw);
    };

    const pageConfig = readPageConfig();
    const pageKey = (() => {
      if (pageConfig && typeof pageConfig === "object") {
        const key =
          pageConfig.pageKey ||
          pageConfig.page_key ||
          pageConfig.key ||
          pageConfig.page ||
          "";
        if (key) return String(key);
      }
      const fromDom =
        document.documentElement?.getAttribute?.("data-foleo-page-key") ||
        document.body?.getAttribute?.("data-foleo-page-key") ||
        "";
      if (fromDom) return fromDom;
      const globalKey =
        window.FOLEO_PAGE_KEY ||
        window.foleo_page_key ||
        window.__FOLEO_PAGE_KEY__ ||
        "";
      return globalKey ? String(globalKey) : "";
    })();

    const cfStreamEnabled = readConfigFlag(pageConfig, "cfStream_enabled");
    const cfStreamMode = readConfigString(pageConfig, "cfStream_mode");
    const isPlaceholderFirst = cfStreamMode === "placeholderFirst";
    const isCxPlaceholderFirst =
      pageKey === "cx" ||
      isPlaceholderFirst ||
      (cfStreamEnabled && isPlaceholderFirst);
    const isCxPath = (() => {
      const path = (window.location && window.location.pathname) ? window.location.pathname : "";
      const clean = path.replace(/\/+$/, "");
      return clean === "" || clean === "/cx";
    })();
    const isCxPage = isCxPlaceholderFirst || isCxPath;

    const legacyLog = (tag, extra) => {
      if (!FOLEO_DEBUG) return;
      const payload = Object.assign(
        { tag, ts: Math.round(performance.now()) },
        extra || {}
      );
      console.log("[LEGACY_CF_INIT]", payload, new Error().stack);
    };

    function parseCloudflareStreamSrc(src) {
      try {
        const url = new URL(src);
        if (!url.hostname.endsWith("cloudflarestream.com")) return null;
        const customer = url.hostname.split(".cloudflarestream.com")[0];
        const parts = url.pathname.split("/").filter(Boolean);
        if (!customer || parts.length === 0) return null;
        return { customer, videoId: parts[0] };
      } catch (e) {
        return null;
      }
    }

    function registerPlayer(player) {
      if (!player || player.dataset.foleoPlayerBound === "1") return;
      player.dataset.foleoPlayerBound = "1";

      player.addEventListener("play", () => {
        playingPlayers.forEach((other) => {
          if (other !== player && typeof other.pause === "function") {
            try { other.pause(); } catch (e) {}
          }
        });
        playingPlayers.add(player);
      });

      const handleStop = () => {
        playingPlayers.delete(player);
      };

      player.addEventListener("pause", handleStop);
      player.addEventListener("ended", handleStop);
    }

    function createPlayerFromData(data, isPopup) {
      const hls = `https://${data.customer}.cloudflarestream.com/${data.videoId}/manifest/video.m3u8`;
      const player = document.createElement("media-player");
      player.className = "foleo-media-player";
      if (isPopup) {
        player.setAttribute("autoplay", "");
        player.setAttribute("muted", "");
        player.setAttribute("loop", "");
        player.setAttribute("playsinline", "");
        player.setAttribute("crossorigin", "anonymous");
      } else {
        player.setAttribute("playsinline", "");
        player.setAttribute("crossorigin", "anonymous");
      }
      player.setAttribute("src", hls);

      const provider = document.createElement("media-provider");
      player.appendChild(provider);
      if (!isPopup) {
        const layout = document.createElement("media-video-layout");
        const noCast = document.createElement("div");
        noCast.setAttribute("slot", "googleCastButton");
        noCast.style.display = "none";
        layout.appendChild(noCast);
        player.appendChild(layout);
      }
      registerPlayer(player);
      return player;
    }

    function replaceIframe(iframe) {
      if (!iframe) return;
      const data = parseCloudflareStreamSrc(iframe.src || "");
      if (isCxPage || isCxPlaceholderFirst) {
        if (FOLEO_DEBUG) {
          legacyLog("cx_skip_legacy", { videoId: data ? data.videoId : "" });
        }
        return;
      }
      if (iframe.dataset.vidstackDone === "1") return;
      if (iframe.parentElement && iframe.parentElement.querySelector("media-player")) return;
      legacyLog("replaceIframe", {
        iframes: document.querySelectorAll('iframe[src*="cloudflarestream.com"]').length
      });
      iframe.dataset.vidstackDone = "1";
      iframe.style.visibility = "hidden";

      const isPopup =
        !!iframe.closest(".breakdance-popup") ||
        !!iframe.closest(".bde-popup") ||
        !!iframe.closest(".popup-topradius");

      if (!data) return;

      const player = createPlayerFromData(data, isPopup);

      if (FOLEO_DEBUG) {
        const wrapperClass = iframe.parentElement ? iframe.parentElement.className : "";
        console.log("Vidstack swap", {
          customer: data.customer,
          videoId: data.videoId,
          hlsUrl: `https://${data.customer}.cloudflarestream.com/${data.videoId}/manifest/video.m3u8`,
          wrapperClass
        });
      }

      function applyNoCast(target) {
        const v = target.querySelector("video");
        if (!v) return false;
        v.disableRemotePlayback = true;
        v.setAttribute("controlslist", "noremoteplayback");
        return true;
      }

      player.addEventListener("loadedmetadata", () => applyNoCast(player), { once: true });

      iframe.replaceWith(player);
      applyNoCast(player);
      requestAnimationFrame(() => applyNoCast(player));
      setTimeout(() => applyNoCast(player), 300);

      if (isPopup) {
        const tryPlay = () => {
          const v = player.querySelector("video");
          if (!v) return false;
          v.muted = true;
          v.loop = true;
          v.playsInline = true;
          v.removeAttribute("controls");
          player.play?.().catch(() => {});
          return true;
        };

        tryPlay();
        requestAnimationFrame(tryPlay);
        setTimeout(tryPlay, 200);
        setTimeout(tryPlay, 800);
      }
    }

    let legacyInitRan = false;
    const runLegacyInit = () => {
      if (legacyInitRan) return;
      legacyInitRan = true;
      if (isCxPage || isCxPlaceholderFirst) {
        if (FOLEO_DEBUG) {
          legacyLog("cx_skip_legacy", {
            pageKey,
            cfStream_mode: cfStreamMode,
            cfStream_enabled: cfStreamEnabled
          });
        }
        return;
      }

      const initial = document.querySelectorAll('iframe[src*="cloudflarestream.com"]');
      legacyLog("initial_scan", { count: initial.length });
      initial.forEach(replaceIframe);

      const existingPlayers = document.querySelectorAll("media-player");
      existingPlayers.forEach(registerPlayer);

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          mutation.addedNodes.forEach((node) => {
            if (node.nodeType !== 1) return;
            if (node.matches && node.matches('iframe[src*="cloudflarestream.com"]')) {
              legacyLog("mutation_iframe", { nodeName: node.nodeName });
              replaceIframe(node);
              return;
            }
            if (node.querySelectorAll) {
              const iframes = node.querySelectorAll('iframe[src*="cloudflarestream.com"]');
              if (iframes.length) {
                legacyLog("mutation_batch", { count: iframes.length });
              }
              iframes.forEach(replaceIframe);
            }
          });
        });
      });

      observer.observe(document.body, { childList: true, subtree: true });
    };

      runLegacyInit();

      let scrollTicking = false;
      window.addEventListener("scroll", () => {
        if (scrollTicking) return;
        scrollTicking = true;
        window.requestAnimationFrame(() => {
          scrollTicking = false;
          if (!playingPlayers.size) return;

          playingPlayers.forEach((player) => {
            const rect = player.getBoundingClientRect();
            const height = rect.height || 0;
            if (!height) return;
            const threshold = height * 0.3;
            if (rect.top < -threshold || rect.bottom > window.innerHeight + threshold) {
              if (typeof player.pause === "function") player.pause();
            }
          });
        });
      }, { passive: true });
    }
  }
});

// Start fade-swap animations only after full load
window.addEventListener('load', () => {
  document.documentElement.classList.add('foleo-fade-swap-ready');
}, { once: true });

// ==============================
// FOLEO: Disable Pin per Section
// ==============================
function disableFoleoPinningInSections() {
  if (!window.ScrollTrigger || typeof window.ScrollTrigger.getAll !== "function") return;

  const sections = document.querySelectorAll(".foleo-no-pin");
  if (!sections.length) return;

  sections.forEach((section) => {
    const spacers = section.querySelectorAll(".pin-spacer");
    if (!spacers.length) return;

    spacers.forEach((spacer) => {
      const pinned = spacer.firstElementChild;
      if (!pinned) return;

      window.ScrollTrigger.getAll().forEach((trigger) => {
        if (trigger && trigger.pin === pinned) {
          trigger.kill(true);
          if (FOLEO_DEBUG) console.log("FOLEO: Pin disabled", pinned);
        }
      });

      pinned.style.removeProperty("position");
      pinned.style.removeProperty("top");
      pinned.style.removeProperty("left");
      pinned.style.removeProperty("transform");
      pinned.style.removeProperty("width");
      pinned.style.removeProperty("height");

      spacer.replaceWith(pinned);
    });
  });
}

function initFoleoDisablePinAfterReady() {
  const tryInit = () => {
    if (window.FOLEO_EDIT_MODE) return;
    if (!window.ScrollTrigger || typeof window.ScrollTrigger.getAll !== "function") {
      setTimeout(tryInit, 200);
      return;
    }
    disableFoleoPinningInSections();
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", tryInit, { once: true });
  } else {
    tryInit();
  }
}

function bindFoleoSwitcherDelegatedHandlers() {
  if (window.__FOLEO_SWITCH_DELEGATED__) return;
  window.__FOLEO_SWITCH_DELEGATED__ = true;

  const setFoleoSwitchOpen = (isOpen) => {
    try {
      window.localStorage.setItem(FOLEO_SWITCH_OPEN_KEY, isOpen ? '1' : '0');
    } catch (e) {}
    const root = document.querySelector('.foleo-switch');
    if (root) root.classList.toggle('is-open', !!isOpen);
    document.documentElement.classList.toggle('foleo-switch-open', !!isOpen);
  };

  const getRoot = () => document.querySelector('.foleo-switch');

  document.addEventListener('click', (e) => {
    const root = getRoot();
    if (!root) return;

    const btn = e.target.closest('.foleo-switch__btn');
    if (btn) {
      e.preventDefault();
      e.stopPropagation();
      setFoleoSwitchOpen(!root.classList.contains('is-open'));
      return;
    }

    const closeBtn = e.target.closest('.foleo-switch__close');
    if (closeBtn) {
      e.preventDefault();
      e.stopPropagation();
      setFoleoSwitchOpen(false);
      return;
    }

    const popup = e.target.closest(
      '.bde-popup, .breakdance-popup, .bde-popup__backdrop, .breakdance-popup__backdrop, ' +
      '.bde-popup-overlay, .breakdance-popup-overlay, .bde-popup-backdrop, .breakdance-popup-backdrop'
    );
    if (popup) return;

    if (root.classList.contains('is-open') && !root.contains(e.target)) {
      setFoleoSwitchOpen(false);
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    const root = getRoot();
    if (!root) return;
    setFoleoSwitchOpen(false);
  });
}

initFoleoDisablePinAfterReady();

document.addEventListener("pointerdown", (e) => {
  if (window.FOLEO_EDIT_MODE) return;
  const card = e.target.closest(".cf-card");

  if (card) {
    const isMobile = window.matchMedia && window.matchMedia("(max-width: 768px)").matches;
    if (isMobile && card.closest(".foleo-snap-hero")) {
      return;
    }
    // lock the hovered/clicked card
    document.querySelectorAll(".cf-card.is-active").forEach((el) => {
      if (el !== card) el.classList.remove("is-active");
    });
    card.classList.add("is-active");
    return;
  }

  // click outside unlocks all
  document.querySelectorAll(".cf-card.is-active").forEach((el) => {
    el.classList.remove("is-active");
  });
});

document.addEventListener("pointerout", (e) => {
  if (window.FOLEO_EDIT_MODE) return;
  const card = e.target.closest(".cf-card");
  if (!card) return;
  if (e.relatedTarget && card.contains(e.relatedTarget)) return;
  if (!card.classList.contains("is-playing")) {
    card.classList.remove("is-active");
  }
});

document.querySelectorAll('.feature-tabs.is-tabs-ready')
  .forEach(el => el.classList.remove('is-tabs-ready'));

// Logo notch collapse on scroll
(function(){
  const CLASS_COLLAPSED = 'foleo--logo-collapsed';
  const THRESHOLD = 40;
  let ticking = false;

  function apply(){
    ticking = false;
    const y = window.scrollY || document.documentElement.scrollTop || 0;
    if (y > THRESHOLD) document.body.classList.add(CLASS_COLLAPSED);
    else document.body.classList.remove(CLASS_COLLAPSED);
  }

  function onScroll(){
    if (ticking) return;
    ticking = true;
    window.requestAnimationFrame(apply);
  }

  let notchTemplate = null;

  function captureNotchTemplate(){
    const notch = document.querySelector('.foleo-logo-notch');
    if (notch && !notchTemplate) {
      notchTemplate = notch.cloneNode(true);
    }
  }

  const safeIsEditMode = (typeof isEditMode !== "undefined" && !!isEditMode);
  if (!safeIsEditMode) {
    const sizesValue = "(max-width: 1200px) 100vw, (max-width: 1800px) 50vw, 900px";
    const applyHeroImageAttrs = (el, isPrimary) => {
      if (!el) return;
      const img = el.tagName === "IMG" ? el : el.querySelector("img");
      if (!img) return;
      img.setAttribute("sizes", sizesValue);
      if (isPrimary) {
        img.setAttribute("fetchpriority", "high");
        img.setAttribute("loading", "eager");
      } else {
        img.removeAttribute("fetchpriority");
        img.removeAttribute("loading");
      }
    };

    applyHeroImageAttrs(document.querySelector(".bde-image2-455-1323"), true);
    applyHeroImageAttrs(document.querySelector(".bde-image2-455-1365"), false);
  }

  function getNotchHost(){
    const bdRoot = document.querySelector('.breakdance');
    if (bdRoot) {
      const style = window.getComputedStyle(bdRoot);
      if (!style.transform || style.transform === 'none') {
        return bdRoot;
      }
    }
    return document.body;
  }

  function ensureNotch(){
    const host = getNotchHost();
    const notch = document.querySelector('.foleo-logo-notch');
    if (notch) {
      if (notch.parentElement !== host) {
        host.appendChild(notch);
      }
      return;
    }
    if (notchTemplate) {
      const clone = notchTemplate.cloneNode(true);
      host.appendChild(clone);
    }
  }

  function bindNotchObserver(){
    const observer = new MutationObserver(() => {
      ensureNotch();
});
    observer.observe(document.body, { childList: true, subtree: true });
  }


  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      captureNotchTemplate();
      ensureNotch();
      bindNotchObserver();
      apply();
      window.addEventListener('scroll', onScroll, { passive: true });
    });
  } else {
    captureNotchTemplate();
    ensureNotch();
    bindNotchObserver();
    apply();
    window.addEventListener('scroll', onScroll, { passive: true });
  }
})();
