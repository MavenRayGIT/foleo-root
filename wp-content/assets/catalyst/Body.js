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
// to make the GDPR link to HCG site in new tab //

function getQueryParam(name) {
  try {
    return new URLSearchParams(window.location.search).get(name);
  } catch (e) {
    return null;
  }
}

const FOLEO_PROFILE_STORAGE_KEY = 'foleoProfile';

function loadNavRegistrySync() {
  if (window.__FOLEO_NAV_REGISTRY__) return window.__FOLEO_NAV_REGISTRY__;
  try {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/wp-content/assets/catalyst/nav-registry.json', false);
    xhr.send(null);
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      window.__FOLEO_NAV_REGISTRY__ = data;
      return data;
    }
  } catch (e) {}
  return null;
}

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

resolveFoleoEditMode();

function initFoleoEditPerfLogger() {
  try {
    const params = new URLSearchParams(window.location.search || "");
    const enabled =
      params.get("foleo_perf") === "1" || params.get("foleo_perf") === "true";
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
  if (window.matchMedia && window.matchMedia("(max-width: 767px)").matches) {
    section.classList.add("canvas-story--stacked");
    return;
  }

  const panels = Array.from(section.querySelectorAll(".canvas-story__panel"));
  if (panels.length < 2) return;
  const dots = section.querySelector(".canvas-story__dots");
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

  const copyBg = "#f4f0ea";
  const profileBg = "#ffffff";

  keyPanels.forEach(({ img, profile, copy }) => {
    if (img) window.gsap.set(img, { opacity: 0 });
    if (profile) window.gsap.set(profile, { opacity: 0, backgroundColor: profileBg });
    if (copy) window.gsap.set(copy, { opacity: 0, backgroundColor: copyBg });
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
      start: "top 5%",
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
    : readStoredProfile();

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
  return {
    mode: 'binder',
    binder,
    page
  };
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

  const mount = document.querySelector('[data-foleo-switcher]');
  if (!mount) return;

  const binderId = state.binderId || state.binder || getQueryParam('binder');
  const pages = Array.isArray(state.pages) ? state.pages : [];
  if (!binderId || !pages.length) return;

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
    mount.appendChild(closeBtn);
  }
  if (mount.querySelector('.foleo-switch__link')) return;
  if (!panel.dataset.foleoSwitchBound) {
    panel.dataset.foleoSwitchBound = 'true';
    panel.addEventListener('click', (e) => {
      const link = e.target.closest('.foleo-switch__link');
      if (!link) return;
      const root = document.querySelector('.foleo-switch');
      if (!root) return;
      root.classList.remove('is-open');
      try {
        window.localStorage.setItem('foleoSwitchOpen', '0');
      } catch (err) {}
    });
  }

  const pathSlug = window.location.pathname.replace(/\/+$/, '').split('/').pop() || '';
  const defaultSlug = pages[0] || '';
  const activeSlug = state.activeSlug || pathSlug || defaultSlug;

  panel.innerHTML = pages
    .map((slug) => {
      const label = escapeFoleoHtml(formatFoleoLabel(slug));
      const href = `${window.location.origin}/${slug}/?binder=${encodeURIComponent(binderId)}`;
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
  const TRAY_DEBUG = false;
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
    const h = trayOpen.offsetHeight || 0;
    if (TRAY_DEBUG) {
      console.log('[foleo-tray] updateBodyOffset', {
        isOpen,
        height: h,
        scrollTop: trayOpen.scrollTop,
        scrollHeight: trayOpen.scrollHeight
      });
    }
    if (!isOpen || h === 0) {
      document.documentElement.classList.remove('foleo-tray-opened');
      document.documentElement.style.setProperty('--foleo-tray-open-height', '0px');
      return;
    }
    document.documentElement.style.setProperty('--foleo-tray-open-height', `${h}px`);
    document.documentElement.classList.add('foleo-tray-opened');
  };

  const forceBodyOffset = () => {
    if (!trayOpen.classList.contains('is-open')) return;
    const h = trayOpen.offsetHeight || 0;
    if (h === 0) return;
    document.documentElement.style.setProperty('--foleo-tray-open-height', `${h}px`);
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
        if (TRAY_DEBUG) console.log('[foleo-tray] opened');
        window.requestAnimationFrame(updateBodyOffset);
        scheduleOffsetSync();
        setTimeout(forceBodyOffset, 320);
        setMobileScrollLock(true);
      });
      return;
    }

    trayOpen.classList.remove('is-open');
    if (TRAY_DEBUG) console.log('[foleo-tray] closed');
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
    if (!TRAY_DEBUG) return;
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


document.addEventListener('DOMContentLoaded', () => {
  const isEditMode = resolveFoleoEditMode();
  if (!isEditMode) {
    document.querySelectorAll('.canvas-story--edit').forEach((el) => {
      el.classList.remove('canvas-story--edit');
    });
  }
  if (isEditMode) {
    document.documentElement.classList.add('foleo-edit');
  } else {
    if (document.querySelector(".canvas-story")) {
      ensureGsap(initCanvasStory);
    }
    if (document.querySelector("[data-parallax]")) {
      initFoleoWaitForScrollParallax();
    }
    if (document.querySelector(".foleo-tray-bot")) {
      initFoleoTrayBottom();
    }
    document
      .querySelectorAll(
        '.cmplz-cookiebanner a[href], .cmplz-cookiebanner a.cmplz-document'
      )
      .forEach(function (link) {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
      });
  }

  if (!isEditMode) {
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
  }

  if (!isEditMode) {
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

      const STORAGE_KEY = 'foleoSwitchOpen';
      const setPersistedOpen = (isOpen) => {
        try {
          window.localStorage.setItem(STORAGE_KEY, isOpen ? '1' : '0');
        } catch (e) {}
      };

      try {
        if (window.localStorage.getItem(STORAGE_KEY) === '1') {
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
      if (!placeholders.length) return;

      const CF_DEBUG = false;

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
            if (!placeholder) return;
            const meta = iframeMeta.get(placeholder.__foleoIframe) || {};
            if (meta.origin && event.origin !== meta.origin) return;
            if (isPlayingMessage(event.data)) {
              markPlaying(placeholder);
            }
          } catch (e) {}
        });
      };

      const ensureHint = (placeholder, text) => {
        if (!placeholder) return;
        if (placeholder.querySelector(".cf-stream-hint")) return;
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
      };

      const markPlaying = (placeholder) => {
        if (!placeholder) return;
        if (placeholder.dataset.foleoState === "playing") return;
        placeholder.dataset.foleoState = "playing";
        placeholder.style.pointerEvents = "none";
        placeholder.style.opacity = "0";
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

      const initFromPlaceholder = (placeholder) => {
        if (!placeholder) return;
        if (!hasRequiredData(placeholder)) return;

        const state = placeholder.dataset.foleoState || "idle";
        const existing = placeholder.__foleoIframe;
        const existingLive = isIframeLive(existing);
        if (existingLive && (state === "loading" || state === "ready")) {
          const meta = iframeMeta.get(existing) || {};
          tryPostMessagePlay(existing, meta.origin || "*");
          return true;
        }
        if (state === "playing") return;
        if (!existingLive) {
          placeholder.dataset.foleoState = "idle";
        }
        const customerInfo = normalizeCustomer(readDataAttr(placeholder, "data-foleo-customer"));
        const videoId = readDataAttr(placeholder, "data-foleo-video-id");
        const poster = readDataAttr(placeholder, "data-poster");
        if (!customerInfo || !videoId) return false;
        if (placeholder.dataset.foleoLazyInit === "1" && existingLive) return false;
        placeholder.dataset.foleoLazyInit = "1";
        placeholder.dataset.foleoState = "loading";

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
            tryPostMessagePlay(iframe, origin);
            setTimeout(() => tryPostMessagePlay(iframe, origin), 250);
            setTimeout(() => tryPostMessagePlay(iframe, origin), 700);

            setTimeout(() => {
              if (placeholder.dataset.foleoState !== "playing") {
                ensureHint(placeholder, "Tap to play");
                placeholder.dataset.foleoState = "ready";
              }
            }, 1100);
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
              idleRun(() => initFromPlaceholder(target));
            });
          }, { rootMargin: "200px 0px", threshold: 0.1 })
        : null;

      const processEmbeds = () => {
        const embeds = document.querySelectorAll(".cf-stream-embed");
        embeds.forEach((embed) => {
          const candidates = Array.from(embed.querySelectorAll(".cf-stream-placeholder"));
          if (!candidates.length) return;
          const valid = candidates.find(hasRequiredData);
          if (!valid) return;
          if (candidates.length > 1 && CF_DEBUG) {
            console.warn("[CFStream] Multiple placeholders found; using first valid only.", embed);
          }
          candidates.forEach((node) => {
            if (node !== valid) node.remove();
          });

          valid.dataset.foleoState = "idle";
          valid.dataset.foleoLazyInit = "0";
          valid.style.pointerEvents = "auto";

          const poster = readDataAttr(valid, "data-poster");
          if (poster) {
            valid.style.backgroundImage = `url("${poster}")`;
            valid.style.backgroundPosition = "center";
            valid.style.backgroundRepeat = "no-repeat";
            valid.style.backgroundSize = "cover";
          }

          if (valid.dataset.foleoBound !== "1") {
            const onIntent = (e) => {
              const started = initFromPlaceholder(valid);
              if (!started && CF_DEBUG) {
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
          if (!isCxPage && !isHero) {
            if (observer) {
              observer.observe(valid);
            } else {
              idleRun(() => initFromPlaceholder(valid));
            }
          }
        });
      };

      processEmbeds();

      const embedObserver = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
          if (mutation.addedNodes && mutation.addedNodes.length) {
            processEmbeds();
            break;
          }
        }
      });
      embedObserver.observe(document.body, { childList: true, subtree: true });
    }

    initCfStreamPlaceholders();

    // Vidstack Stream Replacement
    const VIDSTACK_DEBUG = false;
    const LEGACY_CF_DEBUG = false;
    const playingPlayers = new Set();
    const isCxPage = (() => {
      const path = (window.location && window.location.pathname) ? window.location.pathname : "";
      const clean = path.replace(/\/+$/, "");
      return clean === "" || clean === "/cx";
    })();

    const legacyLog = (tag, extra) => {
      if (!LEGACY_CF_DEBUG) return;
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

    function getPosterFromIframe(iframe) {
      if (!iframe) return "";
      const direct =
        iframe.getAttribute("data-poster") ||
        iframe.getAttribute("data-poster-url") ||
        iframe.getAttribute("data-thumbnail") ||
        iframe.getAttribute("data-thumb") ||
        iframe.getAttribute("poster") ||
        iframe.dataset?.poster ||
        iframe.dataset?.posterUrl ||
        iframe.dataset?.thumbnail ||
        iframe.dataset?.thumb ||
        "";
      if (direct) return direct;
      const wrapper = iframe.closest(".cf-stream-embed");
      return (
        wrapper?.getAttribute?.("data-poster") ||
        wrapper?.getAttribute?.("data-poster-url") ||
        wrapper?.dataset?.poster ||
        wrapper?.dataset?.posterUrl ||
        ""
      );
    }

    function createLazyPlaceholder(iframe, data, isPopup) {
      const hls = `https://${data.customer}.cloudflarestream.com/${data.videoId}/manifest/video.m3u8`;
      const placeholder = document.createElement("div");
      placeholder.className = "cf-stream-placeholder";
      placeholder.setAttribute("role", "button");
      placeholder.setAttribute("tabindex", "0");
      placeholder.dataset.foleoLazyVideo = "1";
      placeholder.dataset.foleoHls = hls;
      placeholder.dataset.foleoCustomer = data.customer;
      placeholder.dataset.foleoVideoId = data.videoId;
      placeholder.dataset.foleoIsPopup = isPopup ? "1" : "0";

      const poster = getPosterFromIframe(iframe);
      placeholder.style.position = "absolute";
      placeholder.style.inset = "0";
      placeholder.style.width = "100%";
      placeholder.style.height = "100%";
      placeholder.style.backgroundColor = "#000";
      placeholder.style.backgroundPosition = "center";
      placeholder.style.backgroundRepeat = "no-repeat";
      placeholder.style.backgroundSize = "cover";
      if (poster) {
        placeholder.style.backgroundImage = `url("${poster}")`;
      }
      return placeholder;
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

    function initFromPlaceholder(placeholder) {
      if (!placeholder || placeholder.dataset.foleoLazyInit === "1") return;
      placeholder.dataset.foleoLazyInit = "1";
      const data = {
        customer: placeholder.dataset.foleoCustomer,
        videoId: placeholder.dataset.foleoVideoId
      };
      const isPopup = placeholder.dataset.foleoIsPopup === "1";
      const player = createPlayerFromData(data, isPopup);

      function applyNoCast(target) {
        const v = target.querySelector("video");
        if (!v) return false;
        v.disableRemotePlayback = true;
        v.setAttribute("controlslist", "noremoteplayback");
        return true;
      }

      player.addEventListener("loadedmetadata", () => applyNoCast(player), { once: true });
      placeholder.replaceWith(player);
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

    function idleRun(fn) {
      if (typeof window.requestIdleCallback === "function") {
        window.requestIdleCallback(fn, { timeout: 2000 });
      } else {
        setTimeout(fn, 400);
      }
    }

    const lazyObserver = ("IntersectionObserver" in window)
      ? new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const target = entry.target;
            lazyObserver.unobserve(target);
            idleRun(() => initFromPlaceholder(target));
          });
        }, { rootMargin: "200px 0px", threshold: 0.1 })
      : null;

    function replaceIframe(iframe) {
      if (!iframe || iframe.dataset.vidstackDone === "1") return;
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
      const isHero =
        !!iframe.closest(".mod-hero") ||
        !!iframe.closest(".hero") ||
        !!iframe.closest(".hero-video") ||
        !!iframe.closest("[data-foleo-hero]");

      const data = parseCloudflareStreamSrc(iframe.src || "");
      if (!data) return;

      if (isCxPage) {
        legacyLog("cx_skip_legacy", { videoId: data.videoId });
        return;
      }

      const shouldLazy = isCxPage && !isPopup;
      if (shouldLazy) {
        const placeholder = createLazyPlaceholder(iframe, data, isPopup);
        placeholder.dataset.foleoInit = isHero ? "intent" : "idle";
        const onIntent = () => initFromPlaceholder(placeholder);
        placeholder.addEventListener("click", onIntent, { once: true });
        placeholder.addEventListener("keydown", (e) => {
          if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            onIntent();
          }
        }, { once: true });

        try { iframe.src = "about:blank"; } catch (e) {}
        iframe.replaceWith(placeholder);
        if (!isHero) {
          if (lazyObserver) {
            lazyObserver.observe(placeholder);
          } else {
            idleRun(() => initFromPlaceholder(placeholder));
          }
        }
        return;
      }

      const player = createPlayerFromData(data, isPopup);

      if (VIDSTACK_DEBUG) {
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

      const initial = document.querySelectorAll('iframe[src*="cloudflarestream.com"]');
      if (LEGACY_CF_DEBUG) {
        legacyLog("initial_scan", { count: initial.length });
      }
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
});

// ==============================
// FOLEO: Disable Pin per Section
// ==============================
function disableFoleoPinningInSections() {
  if (!window.ScrollTrigger || typeof window.ScrollTrigger.getAll !== "function") return;

  const sections = document.querySelectorAll(".foleo-no-pin");
  if (!sections.length) return;

  sections.forEach((section) => {
    section.style.outline = "2px solid red";

    const spacers = section.querySelectorAll(".pin-spacer");
    if (!spacers.length) return;

    spacers.forEach((spacer) => {
      const pinned = spacer.firstElementChild;
      if (!pinned) return;

      window.ScrollTrigger.getAll().forEach((trigger) => {
        if (trigger && trigger.pin === pinned) {
          trigger.kill(true);
          console.log("FOLEO: Pin disabled", pinned);
        }
      });

      pinned.style.removeProperty("position");
      pinned.style.removeProperty("top");
      pinned.style.removeProperty("left");
      pinned.style.removeProperty("transform");
      pinned.style.removeProperty("width");
      pinned.style.removeProperty("height");
      pinned.style.outline = "2px solid blue";

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

initFoleoDisablePinAfterReady();

document.addEventListener("pointerdown", (e) => {
  if (window.FOLEO_EDIT_MODE) return;
  const card = e.target.closest(".cf-card");

  if (card) {
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
