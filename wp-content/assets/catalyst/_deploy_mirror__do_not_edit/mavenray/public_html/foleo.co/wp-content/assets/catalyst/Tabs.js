(() => {
  const tabSets = document.querySelectorAll(".feature-tabs");

  tabSets.forEach(set => {
    const row = set.querySelector(".row-grid");
    const cards = Array.from(set.querySelectorAll(".tab-card[data-panel]"));
    const panels = Array.from(set.querySelectorAll(".row-expanded [data-panel-content]"));

    if (!row || !cards.length || !panels.length) return;
      set.classList.add("is-tabs-ready");

    const showPanel = (id) => {
      panels.forEach(p => p.classList.remove("is-active"));
      const target = set.querySelector(`.row-expanded [data-panel-content="${id}"]`);
      if (target) target.classList.add("is-active");
    };

    const setActiveCard = (card) => {
      cards.forEach(c => {
        c.classList.remove("is-active");
        c.classList.remove("is-hover");
      });
      card.classList.add("is-active");
    };

    // default state
    setActiveCard(cards[0]);
    showPanel(cards[0].getAttribute("data-panel"));

    cards.forEach(card => {
       card.addEventListener("click", (e) => {
        e.preventDefault();
        const id = card.getAttribute("data-panel");
        setActiveCard(card);
        showPanel(id);
      });
      card.addEventListener("mouseenter", () => {
        const id = card.getAttribute("data-panel");
        setActiveCard(card);
        card.classList.add("is-hover");
        showPanel(id);
      });

      card.addEventListener("mouseleave", () => {
        card.classList.remove("is-hover");
      });
    });

    row.addEventListener("mouseleave", () => {
      const active = row.querySelector(".tab-card.is-active");
      if (active) active.classList.remove("is-hover");
    });
  });
})();
