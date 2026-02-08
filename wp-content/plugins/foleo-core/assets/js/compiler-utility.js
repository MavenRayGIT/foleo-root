(() => {
  const cfg = window.FOLEO_COMPILER_UTILITY;
  if (!cfg || !cfg.postId) return;

  const apiUrl = `${cfg.restBase}${cfg.postId}`;

  const container = document.createElement('div');
  container.className = 'foleo-compiler-utility';
  container.innerHTML = `
    <div class="foleo-compiler-utility__header">
      <div class="foleo-compiler-utility__title">FOLEO Utility</div>
      <button type="button" class="foleo-compiler-utility__toggle">-</button>
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

  toggleBtn.addEventListener('click', () => {
    const isHidden = bodyEl.classList.toggle('is-hidden');
    toggleBtn.textContent = isHidden ? '+' : '-';
  });

  saveBtn.addEventListener('click', save);

  load();
})();
