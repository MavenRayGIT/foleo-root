

// to make the GDPR link to HCG site in new tab //


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