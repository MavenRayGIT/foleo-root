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

const FOLEO_SVG_PATH = '/wp-content/uploads/foleo/svg/';

function scheduleOnce(fn, delays) {
  if (!Array.isArray(delays)) return;
  delays.forEach((delay) => setTimeout(fn, delay));
}

function bindVideoBugViewportFloat(bug, section) {
  if (!bug || !section) return;

  const io = new IntersectionObserver((entries) => {
    for (const e of entries) {
      if (e.isIntersecting) {
        bug.classList.add('is-inview');
      } else {
        bug.classList.remove('is-inview');
        bug.classList.remove('is-nameplate-hidden');
        clearTimeout(bug.__nameplateTimer);
        try { bug.__player?.pause?.(); } catch (_) {}
        bug.dataset.state = 'paused';
      }
    }
  }, { threshold: 0.01 });

  io.observe(section);
}

function initVideoBugChapters() {
  const bug = document.querySelector('.video-bug');
  if (!bug) return;

  const sections = Array.from(document.querySelectorAll('[data-video-bug="1"]'));
  if (!sections.length) return;

  let active = null;

  const setBugFromSection = (section) => {
    const src = section.getAttribute('data-video-src') || '';
    const name = section.getAttribute('data-video-name') || '';
    const title = section.getAttribute('data-video-title') || '';
    const size = section.getAttribute('data-video-size') || 'sm';
    const top = section.getAttribute('data-video-top') || '80';

    bug.setAttribute('data-video-bug-size', size);
    bug.setAttribute('data-video-bug-top', top);

    const plate = bug.querySelector('.video-bug__nameplate');
    if (plate) {
      plate.innerHTML = `<b>${name}</b><br><br>${title}`;
    }

    const player = bug.__player || bug.querySelector('media-player.video-bug__player');
    if (player && src && player.getAttribute('src') !== src) {
      player.setAttribute('src', src);
      try { player.currentTime = 0; } catch (e) {}
      bug.dataset.state = 'paused';
    }

    bug.classList.remove('is-nameplate-hidden');
    clearTimeout(bug.__nameplateTimer);
    const delay = parseInt(bug.getAttribute('data-video-nameplate-delay') || '1400', 10);
    bug.__nameplateTimer = setTimeout(() => {
      bug.classList.add('is-nameplate-hidden');
    }, delay);
  };

  const io = new IntersectionObserver((entries) => {
    const topBand = window.innerHeight * 0.25;
    const candidates = entries.filter((entry) => entry.isIntersecting);

    if (!candidates.length) {
      bug.classList.remove('is-inview');
      active = null;
      bug.classList.remove('is-nameplate-hidden');
      clearTimeout(bug.__nameplateTimer);
      try { bug.__player?.pause?.(); } catch (e) {}
      bug.dataset.state = 'paused';
      return;
    }

    const bandHits = candidates
      .map((entry) => ({ entry, rect: entry.target.getBoundingClientRect() }))
      .filter(({ rect }) => rect.top <= topBand && rect.bottom >= topBand)
      .map(({ entry }) => entry);

    const visible = (bandHits.length ? bandHits : candidates)
      .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

    const next = visible[0].target;
    if (active !== next) {
      active = next;
      setBugFromSection(next);
    }

    bug.classList.add('is-inview');
  }, { threshold: [0.05, 0.15, 0.3, 0.5, 0.75] });

  sections.forEach((section) => io.observe(section));
}

function initVideoBugs() {
  const bugs = Array.from(document.querySelectorAll('.video-bug'));
  if (!bugs.length) return;

  for (const bug of bugs) {
    if (bug.dataset.videoBugBound === '1') continue;
    bug.dataset.videoBugBound = '1';

    const player = bug.querySelector('media-player.video-bug__player');
    if (!player) continue;

    bug.__player = player;

    const frame = bug.querySelector('.video-bug__frame') || bug;
    const btnPlay = bug.querySelector('.video-bug__btn-play');
    const btnPause = bug.querySelector('.video-bug__btn-pause');
    const btnRestart = bug.querySelector('.video-bug__btn-restart');
    const btnExpand = bug.querySelector('.video-bug__btn-expand');
    const btnSize = bug.querySelector('.video-bug__btn-size');

    bug.dataset.state = bug.dataset.state || 'paused';

    const setState = (nextState) => {
      bug.dataset.state = nextState;
    };

    const play = async () => {
      try {
        await player.play?.();
        setState('playing');
      } catch (e) {}
    };

    const pause = () => {
      try { player.pause?.(); } catch (e) {}
      setState('paused');
    };

    frame.addEventListener('click', (ev) => {
      if (ev.target?.closest?.('.video-bug__btn')) return;
      if (bug.dataset.state === 'playing') pause();
      else play();
    });

    btnPlay?.addEventListener('click', (ev) => {
      ev.preventDefault();
      ev.stopPropagation();
      play();
    });

    btnPause?.addEventListener('click', (ev) => {
      ev.preventDefault();
      ev.stopPropagation();
      pause();
    });

    btnRestart?.addEventListener('click', (ev) => {
      ev.preventDefault();
      ev.stopPropagation();
      try { player.currentTime = 0; } catch (e) {}
      play();
    });

    btnSize?.addEventListener('click', (ev) => {
      ev.preventDefault();
      ev.stopPropagation();
      const next = bug.getAttribute('data-video-bug-size') === 'sm' ? 'lg' : 'sm';
      bug.setAttribute('data-video-bug-size', next);
      bug.dataset.videoBugSize = next;
    });

    btnExpand?.addEventListener('click', (ev) => {
      ev.preventDefault();
      ev.stopPropagation();
      const src = player.getAttribute('src') || '';
      if (!src) return;
      window.FoleoVideoPopup?.open?.({ src });
    });

    const section = bug.closest('section, .bde-section, .bde-section-wrap');
    bindVideoBugViewportFloat(bug, section);
  }
}

window.initVideoBugs = initVideoBugs;

const runVideoBugs = () => {
  try { initVideoBugs(); } catch (e) {}
  try { initVideoBugChapters(); } catch (e) {}
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    runVideoBugs();
    setTimeout(runVideoBugs, 250);
    setTimeout(runVideoBugs, 1000);
  });
} else {
  runVideoBugs();
  setTimeout(runVideoBugs, 250);
  setTimeout(runVideoBugs, 1000);
}

function resolveFoleoNavState() {
  const binder = getQueryParam('binder');
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

  const sections = Array.from(document.querySelectorAll('section[id]'));

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
    const heading = sec.querySelector('h1, h2, h3');
    const label = (sec.getAttribute('data-nav-label') || heading?.textContent || id).trim();
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

  if (mount.querySelector('.foleo-switch__link')) return;

  const binderId = state.binderId || state.binder || getQueryParam('binder');
  const pages = Array.isArray(state.pages) ? state.pages : [];
  if (!binderId || !pages.length) return;

  let panel = mount.querySelector('.foleo-switch__panel');
  if (!panel) {
    panel = document.createElement('div');
    panel.className = 'foleo-switch__panel';
    mount.appendChild(panel);
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


document.addEventListener('DOMContentLoaded', () => {
  document
    .querySelectorAll(
      '.cmplz-cookiebanner a[href], .cmplz-cookiebanner a.cmplz-document'
    )
    .forEach(function (link) {
      link.setAttribute('target', '_blank');
      link.setAttribute('rel', 'noopener noreferrer');
    });

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
  }

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

  // Vidstack Stream Replacement
  const VIDSTACK_DEBUG = false;
  const playingPlayers = new Set();

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

  function replaceIframe(iframe) {
    if (!iframe || iframe.dataset.vidstackDone === "1") return;
    if (iframe.parentElement && iframe.parentElement.querySelector("media-player")) return;
    iframe.dataset.vidstackDone = "1";
    iframe.style.visibility = "hidden";

    const isPopup =
      !!iframe.closest(".breakdance-popup") ||
      !!iframe.closest(".bde-popup") ||
      !!iframe.closest(".popup-topradius");

    const data = parseCloudflareStreamSrc(iframe.src || "");
    if (!data) return;

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

    if (VIDSTACK_DEBUG) {
      const wrapperClass = iframe.parentElement ? iframe.parentElement.className : "";
      console.log("Vidstack swap", {
        customer: data.customer,
        videoId: data.videoId,
        hlsUrl: hls,
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
  initial.forEach(replaceIframe);

  const existingPlayers = document.querySelectorAll("media-player");
  existingPlayers.forEach(registerPlayer);

  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType !== 1) return;
        if (node.matches && node.matches('iframe[src*="cloudflarestream.com"]')) {
          replaceIframe(node);
          return;
        }
        if (node.querySelectorAll) {
          const iframes = node.querySelectorAll('iframe[src*="cloudflarestream.com"]');
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
});

document.addEventListener("pointerdown", (e) => {
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
  const card = e.target.closest(".cf-card");
  if (!card) return;
  if (e.relatedTarget && card.contains(e.relatedTarget)) return;
  if (!card.classList.contains("is-playing")) {
    card.classList.remove("is-active");
  }
});

document.querySelectorAll('.feature-tabs.is-tabs-ready')
  .forEach(el => el.classList.remove('is-tabs-ready'));
