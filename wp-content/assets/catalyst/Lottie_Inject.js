(function () {
  function isEditMode() {
    try {
      if (window.FOLEO_EDIT_MODE) return true;
      if (document.documentElement.classList.contains("foleo-edit")) return true;

      var isLoggedIn = (function () {
        try {
          return (
            (document.body &&
              document.body.classList &&
              document.body.classList.contains("logged-in")) ||
            !!document.getElementById("wpadminbar")
          );
        } catch (e) {
          return false;
        }
      })();

      if (document.documentElement.classList.contains("breakdance")) return isLoggedIn;
      if (document.body && document.body.classList.contains("breakdance")) return isLoggedIn;
      if (/^\/cx(\/|$)/.test(window.location.pathname || "")) return true;
      var params = new URLSearchParams(window.location.search || "");
      if (params.has("breakdance") || params.has("bdbuilder") || params.has("breakdance_iframe")) {
        return isLoggedIn;
      }
      if (params.get("foleo_edit") === "1" || params.get("foleo_edit") === "true") {
        return true;
      }
      return false;
    } catch (e) {
      return false;
    }
  }

  if (isEditMode()) return;

  function startIfNeeded() {
    var hasLottie = false;
    try {
      hasLottie = !!document.querySelector(".lottie-scroll-section");
    } catch (e) {
      hasLottie = false;
    }
    if (!hasLottie) return;

    Promise.resolve()
      .then(function () {
        return window.lottie ? Promise.resolve() : inject("https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js");
      })
      .then(function () {
        return window.gsap ? Promise.resolve() : inject("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js");
      })
      .then(function () {
        return window.ScrollTrigger ? Promise.resolve() : inject("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js");
      })
      .catch(function (e) {
        console.error("Global library load failed", e);
      });
  }

  function inject(src) {
    return new Promise(function (resolve, reject) {
      var s = document.createElement("script");
      s.src = src;
      s.async = true;
      s.onload = resolve;
      s.onerror = reject;
      document.head.appendChild(s);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", startIfNeeded, { once: true });
  } else {
    startIfNeeded();
  }
})();
