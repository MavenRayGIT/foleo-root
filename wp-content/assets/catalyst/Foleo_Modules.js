// Foleo modules namespace
window.FoleoModules = window.FoleoModules || {};

function normalizeFoleoBadgeVariant(value) {
  return String(value || '')
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
}

function renderFoleoDynamicTable(mount) {
  if (!mount || mount.dataset.rendered === '1') return;

  const dataEl = mount.querySelector('[data-foleo-dynamic-table-json]');
  if (!dataEl) {
    console.warn('[FoleoModules] Missing dynamic table JSON');
    return;
  }

  let data;
  try {
    data = JSON.parse(dataEl.textContent || '');
  } catch (e) {
    console.warn('[FoleoModules] Invalid dynamic table JSON');
    return;
  }

  const settings = data && typeof data === 'object' ? (data.settings || {}) : {};
  const columns = Array.isArray(data.columns) ? data.columns : [];
  const rows = Array.isArray(data.rows) ? data.rows : [];

  if (!columns.length || !rows.length) {
    console.warn('[FoleoModules] Empty dynamic table data');
    return;
  }

  const root = document.createElement('div');
  root.className = 'fdt';
  if (settings.mobileStack) root.classList.add('is-mobile-stack');

  if (settings.showHeader) {
    const headerRow = document.createElement('div');
    headerRow.className = 'fdt-row';
    columns.forEach((col) => {
      const cell = document.createElement('div');
      cell.className = 'fdt-cell';
      cell.textContent = col.label || col.key || '';
      headerRow.appendChild(cell);
    });
    root.appendChild(headerRow);
  }

  rows.forEach((row) => {
    const rowEl = document.createElement('div');
    rowEl.className = 'fdt-row';

    columns.forEach((col) => {
      const cell = document.createElement('div');
      cell.className = 'fdt-cell';
      const value = row ? row[col.key] : '';
      const type = (col.type || 'text').toLowerCase();

      if (type === 'badge') {
        let text = '';
        let variant = '';
        if (value && typeof value === 'object') {
          text = value.text || '';
          variant = value.variant || '';
        } else {
          text = value || '';
        }
        const badge = document.createElement('span');
        badge.className = 'fdt-badge';
        const norm = normalizeFoleoBadgeVariant(variant || text);
        if (norm) badge.classList.add(`is-${norm}`);
        badge.textContent = text;
        cell.appendChild(badge);
      } else {
        cell.textContent = value == null ? '' : String(value);
      }

      rowEl.appendChild(cell);
    });

    root.appendChild(rowEl);
  });

  mount.appendChild(root);
  mount.dataset.rendered = '1';
}

// Public init
window.FoleoModules.init = function initFoleoModules() {
  const mounts = document.querySelectorAll('[data-foleo-dynamic-table]');
  if (!mounts.length) return;
  mounts.forEach(renderFoleoDynamicTable);
};
