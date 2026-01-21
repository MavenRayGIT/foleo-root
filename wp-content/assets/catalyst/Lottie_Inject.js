(function () {
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
})();
