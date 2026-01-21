(function () {
  if (window.innerWidth > 767) return;

  // Ensure the global SnapScroll suppression flag exists
  if (typeof window.__FOLEO_SUPPRESS_SNAP__ === "undefined") {
    window.__FOLEO_SUPPRESS_SNAP__ = false;
  }

  let panel = null;

  // Track the panel we moved into the drawer so we can restore it
  let movedPanel = null;
  let movedPanelParent = null;
  let movedPanelNextSibling = null;

  const ARROW_SVG = `
    <svg
      class="arrow-svg"
      viewBox="0 0 27 42"
      xmlns="http://www.w3.org/2000/svg"
      aria-hidden="true"
    >
      <path
        d="M1.13276 1.13276C2.64311 -0.377587 5.09128 -0.377587 6.60162 1.13276L26.1222 20.6515L6.74137 40.0342C5.23107 41.5444 2.78095 41.5444 1.27061 40.0342C-0.239706 38.5239 -0.239653 36.0738 1.27061 34.5635L15.1807 20.6515L1.13276 6.60162C-0.377587 5.09128 -0.377587 2.64311 1.13276 1.13276Z"
        fill="currentColor"
      />
    </svg>
  `;

  // --- Drawer scroll lock (prevents background page scroll) ---
  let __drawerScrollY = 0;

  function lockPageScroll() {
    __drawerScrollY = window.scrollY || window.pageYOffset || 0;
    document.documentElement.classList.add("drawer-scroll-locked");
    document.body.classList.add("drawer-scroll-locked");
    document.body.style.position = "fixed";
    document.body.style.top = `-${__drawerScrollY}px`;
    document.body.style.left = "0";
    document.body.style.right = "0";
    document.body.style.width = "100%";
  }

  function unlockPageScroll() {
    // Temporarily disable smooth scrolling so restoration is instant
    const html = document.documentElement;
    const body = document.body;

    const prevHtmlScrollBehavior = html.style.scrollBehavior;
    const prevBodyScrollBehavior = body.style.scrollBehavior;

    html.style.scrollBehavior = "auto";
    body.style.scrollBehavior = "auto";

    html.classList.remove("drawer-scroll-locked");
    body.classList.remove("drawer-scroll-locked");

    body.style.position = "";
    body.style.top = "";
    body.style.left = "";
    body.style.right = "";
    body.style.width = "";

    // Restore scroll position instantly
    window.scrollTo(0, __drawerScrollY);

    // Restore prior scroll-behavior styles
    html.style.scrollBehavior = prevHtmlScrollBehavior;
    body.style.scrollBehavior = prevBodyScrollBehavior;
  }

  // --- iOS drawer rubberband prevention ---
  let __drawerScrollEl = null;

  function setDrawerScrollEl(p) {
    __drawerScrollEl = p.querySelector(".mobile-slide-panel__scroll") || p;
  }

  function preventRubberband(e) {
    if (!__drawerScrollEl) return;

    // Only block touches that are inside the drawer
    if (!e.target.closest(".mobile-slide-panel")) return;

    const el = __drawerScrollEl;
    const scrollTop = el.scrollTop;
    const scrollHeight = el.scrollHeight;
    const height = el.clientHeight;

    // If it cannot scroll, always prevent bounce
    if (scrollHeight <= height) {
      e.preventDefault();
      return;
    }

    const atTop = scrollTop <= 0;
    const atBottom = scrollTop + height >= scrollHeight;

    // Prevent rubberband only at the edges
    if (atTop || atBottom) e.preventDefault();
  }

  function ensureCardTriggers() {
    document.querySelectorAll(".tab-card[data-panel]").forEach((card) => {
      if (card.querySelector(".tab-card-trigger")) return;

      const trigger = document.createElement("button");
      trigger.className = "tab-card-trigger";
      trigger.type = "button";
      trigger.setAttribute("aria-label", "Open panel");

      trigger.insertAdjacentHTML("beforeend", ARROW_SVG);
      card.appendChild(trigger);
    });
  }

  function closePanel() {
    if (!panel) return;

    panel.classList.remove("is-open");

    // Suppress SnapScroll while we restore scroll position and layout settles
    window.__FOLEO_SUPPRESS_SNAP__ = true;

    unlockPageScroll();

    // Re-enable SnapScroll after the close settles
    setTimeout(() => {
      window.__FOLEO_SUPPRESS_SNAP__ = false;
    }, 500);

    document.removeEventListener("touchmove", preventRubberband, { passive: false });
    __drawerScrollEl = null;

    const panelToRemove = panel;

    // Remove list shift (if applied)
    document
      .querySelectorAll(".tabs-mobile-root.is-shifted")
      .forEach((el) => el.classList.remove("is-shifted"));

    setTimeout(() => {
      // Restore moved panel back to its original location
      if (movedPanel && movedPanelParent) {
        movedPanel.classList.remove("is-active");

        if (
          movedPanelNextSibling &&
          movedPanelNextSibling.parentElement === movedPanelParent
        ) {
          movedPanelParent.insertBefore(movedPanel, movedPanelNextSibling);
        } else {
          movedPanelParent.appendChild(movedPanel);
        }
      }

      panelToRemove.remove();

      // --- Remove overlay ---
      const overlay = panelToRemove.__overlay;
      if (overlay) {
        overlay.remove();
      }

      movedPanel = null;
      movedPanelParent = null;
      movedPanelNextSibling = null;
    }, 350);

    panel = null;
  }

  function openPanel(card, content) {
    const titleText = card.querySelector("h1, h2, h3, h4")?.innerText || "";

    panel = document.createElement("div");
    panel.className = "mobile-slide-panel";

    panel.innerHTML = `
      <div class="mobile-slide-header">
        <button class="mobile-slide-back" type="button" aria-label="Back">
          ${ARROW_SVG}
        </button>
        <h4 class="mobile-slide-title">${titleText}</h4>
      </div>
      <div class="mobile-slide-body"></div>
    `;


    const body = panel.querySelector(".mobile-slide-body");

    // Move the real panel into the drawer (do not clone)
    body.appendChild(content);

    panel.querySelector(".mobile-slide-back").addEventListener("click", closePanel);

    // --- Overlay (dims page behind drawer) ---
    let overlay = document.createElement("div");
    overlay.className = "mobile-slide-overlay";
    overlay.setAttribute("aria-hidden", "true");

    // Click outside drawer closes it
    overlay.addEventListener("click", closePanel);

    // Insert overlay first so it sits behind the panel
    document.body.appendChild(overlay);

    // Store reference so we can remove it later
    panel.__overlay = overlay;
    
    document.body.appendChild(panel);

    requestAnimationFrame(() => {
      if (!panel) return;

      panel.classList.add("is-open");

      // Suppress SnapScroll for the duration the drawer is open
      window.__FOLEO_SUPPRESS_SNAP__ = true;

      lockPageScroll();

      setDrawerScrollEl(panel);

      // Wait one more frame so height + overflow are fully calculated
      requestAnimationFrame(() => {
        if (__drawerScrollEl && __drawerScrollEl.scrollTop === 0) {
          __drawerScrollEl.scrollTop = 1;
        }
      });

      document.addEventListener("touchmove", preventRubberband, { passive: false });
    });
  }

  // Init triggers now and on resize
  ensureCardTriggers();
  window.addEventListener("resize", ensureCardTriggers);

  // ESC closes
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closePanel();
  });

  // Arrow-zone only opens (prevents scroll conflicts)
  document.addEventListener(
    "pointerdown",
    (e) => {
      if (panel) return;

      const trigger = e.target.closest(".tab-card-trigger");
      if (!trigger) return;

      const card = trigger.closest(".tab-card");
      if (!card) return;

      e.preventDefault();
      e.stopPropagation();

      const panelId = card.getAttribute("data-panel");

      // Scope lookup to the current tabs group so repeating IDs work
      const groupRoot =
        card.closest(".feature-tabs") ||
        card.closest(".tabs") ||
        card.closest("section") ||
        document;

      // Clean up: ensure only one expanded panel is active in this group
      groupRoot
        .querySelectorAll(".expanded-panel.is-active, .expanded-panel.active")
        .forEach((p) => p.classList.remove("is-active", "active"));

      const content = groupRoot.querySelector(`[data-panel-content="${panelId}"]`);
      if (!content) return;

      // Mark active (helps keep desktop logic sane)
      content.classList.add("is-active");

      // Remember where it came from so we can restore it later
      movedPanel = content;
      movedPanelParent = content.parentElement;
      movedPanelNextSibling = content.nextElementSibling;

      // Optional: shift list left
      const root =
        card.closest(".tabs") ||
        card.closest(".tabs-container") ||
        card.closest("section") ||
        card.parentElement;

      if (root) root.classList.add("tabs-mobile-root", "is-shifted");

      openPanel(card, content);
    },
    true
  );
})();