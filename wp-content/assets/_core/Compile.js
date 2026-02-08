function initFoleoCompileMode() {
  const isCompile = new URLSearchParams(location.search).get('compile') === '1';
  if (!isCompile) return;

  const body = document.body;
  if (!body) return;

  body.classList.add('foleo-compile-mode');

  if (window.FOLEO_COMPILE_IS_ADMIN === 1) {
    body.classList.add('foleo-compile-admin');
    const adminBar = document.getElementById('wpadminbar');
    const fallbackHeight = window.innerWidth <= 782 ? 46 : 32;
    const height = adminBar ? adminBar.offsetHeight : fallbackHeight;
    body.style.setProperty('--foleo-compile-adminbar-height', `${height}px`);
  }

  if (window.innerWidth < 900) {
    let blocker = document.getElementById('foleo-compile-blocker');
    if (!blocker) {
      blocker = document.createElement('div');
      blocker.id = 'foleo-compile-blocker';
      blocker.innerHTML =
        '<div class="foleo-compile-blocker__panel">' +
        '<div class="foleo-compile-blocker__title">Compile mode is desktop-only</div>' +
        '<div class="foleo-compile-blocker__body">Please use a wider screen to edit compile targets.</div>' +
        '<button type="button" class="foleo-compile-blocker__exit">Exit compile</button>' +
        '</div>';
      body.appendChild(blocker);
      const exitBtn = blocker.querySelector('.foleo-compile-blocker__exit');
      if (exitBtn) {
        exitBtn.addEventListener('click', () => {
          const url = new URL(window.location.href);
          url.searchParams.delete('compile');
          url.searchParams.delete('fresh');
          window.location.href = url.toString();
        });
      }
    }
    return;
  }

  let scrim = document.getElementById('foleo-compile-scrim');
  if (!scrim) {
    scrim = document.createElement('div');
    scrim.id = 'foleo-compile-scrim';
    body.appendChild(scrim);
  }

  let overlay = document.getElementById('foleo-compile-overlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'foleo-compile-overlay';
    body.appendChild(overlay);
  }
  overlay.innerHTML = '';

  const LINEARIZE_STORAGE_KEY = 'foleo_compile_linearize';
  const getLinearizeEnabled = () => {
    try {
      const stored = sessionStorage.getItem(LINEARIZE_STORAGE_KEY);
      if (stored === '0') return false;
    } catch (e) {}
    return true;
  };
  const setLinearizeEnabled = (enabled) => {
    if (!body) return;
    body.classList.toggle('foleo-compile-linearize-on', enabled);
    try {
      sessionStorage.setItem(LINEARIZE_STORAGE_KEY, enabled ? '1' : '0');
    } catch (e) {}
  };
  const removeLinearizeLabels = () => {
    document.querySelectorAll('.foleo-compile-panel-label').forEach((label) => {
      const parent = label.parentElement;
      label.remove();
      if (parent) parent.removeAttribute('data-foleo-compile-labeled');
    });
  };

  const linearizeInteractiveContent = () => {
    if (!getLinearizeEnabled()) return;
    if (body) {
      body.classList.add('foleo-compile-linearized');
      body.setAttribute('data-foleo-linearized', '1');
    }

    let tabsCount = 0;
    let accordionsCount = 0;
    let slidersCount = 0;

    const linearizeRoots = new Set();
    const compileTargetSelector =
      '[data-compile-linearize="1"], .compile-type, .compile-video, .compile-image, .compile-table, .compile-lottie';

    document.querySelectorAll(compileTargetSelector).forEach((el) => {
      if (!(el instanceof Element)) return;
      const root =
        el.closest('[data-compile-linearize="1"]') ||
        el.closest('.compile-type, .compile-video, .compile-image, .compile-table, .compile-lottie') ||
        el.closest('section, .breakdance-section, [data-vnav]') ||
        el;
      if (!root) return;
      root.classList.add('foleo-compile-linearize-scope');
      root.setAttribute('data-foleo-linearized', '1');
      linearizeRoots.add(root);
    });

    linearizeRoots.forEach((root) => {
      const tabSets = Array.from(root.querySelectorAll('.feature-tabs'));
      tabSets.forEach((set) => {
        const cards = Array.from(set.querySelectorAll('.tab-card[data-panel]'));
        const panels = Array.from(
          set.querySelectorAll('.row-expanded [data-panel-content]')
        );
        if (!cards.length || !panels.length) return;

        if (set.dataset.foleoLinearized === '1') return;
        set.dataset.foleoLinearized = '1';
        tabsCount += 1;

        const cardByPanel = new Map();
        cards.forEach((card) => {
          const id = card.getAttribute('data-panel');
          if (id) cardByPanel.set(id, card);
        });

        panels.forEach((panel) => {
          if (panel.dataset.foleoCompileLabeled === '1') return;
          const existingLabel = panel.querySelector(
            ':scope > .foleo-compile-panel-label'
          );
          if (existingLabel) {
            panel.dataset.foleoCompileLabeled = '1';
            return;
          }
          const id = panel.getAttribute('data-panel-content');
          const labelText = id ? cardByPanel.get(id)?.textContent?.trim() : '';
          if (!labelText) return;
          const label = document.createElement('div');
          label.className = 'foleo-compile-panel-label';
          label.textContent = labelText;
          panel.insertBefore(label, panel.firstChild);
          panel.dataset.foleoCompileLabeled = '1';
        });
      });

      root.querySelectorAll('.foleo-accordion-block').forEach((block) => {
        if (block.dataset.foleoLinearized === '1') return;
        block.dataset.foleoLinearized = '1';
        accordionsCount += 1;
      });

      root
        .querySelectorAll('.bde-accordion, .bde-loop-accordion')
        .forEach((accordion) => {
          if (accordion.dataset.foleoLinearized === '1') return;
          accordion.dataset.foleoLinearized = '1';
          accordionsCount += 1;
        });

      root
        .querySelectorAll(
          '.bde-basicslider, .bde-advancedslider, .bde-loop-slider, .ee-gallery--slider, .ee-gallery-swiper, .swiper'
        )
        .forEach((slider) => {
          if (slider.dataset.foleoLinearized === '1') return;
          slider.dataset.foleoLinearized = '1';
          slidersCount += 1;
        });
    });

    console.log('[compile] linearize applied', {
      tabs: tabsCount,
      accordions: accordionsCount,
      sliders: slidersCount
    });
  };

  setLinearizeEnabled(getLinearizeEnabled());
  linearizeInteractiveContent();

  document.addEventListener(
    'breakdance_popup_open',
    () => {
      linearizeInteractiveContent();
    },
    true
  );

  const targets = Array.from(
    document.querySelectorAll(
      '.compile-type, .compile-video, .compile-image, .compile-table, .compile-lottie'
    )
  );
  console.log('[compile] enabled', { targets: targets.length });
  if (!targets.length) return;

  const keyCounts = new Map();
  const readKey = (value) => {
    if (typeof value !== 'string') return null;
    const trimmed = value.trim();
    return trimmed ? trimmed : null;
  };
  const escapeHtml = (value) => {
    const str = String(value ?? '');
    return str
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  };
  const catalogTypeSlots = (scopeEl) => {
    if (!scopeEl) {
      return {
        eyebrow: null,
        header: null,
        subheader: null,
        body: null,
        list: null
      };
    }
    const selector =
      'h1,h2,h3,h4,h5,h6,' +
      '.bd-rich-text,.bde-rich-text,' +
      '.bde-text,.bde-text__content,.bde-text-content,.bde-text-basic,' +
      '[data-bde="text"],[data-bde="text-basic"],' +
      'p,ul,ol';
    const nodes = Array.from(scopeEl.querySelectorAll(selector));
    if (scopeEl.matches(selector)) {
      nodes.unshift(scopeEl);
    }
    const isBodyNode = (node) =>
      node.matches(
        '.bd-rich-text,.bde-rich-text,' +
          '.bde-text,.bde-text__content,.bde-text-content,.bde-text-basic,' +
          '[data-bde="text"],[data-bde="text-basic"],p'
      );
    const eyebrow = nodes.find((node) => node.matches('h6')) || null;
    const header = nodes.find((node) => node.matches('h1,h2')) || null;
    const headerIndex = header ? nodes.indexOf(header) : -1;
    const afterHeader = headerIndex >= 0 ? nodes.slice(headerIndex + 1) : nodes;
    const subheader =
      afterHeader.find((node) => node.matches('h2,h3,h4,h5')) || null;
    const body = afterHeader.find(isBodyNode) || nodes.find(isBodyNode) || null;
    const list =
      afterHeader.find((node) => node.matches('ul,ol')) ||
      nodes.find((node) => node.matches('ul,ol')) ||
      null;
    return {
      eyebrow,
      header,
      subheader,
      body,
      list
    };
  };
  const getSectionId = (el) => {
    const section = el.closest('section[id]');
    const sectionId = section ? readKey(section.id) : null;
    if (sectionId) return sectionId;

    const breakdanceSection = el.closest('.breakdance-section[id]');
    const breakdanceId = breakdanceSection ? readKey(breakdanceSection.id) : null;
    if (breakdanceId) return breakdanceId;

    const vnavSection = el.closest('[data-vnav][id]');
    const vnavId = vnavSection ? readKey(vnavSection.id) : null;
    if (vnavId) return vnavId;

    const parentWithId = el.closest('[id]');
    return parentWithId ? readKey(parentWithId.id) : null;
  };
  const keyStats = { override: 0, section: 0, fallback: 0 };
  const resolveKey = (el, index) => {
    const override = readKey(el.getAttribute('data-compile-key'));
    if (override) {
      keyStats.override += 1;
      return override;
    }
    const sectionId = getSectionId(el);
    if (sectionId) {
      keyStats.section += 1;
      return sectionId;
    }
    const directId = readKey(el.id);
    if (directId) return directId;
    keyStats.fallback += 1;
    return `compile_${index + 1}`;
  };
  const dedupeKey = (baseKey) => {
    const count = (keyCounts.get(baseKey) || 0) + 1;
    keyCounts.set(baseKey, count);
    return count === 1 ? baseKey : `${baseKey}--${count}`;
  };

  const resolvedKeys = new Map();
  targets.forEach((el, index) => {
    const baseKey = resolveKey(el, index);
    const finalKey = dedupeKey(baseKey);
    el.setAttribute('data-compile-key-resolved', finalKey);
    resolvedKeys.set(el, finalKey);
  });
  console.log('[compile] key stats', {
    override: keyStats.override,
    section: keyStats.section,
    fallback: keyStats.fallback
  });

  const resolveType = (el) => {
    if (el.classList.contains('compile-video')) return 'video';
    if (el.classList.contains('compile-image')) return 'image';
    if (el.classList.contains('compile-table')) return 'table';
    if (el.classList.contains('compile-lottie')) return 'lottie';
    return 'type';
  };

  const compileState =
    window.__FOLEO_COMPILE_STATE__ &&
    typeof window.__FOLEO_COMPILE_STATE__ === 'object'
      ? window.__FOLEO_COMPILE_STATE__
      : { sections: {} };
  window.__FOLEO_COMPILE_STATE__ = compileState;

  const HERO_META_KEYS = {
    header: 'foleo_hero_gallery1_header',
    body: 'foleo_hero_gallery1_body'
  };

  const isHeroGallery1 = (el) => !!(el && el.closest('.hero-gallery1'));

  const getPageId = () => {
    if (typeof window.breakdancePostId !== 'undefined') {
      const raw = window.breakdancePostId;
      const parsed = parseInt(raw, 10);
      if (!Number.isNaN(parsed)) return parsed;
    }
    const bodyEl = document.body;
    if (bodyEl) {
      const dataId =
        bodyEl.getAttribute('data-post-id') ||
        bodyEl.getAttribute('data-page-id');
      if (dataId) {
        const parsed = parseInt(dataId, 10);
        if (!Number.isNaN(parsed)) return parsed;
      }
      const classMatch = bodyEl.className.match(/page-id-(\d+)/);
      if (classMatch) {
        const parsed = parseInt(classMatch[1], 10);
        if (!Number.isNaN(parsed)) return parsed;
      }
    }
    return null;
  };

  const getRestNonce = () => {
    if (window.wpApiSettings && window.wpApiSettings.nonce) {
      return window.wpApiSettings.nonce;
    }
    const meta = document.querySelector('meta[name="wp-rest-nonce"]');
    if (meta && meta.content) return meta.content;
    return null;
  };

  const persistHeroMeta = (slots) => {
    const pageId = getPageId();
    if (!pageId) {
      console.warn('[compile] meta save skipped (missing page id)');
      return;
    }
    const nonce = getRestNonce();
    if (!nonce) {
      console.warn('[compile] meta save skipped (missing wp nonce)');
      return;
    }

    const meta = {};
    if (slots.header) {
      meta[HERO_META_KEYS.header] = slots.header.innerText || '';
    }
    if (slots.body) {
      meta[HERO_META_KEYS.body] = slots.body.innerText || '';
    }
    if (!Object.keys(meta).length) return;

    fetch(`${location.origin}/wp-json/wp/v2/pages/${pageId}`, {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      },
      body: JSON.stringify({ meta })
    })
      .then(async (res) => {
        if (!res.ok) {
          const text = await res.text();
          console.warn('[compile] meta save failed', res.status, text);
          return;
        }
        console.log('[compile] meta saved', { pageId });
      })
      .catch((err) => {
        console.warn('[compile] meta save failed', err);
      });
  };

  let hudEls = null;
  const ensureHud = () => {
    if (hudEls) return hudEls;
    let hud = document.getElementById('foleo-compile-hud');
    if (!hud) {
      hud = document.createElement('div');
      hud.id = 'foleo-compile-hud';
      hud.style.cssText =
        'position:fixed;right:16px;bottom:16px;z-index:var(--foleo-compile-z);' +
        'background:#111;color:#fff;padding:12px;border-radius:8px;' +
        'width:300px;max-width:90vw;font:14px/1.4 sans-serif;';
      body.appendChild(hud);
    }

    let versionEl = hud.querySelector('#foleo-compile-version');
    if (!versionEl) {
      versionEl = document.createElement('div');
      versionEl.id = 'foleo-compile-version';
      versionEl.style.cssText = 'font-size:12px;opacity:0.7;margin-bottom:8px;';
      hud.appendChild(versionEl);
    }

    let slotSelect = hud.querySelector('#foleo-compile-slot');
    if (!slotSelect) {
      slotSelect = document.createElement('select');
      slotSelect.id = 'foleo-compile-slot';
      slotSelect.style.cssText = 'width:100%;margin-bottom:8px;';
      hud.appendChild(slotSelect);
    }

    let linearizeToggle = hud.querySelector('#foleo-compile-linearize');
    if (!linearizeToggle) {
      const wrap = document.createElement('label');
      wrap.style.cssText =
        'display:flex;align-items:center;gap:8px;margin-bottom:8px;cursor:pointer;';
      linearizeToggle = document.createElement('input');
      linearizeToggle.type = 'checkbox';
      linearizeToggle.id = 'foleo-compile-linearize';
      linearizeToggle.style.cssText = 'margin:0;';
      const text = document.createElement('span');
      text.textContent = 'Linearize';
      wrap.appendChild(linearizeToggle);
      wrap.appendChild(text);
      hud.appendChild(wrap);
    }

    linearizeToggle.checked = getLinearizeEnabled();
    linearizeToggle.onchange = () => {
      const enabled = linearizeToggle.checked;
      setLinearizeEnabled(enabled);
      if (enabled) {
        linearizeInteractiveContent();
      } else {
        removeLinearizeLabels();
      }
    };

    let textarea = hud.querySelector('textarea');
    if (!textarea) {
      textarea = document.createElement('textarea');
      textarea.id = 'foleo-compile-text';
      textarea.style.cssText =
        'width:100%;min-height:120px;margin-bottom:8px;';
      hud.appendChild(textarea);
    }

    let saveBtn = hud.querySelector('#foleo-compile-save');
    if (!saveBtn) {
      saveBtn = document.createElement('button');
      saveBtn.type = 'button';
      saveBtn.id = 'foleo-compile-save';
      saveBtn.textContent = 'Save';
      saveBtn.style.cssText = 'width:100%;padding:8px 10px;cursor:pointer;';
      hud.appendChild(saveBtn);
    }

    hudEls = { hud, versionEl, slotSelect, textarea, saveBtn };
    return hudEls;
  };

  const hideHud = () => {
    if (!hudEls || !hudEls.hud) return;
    hudEls.hud.hidden = true;
  };

  const showTypeHud = (targetEl, compileKey) => {
    const slots = catalogTypeSlots(targetEl);
    const available = Object.entries(slots).filter(([, el]) => !!el);
    if (!available.length) {
      hideHud();
      return;
    }

    const describeSlot = (el) => {
      if (!el) return null;
      const tag = el.tagName ? el.tagName.toLowerCase() : 'node';
      const cls = el.className ? `.${String(el.className).trim().split(/\s+/).join('.')}` : '';
      const text = (el.innerText || '').trim().slice(0, 40);
      return `${tag}${cls}${text ? ` "${text}"` : ''}`;
    };
    const slotSummary = {};
    Object.keys(slots).forEach((name) => {
      if (slots[name]) slotSummary[name] = describeSlot(slots[name]);
    });

    const { hud, versionEl, slotSelect, textarea, saveBtn } = ensureHud();
    hud.hidden = false;
    const compilev = new URLSearchParams(location.search).get('compilev');
    versionEl.textContent = `Compile v: ${compilev || 'ver-only'}`;

    slotSelect.innerHTML = '';
    available.forEach(([name]) => {
      const opt = document.createElement('option');
      opt.value = name;
      opt.textContent = name;
      slotSelect.appendChild(opt);
    });
    if (!slotSelect.value) {
      slotSelect.value = available[0][0];
    }

    const loadSlotValue = () => {
      const slotName = slotSelect.value;
      const slotEl = slots[slotName];
      textarea.value = slotEl ? slotEl.innerText : '';
    };

    slotSelect.onchange = loadSlotValue;
    loadSlotValue();

    saveBtn.onclick = () => {
      const slotName = slotSelect.value;
      const slotEl = slots[slotName];
      if (!slotEl) return;
      const raw = textarea.value || '';
      if (slotName === 'eyebrow' || slotName === 'header' || slotName === 'subheader') {
        slotEl.textContent = raw.replace(/\r?\n+/g, ' ');
      } else {
        slotEl.innerHTML = escapeHtml(raw).replace(/\r?\n/g, '<br>');
      }
      if (!compileState.sections[compileKey]) {
        compileState.sections[compileKey] = { slots: {} };
      }
      compileState.sections[compileKey].slots[slotName] = raw;

      if (isHeroGallery1(targetEl)) {
        persistHeroMeta(slots);
      }
    };
  };

  const items = targets.map((el) => {
    const key = resolvedKeys.get(el) || el.getAttribute('data-compile-key-resolved') || '';
    const type = resolveType(el);
    const hitbox = document.createElement('div');
    hitbox.className = 'foleo-compile-hitbox';
    hitbox.dataset.key = key;
    hitbox.dataset.type = type;
    overlay.appendChild(hitbox);
    return { el, key, type, hitbox };
  });

  let activeTarget = null;
  let activeHitbox = null;
  const setActiveSelection = (target, hitbox) => {
    if (activeHitbox === hitbox) return;
    if (activeHitbox) activeHitbox.classList.remove('is-active');
    activeTarget = target || null;
    activeHitbox = hitbox || null;
    if (activeHitbox) activeHitbox.classList.add('is-active');
  };

  const updateHitboxes = () => {
    items.forEach(({ el, hitbox }) => {
      if (!el.isConnected) {
        hitbox.style.display = 'none';
        return;
      }
      const rect = el.getBoundingClientRect();
      if (!rect.width || !rect.height) {
        hitbox.style.display = 'none';
        return;
      }
      hitbox.style.display = 'block';
      hitbox.style.left = `${rect.left}px`;
      hitbox.style.top = `${rect.top}px`;
      hitbox.style.width = `${rect.width}px`;
      hitbox.style.height = `${rect.height}px`;
    });
  };

  let updateScheduled = false;
  const scheduleUpdate = () => {
    if (updateScheduled) return;
    updateScheduled = true;
    window.requestAnimationFrame(() => {
      updateScheduled = false;
      updateHitboxes();
    });
  };

  items.forEach(({ el, key, type, hitbox }) => {
    hitbox.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();
      setActiveSelection(el, hitbox);
      if (type === 'type') {
        showTypeHud(el, key);
      } else {
        hideHud();
      }
      console.log('[compile] select', { key, type });
      document.dispatchEvent(
        new CustomEvent('foleo:compile:select', {
          detail: { key, type }
        })
      );
    });
  });

  scrim.addEventListener('click', () => {
    setActiveSelection(null, null);
    hideHud();
  });
  window.addEventListener('scroll', scheduleUpdate, { passive: true });
  window.addEventListener('resize', scheduleUpdate);
  updateHitboxes();

  const compileTargetSelector =
    '.compile-type, .compile-video, .compile-image, .compile-table, .compile-lottie';
  const popupTriggerSelector = [
    '[data-popup-id]',
    '[data-popup-open]',
    '[data-bde-popup]',
    '[data-bde-popup-open]',
    '[data-bde-modal]',
    '[data-modal]',
    '.bde-popup-trigger',
    '.breakdance-popup-trigger'
  ].join(',');

  const shouldBlockEvent = (event) => {
    const target = event.target;
    if (!target || !(target instanceof Element)) return false;
    if (target.closest('#foleo-compile-overlay')) return false;
    if (target.closest('#foleo-compile-hud')) return false;
    if (target.closest('#foleo-compile-scrim')) return false;

    if (target.closest(popupTriggerSelector)) return true;
    if (target.closest(compileTargetSelector)) return true;
    return false;
  };

  const blockEvent = (event) => {
    if (!shouldBlockEvent(event)) return;
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
  };

  document.addEventListener('pointerdown', blockEvent, true);
  document.addEventListener('click', blockEvent, true);

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      setActiveSelection(null, null);
      hideHud();
    }
  });
}

const start = () => initFoleoCompileMode();
if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', start);
else start();
