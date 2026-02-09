(() => {
  const cfg = window.FOLEO_COMPILER_UTILITY;
  if (!cfg || !cfg.postId) return;

  const apiUrl = `${cfg.restBase}${cfg.postId}`;

  const container = document.createElement('div');
  container.className = 'foleo-compiler-utility foleo-compiler-theme';
  container.innerHTML = `
    <div class="foleo-compiler-utility__header">
      <div class="foleo-compiler-utility__title">Properties</div>
      <button type="button" class="foleo-compiler-utility__toggle" aria-label="Toggle Properties"></button>
    </div>
    <div class="foleo-compiler-utility__body">
      <div class="foleo-compiler-utility__row">
        <label>Title</label>
        <input type="text" data-field="title" />
      </div>
      <div class="foleo-compiler-utility__row">
        <label>Slug</label>
        <input type="text" data-field="slug" />
      </div>
      <div class="foleo-compiler-utility__row">
        <label>Status</label>
        <select data-field="status">
          <option value="draft">Draft</option>
          <option value="publish">Publish</option>
        </select>
      </div>
      <div class="foleo-compiler-utility__row">
        <label>Thumbnail ID</label>
        <input type="number" data-field="thumbnail_id" min="0" />
      </div>
      <div class="foleo-compiler-utility__meta"></div>
      <div class="foleo-compiler-utility__actions">
        <button type="button" class="foleo-compiler-utility__save">Save</button>
        <span class="foleo-compiler-utility__status" role="status"></span>
      </div>
    </div>
  `;

  const scrim = document.createElement('div');
  scrim.className = 'foleo-compiler-utility__scrim';

  document.body.appendChild(scrim);
  document.body.appendChild(container);

  const bodyEl = container.querySelector('.foleo-compiler-utility__body');
  const toggleBtn = container.querySelector('.foleo-compiler-utility__toggle');
  const statusEl = container.querySelector('.foleo-compiler-utility__status');
  const saveBtn = container.querySelector('.foleo-compiler-utility__save');

  const metaWrap = container.querySelector('.foleo-compiler-utility__meta');
  const metaFields = Array.isArray(cfg.metaFields) ? cfg.metaFields : [];
  metaFields.forEach((field) => {
    const row = document.createElement('div');
    row.className = 'foleo-compiler-utility__row';
    row.innerHTML = `
      <label>${field.label}</label>
      <input type="text" data-meta="${field.key}" />
    `;
    metaWrap.appendChild(row);
  });

  const getField = (name) => container.querySelector(`[data-field="${name}"]`);

  const setStatus = (message, type) => {
    statusEl.textContent = message || '';
    statusEl.dataset.type = type || '';
  };

  const fetchJson = async (options) => {
    const res = await fetch(apiUrl, {
      ...options,
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': cfg.nonce
      }
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) {
      const msg = data && data.message ? data.message : 'Request failed';
      throw new Error(msg);
    }
    return data;
  };

  const load = async () => {
    try {
      setStatus('Loading...', 'info');
      const data = await fetchJson({ method: 'GET' });
      getField('title').value = data.title || '';
      getField('slug').value = data.slug || '';
      getField('status').value = data.status || 'draft';
      getField('thumbnail_id').value = data.thumbnail && data.thumbnail.id ? data.thumbnail.id : '';

      if (data.meta) {
        Object.keys(data.meta).forEach((key) => {
          const input = container.querySelector(`[data-meta="${key}"]`);
          if (input) input.value = data.meta[key] || '';
        });
      }

      setStatus('', '');
    } catch (err) {
      setStatus(err.message || 'Failed to load', 'error');
    }
  };

  const save = async () => {
    try {
      setStatus('Saving...', 'info');
      saveBtn.disabled = true;

      const payload = {
        title: getField('title').value || '',
        slug: getField('slug').value || '',
        status: getField('status').value || 'draft',
        thumbnail_id: parseInt(getField('thumbnail_id').value || '0', 10) || 0,
        meta: {}
      };

      metaFields.forEach((field) => {
        const input = container.querySelector(`[data-meta="${field.key}"]`);
        if (input) payload.meta[field.key] = input.value || '';
      });

      await fetchJson({ method: 'POST', body: JSON.stringify(payload) });
      setStatus('Saved', 'success');
    } catch (err) {
      setStatus(err.message || 'Save failed', 'error');
    } finally {
      saveBtn.disabled = false;
    }
  };

  const applyToolbarOffset = () => {
    const offset = 55;
    container.style.setProperty('--foleo-toolbar-offset', `${offset}px`);
    scrim.style.setProperty('--foleo-toolbar-offset', `${offset}px`);
  };

  const setOpen = (open) => {
    applyToolbarOffset();
    container.classList.toggle('is-open', open);
    scrim.classList.toggle('is-open', open);
    toolbarButton.classList.toggle('is-active', open);
  };

  const togglePanel = () => {
    setOpen(!container.classList.contains('is-open'));
  };

  toggleBtn.addEventListener('click', togglePanel);
  scrim.addEventListener('click', () => setOpen(false));
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      setOpen(false);
    }
  });

  const toolbarButton = document.createElement('button');
  toolbarButton.type = 'button';
  toolbarButton.className = 'foleo-compiler-toolbar-button';
  toolbarButton.setAttribute('aria-label', 'FOLEO Properties');
  toolbarButton.addEventListener('click', (e) => {
    e.preventDefault();
    togglePanel();
  });

  const toolbarWrap = document.createElement('div');
  toolbarWrap.className = 'foleo-compiler-toolbar-wrap';
  toolbarWrap.appendChild(toolbarButton);

  const attachToToolbar = () => {
    const toolbar = document.querySelector('.v-toolbar__content');
    if (!toolbar) return false;

    toolbarWrap.classList.remove('is-floating');
    toolbarWrap.classList.add('topbar-section', 'topbar-section-br');

    const children = Array.from(toolbar.children);
    if (children.length >= 5) {
      const anchor = children[4];
      if (anchor.parentNode) {
        anchor.parentNode.insertBefore(toolbarWrap, anchor.nextSibling);
        return true;
      }
    }

    toolbar.appendChild(toolbarWrap);
    return true;
  };

  const positionToolbarButton = () => {
    toolbarWrap.classList.add('is-floating');
    if (!document.body.contains(toolbarWrap)) {
      document.body.appendChild(toolbarWrap);
    }
  };

  const schedulePosition = () => {
    window.requestAnimationFrame(positionToolbarButton);
  };

  let attached = false;
  const tryAttach = () => {
    if (attached) return true;
    if (attachToToolbar()) {
      attached = true;
      return true;
    }
    return false;
  };

  schedulePosition();
  applyToolbarOffset();
  if (!tryAttach()) {
    positionToolbarButton();
  }

  const attachInterval = window.setInterval(() => {
    if (tryAttach()) {
      window.clearInterval(attachInterval);
    }
  }, 100);

  window.setTimeout(() => {
    if (!tryAttach()) {
      positionToolbarButton();
    }
  }, 600);

  window.addEventListener('resize', () => {
    if (!attached) {
      positionToolbarButton();
    }
  });

  saveBtn.addEventListener('click', save);

  load();

  setOpen(false);
})();
