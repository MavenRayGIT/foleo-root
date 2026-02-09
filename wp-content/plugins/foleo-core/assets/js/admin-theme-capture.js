(() => {
  const cfg = window.FOLEO_ADMIN_THEME_CAPTURE;
  if (!cfg) return;

  const toHex = (value) => {
    if (!value) return '';
    if (value.startsWith('#')) return value;
    const match = value.match(/rgba?\(([^)]+)\)/);
    if (!match) return value;
    const parts = match[1].split(',').map((p) => p.trim());
    if (parts.length < 3) return value;
    const r = parseInt(parts[0], 10);
    const g = parseInt(parts[1], 10);
    const b = parseInt(parts[2], 10);
    const a = parts[3] !== undefined ? parseFloat(parts[3]) : 1;
    if (Number.isNaN(r) || Number.isNaN(g) || Number.isNaN(b)) return value;
    if (a < 1) {
      return `rgba(${r}, ${g}, ${b}, ${a})`;
    }
    return `#${[r, g, b].map((c) => c.toString(16).padStart(2, '0')).join('')}`;
  };

  const hashString = (str) => {
    let hash = 0;
    for (let i = 0; i < str.length; i += 1) {
      hash = ((hash << 5) - hash) + str.charCodeAt(i);
      hash |= 0;
    }
    return `${hash}`;
  };

  const findToolbarButtons = () => {
    const candidates = Array.from(document.querySelectorAll('button, a, [role="button"]'))
      .map((el) => ({ el, rect: el.getBoundingClientRect() }))
      .filter(({ rect }) =>
        rect.width >= 20 &&
        rect.width <= 48 &&
        rect.height >= 20 &&
        rect.height <= 48 &&
        rect.top >= 0 &&
        rect.top <= 80 &&
        rect.left >= 0 &&
        rect.left <= 200
      )
      .sort((a, b) => a.rect.left - b.rect.left);
    return candidates.map((item) => item.el);
  };

  const findPanel = () => {
    const nodes = Array.from(document.querySelectorAll('div'));
    const candidates = nodes.map((el) => {
      const rect = el.getBoundingClientRect();
      return { el, rect };
    }).filter(({ rect }) =>
      rect.width >= 220 &&
      rect.width <= 460 &&
      rect.height >= 200 &&
      rect.left >= 0 &&
      rect.left <= 200 &&
      rect.top >= 0 &&
      rect.top <= 120
    );
    return candidates.length ? candidates[0].el : null;
  };

  const getComputed = (el) => window.getComputedStyle(el);

  const panel = findPanel();
  const toolbarButtons = findToolbarButtons();
  const toolbarBtn = toolbarButtons[0] || null;
  const primaryBtn = Array.from(document.querySelectorAll('button'))
    .find((btn) => (btn.textContent || '').trim().toLowerCase() === 'save') || toolbarButtons[1] || null;
  const input = panel ? panel.querySelector('input, textarea, select') : document.querySelector('input, textarea, select');
  const label = panel ? panel.querySelector('label') : document.querySelector('label');

  if (!panel || !toolbarBtn || !input || !label) {
    return;
  }

  const panelStyle = getComputed(panel);
  const btnStyle = getComputed(toolbarBtn);
  const primaryStyle = primaryBtn ? getComputed(primaryBtn) : btnStyle;
  const inputStyle = getComputed(input);
  const labelStyle = getComputed(label);

  const tokens = {
    'foleo-bg': toHex(panelStyle.backgroundColor),
    'foleo-surface': toHex(panelStyle.backgroundColor),
    'foleo-border': toHex(panelStyle.borderColor),
    'foleo-text': toHex(panelStyle.color),
    'foleo-text-muted': toHex(labelStyle.color),
    'foleo-accent': toHex(primaryStyle.backgroundColor),
    'foleo-accent-contrast': toHex(primaryStyle.color),
    'foleo-control-bg': toHex(inputStyle.backgroundColor),
    'foleo-control-border': toHex(inputStyle.borderColor),
    'foleo-control-text': toHex(inputStyle.color),
    'foleo-font-family': panelStyle.fontFamily,
    'foleo-font-size-base': panelStyle.fontSize,
    'foleo-radius-sm': inputStyle.borderRadius,
    'foleo-overlay-bg': toHex(panelStyle.backgroundColor),
    'foleo-overlay-border': toHex(panelStyle.borderColor),
    'foleo-backdrop': 'rgba(15, 23, 42, 0.7)'
  };

  const defaults = cfg.defaults || {};
  Object.keys(defaults).forEach((key) => {
    if (!tokens[key]) {
      tokens[key] = defaults[key];
    }
  });

  const cssVars = Object.keys(tokens).map((key) => `--${key}:${tokens[key]};`).join('');
  const checksum = hashString(JSON.stringify(tokens));

  const required = Array.isArray(cfg.required) ? cfg.required : [];
  const missing = required.filter((key) => !tokens[key]);
  if (missing.length) {
    alert('Theme capture failed: missing required tokens.');
    return;
  }

  fetch(cfg.restUrl, {
    method: 'POST',
    credentials: 'same-origin',
    headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': cfg.nonce },
    body: JSON.stringify({
      tokens,
      css: cssVars,
      checksum,
      schema_version: cfg.schemaVersion,
      breakdance_version: window.Breakdance && window.Breakdance.subscriptionMode ? window.Breakdance.subscriptionMode : ''
    })
  })
    .then((res) => res.json())
    .then(() => {
      if (cfg.returnUrl) {
        window.location.href = cfg.returnUrl;
      }
    })
    .catch(() => {
      alert('Theme capture failed.');
    });
})();
