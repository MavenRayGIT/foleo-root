(() => {
  if (window.innerWidth <= 767) return;

  const sections = Array.from(document.querySelectorAll(".scroll-section, .scroll-section-auto"));
  if (!sections.length) return;

  const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (prefersReduced) return;

  let timer = null;
  let isAutoScrolling = false;

  const isSnapSuppressed = () => {
  // Allow any script (like your drawer) to suppress snapping temporarily
  return window.__FOLEO_SUPPRESS_SNAP__ === true;
};

  const getSectionTops = () => sections.map(s => s.getBoundingClientRect().top + window.scrollY);

  const smoothScrollTo = (y) => {
  if (isSnapSuppressed()) return;

  isAutoScrolling = true;
  window.scrollTo({ top: y, behavior: "smooth" });

  setTimeout(() => { isAutoScrolling = false; }, 600);
};

  const snapToNearest = () => {
    if (isAutoScrolling) return;

    const tops = getSectionTops();
    const y = window.scrollY;

    // Find nearest section top
    let nearest = tops[0];
    let best = Math.abs(y - tops[0]);

    for (let i = 1; i < tops.length; i++) {
      const d = Math.abs(y - tops[i]);
      if (d < best) { best = d; nearest = tops[i]; }
    }

    // Only snap if you're reasonably close, so it still feels natural
    const threshold = Math.min(window.innerHeight * 0.35, 320);
    if (best < threshold) smoothScrollTo(nearest);
  };

  window.addEventListener("scroll", () => {
  if (isAutoScrolling) return;
  if (isSnapSuppressed()) return;

  clearTimeout(timer);
  timer = setTimeout(snapToNearest, 140);
}, { passive: true });

  // Recompute on resize
  window.addEventListener("resize", () => {
    clearTimeout(timer);
  });
})();
