

// to make the GDPR link to HCG site in new tab //

function getQueryParam(name) {
  try {
    return new URLSearchParams(window.location.search).get(name);
  } catch (e) {
    return null;
  }
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

function lockFoleoVnav(ms) {
  foleoVnavLockUntil = Date.now() + ms;
}

function isFoleoVnavLocked() {
  return Date.now() < foleoVnavLockUntil;
}

function buildFoleoVnav() {
  const state = window.getFoleoNavState?.();
  if (!state || state.mode !== 'binder') return;

  const mount = document.querySelector('[data-foleo-vnav]');
  if (!mount) return;

  const sections = Array.from(document.querySelectorAll('section[id]'));

  // If sections are not present yet, do not wipe the mount.
  if (!sections.length) {
    mount.style.display = 'none';
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
  const items = document.querySelectorAll('.foleo-vnav__item');
  items.forEach((a) => {
    const href = a.getAttribute('href') || '';
    const id = href.startsWith('#') ? href.slice(1) : '';
    a.classList.toggle('is-active', id === activeId);
  });
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

  const initial = (location.hash || '').replace('#', '').trim();
  if (initial) activateFoleoVnavDot(initial);

  if (!document.querySelector('.foleo-vnav__item.is-active')) {
    const first = document.querySelector('.foleo-vnav__item');
    if (first) {
      const href = first.getAttribute('href') || '';
      const id = href.startsWith('#') ? href.slice(1) : '';
      if (id) activateFoleoVnavDot(id);
    }
  }

  const obs = new IntersectionObserver((entries) => {
    if (isFoleoVnavLocked()) return;

    const candidates = entries.filter((e) => e.isIntersecting && e.target && e.target.id);
    if (!candidates.length) return;

    const targetY = 120;
    const winner = candidates
      .map((e) => ({ id: e.target.id, top: e.target.getBoundingClientRect().top }))
      .sort((a, b) => Math.abs(a.top - targetY) - Math.abs(b.top - targetY))[0];

    if (winner?.id) activateFoleoVnavDot(winner.id);
  }, {
    root: null,
    rootMargin: '-10% 0px -70% 0px',
    threshold: [0, 0.1, 0.2, 0.3]
  });

  sections.forEach((sec) => obs.observe(sec));

  window.addEventListener('hashchange', () => {
    const id = (location.hash || '').replace('#', '').trim();
    if (id) activateFoleoVnavDot(id);
  });
}


document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll(
      '.cmplz-cookiebanner a[href], .cmplz-cookiebanner a.cmplz-document'
    )
    .forEach(function (link) {
      link.setAttribute('target', '_blank');
      link.setAttribute('rel', 'noopener noreferrer');
    });
});

document.addEventListener('DOMContentLoaded', () => {
  const state = window.getFoleoNavState?.();
  const switcher = document.querySelector('[data-foleo-switcher]');
  const vnav = document.querySelector('[data-foleo-vnav]');
  if (!state || !switcher || state.mode === 'standalone') {
    if (switcher) switcher.style.display = 'none';
    const hamburger = document.querySelector('.hamburger');
    if (hamburger) hamburger.style.display = 'none';
    if (vnav) vnav.style.display = 'none';
    document.documentElement.classList.add('foleo-standalone');
    return;
  }

  document.documentElement.classList.remove('foleo-standalone');
  buildFoleoSwitcher();
  buildFoleoVnav();
  setTimeout(buildFoleoSwitcher, 250);
  setTimeout(buildFoleoVnav, 250);
  setTimeout(buildFoleoVnav, 1000);
  setTimeout(initFoleoVnavActiveTracking, 0);
  setTimeout(initFoleoVnavActiveTracking, 500);

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

document.addEventListener("DOMContentLoaded", () => {
  const iframes = document.querySelectorAll('iframe[class*="vid"]');
  if (!iframes.length) return;

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
});


document.querySelectorAll('.feature-tabs.is-tabs-ready')
  .forEach(el => el.classList.remove('is-tabs-ready'));

// Vidstack Stream Replacement
document.addEventListener("DOMContentLoaded", function () {
  const VIDSTACK_DEBUG = false;
  const playingPlayers = new Set();

  function setNavHidden(hidden) {
    document.documentElement.classList.toggle("foleo-video-playing", hidden);
  }

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
      setNavHidden(true);
    });

    const handleStop = () => {
      playingPlayers.delete(player);
      if (!playingPlayers.size) setNavHidden(false);
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
      if (!playingPlayers.size) {
        setNavHidden(false);
        return;
      }

      setNavHidden(false);
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
