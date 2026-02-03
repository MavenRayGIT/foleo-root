(function () {
  "use strict";

  /**
   * Generic Lottie + ScrollTrigger loader
   * - Keeps behavior global and predictable
   * - Allows per-section overrides via data-attributes
   *
   * REQUIRED on each section:
   *   .lottie-scroll-section
   *   data-lottie-url="path-or-url-to.json"
   *   contains a child .lottie-player element
   *
   * OPTIONAL per-section data-attributes:
   *   data-start="top top" | "center center" | etc (default: "center center")
   *   data-end="+=700" | etc (default based on mobile/desktop)
   *   data-scroll-distance="700" (used only if data-end not provided)
   *   data-pin="true|false" (default: true)
   *   data-pin-spacing="true|false" (default: true)
   *   data-scrub="true|false|number" (default: true)
   *   data-markers="true|false" (default: false)
   *
   *   data-size-mode="css|fixed|aspect" (default: "css")
   *     - css: do not set heights in JS (recommended)
   *     - fixed: set player/section height from data-player-height
   *     - aspect: compute height from lottie JSON aspect ratio and section width
   *
   *   data-player-height="520" (px, only used when size-mode="fixed")
   *   data-max-width="900" (px, optional max width for player)
   *   data-width-mode="full|max" (default: "full")
   *     - full: width: 100%
   *     - max:  width: 100% with max-width applied
   *
   *   data-refresh-delay="150" (ms, default: 150) delay before ScrollTrigger.refresh()
   */

  var DEFAULTS = {
    mobileBreakpoint: 767,
    libTimeout: 7000,

    // Scroll defaults
    desktopScrollDistance: 700,
    mobileScrollDistance: 400,
    start: "center center",

    // UX defaults
    markers: false,

    // Sizing defaults
    sizeMode: "css", // css | fixed | aspect
    widthMode: "full", // full | max
    maxWidth: 900,
    refreshDelay: 150
  };

  function toBool(val, fallback) {
    if (val === null || val === undefined || val === "") return fallback;
    if (typeof val === "boolean") return val;
    return String(val).toLowerCase() === "true";
  }

  function toNumber(val, fallback) {
    var n = parseFloat(val);
    return isFinite(n) ? n : fallback;
  }

  function isMobile() {
    return window.innerWidth <= DEFAULTS.mobileBreakpoint;
  }

  function waitForLibs(maxMs) {
    var start = Date.now();
    return new Promise(function (resolve, reject) {
      (function check() {
        if (window.lottie && window.gsap && window.ScrollTrigger) {
          resolve();
          return;
        }
        if (Date.now() - start > maxMs) {
          reject(new Error("Timeout waiting for libraries (lottie/gsap/ScrollTrigger)"));
          return;
        }
        setTimeout(check, 50);
      })();
    });
  }

  function loadLottieForSection(section) {
    return new Promise(function (resolve) {
      var url = section.getAttribute("data-lottie-url");
      if (!url) return resolve(null);

      // Prevent double init
      if (section.dataset.lottieInit === "1") return resolve(null);
      section.dataset.lottieInit = "1";

      var player = section.querySelector(".lottie-player");
      if (!player) return resolve(null);

      var anim = lottie.loadAnimation({
        container: player,
        renderer: "svg",
        loop: false,
        autoplay: false,
        path: url,
        rendererSettings: { preserveAspectRatio: "xMidYMid meet" }
      });

      anim.addEventListener("DOMLoaded", function () {
        resolve({ section: section, player: player, anim: anim });
      });

      anim.addEventListener("data_failed", function () {
        console.error("Lottie failed to load:", url);
        resolve(null);
      });
    });
  }

  function applySizing(data) {
    var section = data.section;
    var player = data.player;
    var anim = data.anim;

    var mode = section.getAttribute("data-size-mode") || DEFAULTS.sizeMode;
    var widthMode = section.getAttribute("data-width-mode") || DEFAULTS.widthMode;

    var maxWidth = toNumber(section.getAttribute("data-max-width"), DEFAULTS.maxWidth);

    // Default: let CSS handle it (recommended)
    if (mode === "css") {
      // Optionally enforce a max-width style
      if (widthMode === "max") {
        player.style.width = "100%";
        player.style.maxWidth = maxWidth + "px";
      }
      return;
    }

    // Fixed height from attribute
    if (mode === "fixed") {
      var h = toNumber(section.getAttribute("data-player-height"), 0);
      if (h > 0) {
        player.style.height = h + "px";
        section.style.height = h + "px";

        if (widthMode === "max") {
          player.style.width = "100%";
          player.style.maxWidth = maxWidth + "px";
        } else {
          player.style.width = "100%";
        }
      }
      return;
    }

    // Aspect ratio sizing from JSON
    if (mode === "aspect") {
      var animData = anim.animationData;
      var jsonW = animData ? animData.w : 0;
      var jsonH = animData ? animData.h : 0;
      var aspect = (jsonW && jsonH) ? (jsonW / jsonH) : 1;

      // Use current section width to compute height
      var rect = section.getBoundingClientRect();
      var w = rect.width;

      if (w <= 0) w = isMobile() ? (window.innerWidth - 40) : 800;

      // If widthMode is max, cap the width used for height calc
      var usedW = (widthMode === "max") ? Math.min(w, maxWidth) : w;
      var h2 = usedW / aspect;

      player.style.width = "100%";
      if (widthMode === "max") player.style.maxWidth = maxWidth + "px";
      player.style.height = Math.round(h2) + "px";
      section.style.height = Math.round(h2) + "px";
    }
  }

  function readScrollConfig(section) {
    var mobile = isMobile();

    var distance = toNumber(
      section.getAttribute("data-scroll-distance"),
      mobile ? DEFAULTS.mobileScrollDistance : DEFAULTS.desktopScrollDistance
    );

    var start = section.getAttribute("data-start") || DEFAULTS.start;
    var endAttr = section.getAttribute("data-end");
    var end = endAttr ? endAttr : ("+=" + distance);

    var pin = toBool(section.getAttribute("data-pin"), true);
    var pinSpacing = toBool(section.getAttribute("data-pin-spacing"), true);

    // scrub: true/false/number
    var scrubAttr = section.getAttribute("data-scrub");
    var scrub;
    if (scrubAttr === null || scrubAttr === undefined || scrubAttr === "") {
      scrub = true;
    } else if (String(scrubAttr).toLowerCase() === "true") {
      scrub = true;
    } else if (String(scrubAttr).toLowerCase() === "false") {
      scrub = false;
    } else {
      scrub = toNumber(scrubAttr, true);
    }

    var markers = toBool(section.getAttribute("data-markers"), DEFAULTS.markers);

    return {
      start: start,
      end: end,
      pin: pin,
      pinSpacing: pinSpacing,
      scrub: scrub,
      markers: markers
    };
  }

 function setupScrollTrigger(data) {
  if (!data) return;

  var section = data.section;
  var anim = data.anim;

  // Always show first frame
  anim.goToAndStop(0, true);

  // Apply sizing rules (yours are already minimal)
  applySizing(data);

  var totalFrames = anim.totalFrames || 1;
  var cfg = readScrollConfig(section);

  // If the section sits inside a wrapper, pin the wrapper so header + animation stay together
  var group = section.closest(".lottie-pin-group");
  var pinTarget = group || section;

  ScrollTrigger.create({
    trigger: pinTarget,
    start: cfg.start,
    end: cfg.end,

    // If we found a wrapper, always pin it
    pin: group ? true : cfg.pin,
    pinSpacing: cfg.pinSpacing,

    scrub: cfg.scrub,
    markers: cfg.markers,
    invalidateOnRefresh: true,

    onUpdate: function (self) {
      var frame = Math.floor(self.progress * (totalFrames - 1));
      anim.goToAndStop(frame, true);
    }
  });
}

  function initLenisIfPresent() {
    // If Lenis is not present, do nothing.
    if (!window.Lenis) return null;

    // Avoid double init
    if (window.__FOLEO_LENIS_INIT__) return window.lenis || null;
    window.__FOLEO_LENIS_INIT__ = true;

    var lenis = new Lenis({
      duration: 1.2,
      easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
      orientation: "vertical",
      gestureOrientation: "vertical",
      smoothWheel: true,
      wheelMultiplier: 1,
      touchMultiplier: 2,
      infinite: false
    });

    // Tell ScrollTrigger to update when Lenis scrolls
    lenis.on("scroll", ScrollTrigger.update);

    // Drive Lenis via GSAP ticker
    gsap.ticker.add(function (time) {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    window.lenis = lenis;
    return lenis;
  }

  function init() {
    waitForLibs(DEFAULTS.libTimeout)
      .then(function () {
        gsap.registerPlugin(ScrollTrigger);

        initLenisIfPresent();

        var sections = document.querySelectorAll(".lottie-scroll-section");
        if (!sections.length) return;

        var loadPromises = [];
        sections.forEach(function (section) {
          loadPromises.push(loadLottieForSection(section));
        });

        Promise.all(loadPromises).then(function (results) {
          results.forEach(setupScrollTrigger);

          // Refresh after everything is laid out
          var delay = DEFAULTS.refreshDelay;
          // If any section specifies a higher delay, use the max
          sections.forEach(function (s) {
            var d = toNumber(s.getAttribute("data-refresh-delay"), DEFAULTS.refreshDelay);
            if (d > delay) delay = d;
          });

          setTimeout(function () {
            ScrollTrigger.refresh();
          }, delay);
        });

        // Optional: refresh on resize/orientation changes
        var resizeTimer = null;
        window.addEventListener("resize", function () {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(function () {
            ScrollTrigger.refresh();
          }, 200);
        });
      })
      .catch(function (e) {
        console.error("Lottie init error:", e);
      });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();

