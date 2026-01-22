(function () {
  window.FoleoModules = window.FoleoModules || {};
  const Modules = window.FoleoModules;

function normalizeFoleoBadgeVariant(value) {
  return String(value || '')
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
}

/*
Dynamic Table schema (v1)
columns[]:
- key: string (stable id)
- label: string
- type: "text" | "badge" | "richtext"(future)
- width: "xs"|"sm"|"md"|"lg"|"xl"
- dock: "end" (optional)  // future admin option: “Move column to right”
rows[]:
- each row is an object keyed by columns[].key
*/
function normalizeColumns(columns) {
  const cols = Array.isArray(columns) ? columns.slice() : [];
  const normal = cols.filter((c) => c && c.dock !== 'end');
  const docked = cols.filter((c) => c && c.dock === 'end');
  return normal.concat(docked);
}

function widthTokenToFr(token) {
  const t = String(token || '').toLowerCase();
  if (t === 'narrow' || t === 'xs') return '0.6fr';
  if (t === 'sm') return '0.8fr';
  if (t === 'md' || t === 'med') return '1fr';
  if (t === 'wide' || t === 'lg') return '1.4fr';
  if (t === 'xl') return '2fr';
  return '1fr';
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

  const config = data && typeof data === 'object' ? data : {};
  const settings = config.settings || {};
  const rawColumns = Array.isArray(config.columns) ? config.columns : [];
  const columns = normalizeColumns(rawColumns);
  const rows = Array.isArray(config.rows) ? config.rows : [];
  const debug = settings && settings.debug === true;

  if (!columns.length || !rows.length) {
    console.warn('[FoleoModules] Empty dynamic table data');
    return;
  }

  const root = document.createElement('div');
  root.className = 'fdt';
  if (settings.mobileStack) root.classList.add('is-mobile-stack');
  const minColPx = Number(settings.minColPx || 140);
  const template = columns
    .map((col) => `minmax(${minColPx}px, ${widthTokenToFr(col && col.width)})`)
    .join(' ');
  root.style.setProperty('--fdt-cols', template);

  if (debug) {
    console.debug('[DynamicTable] columns effective order:', columns.map((col) => col.key));
  }

  const showHeader = settings.showHeader === true;
  if (showHeader && columns.length) {
    const headerRow = document.createElement('div');
    headerRow.className = 'fdt-row fdt-header-row';
    columns.forEach((col) => {
      const cell = document.createElement('div');
      cell.className = 'fdt-cell fdt-header-cell';
      const label = (col && typeof col.label === 'string') ? col.label.trim() : '';
      cell.textContent = label || '';
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
      const key = col && col.key;
      const value =
        (row && key && Object.prototype.hasOwnProperty.call(row, key)) ? row[key] : '';
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

  function buildCsvValue(value) {
    const text = value == null ? '' : String(value);
    return `"${text.replaceAll('"', '""')}"`;
  }

  function downloadTableAsCSV(filename, cols, dataRows) {
    const header = cols.map((col) => buildCsvValue(col.label || col.key || '')).join(',');
    const body = dataRows.map((row) => cols.map((col) => {
      const key = col && col.key;
      const cellValue =
        (row && key && Object.prototype.hasOwnProperty.call(row, key)) ? row[key] : '';

      if (col.type === 'badge' && cellValue && typeof cellValue === 'object') {
        return buildCsvValue(cellValue.text || '');
      }

      return buildCsvValue(cellValue);
    }).join(',')).join('\n');

    const csv = `${header}\n${body}`;
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  mount.appendChild(root);

  if (settings.showToolbar === true) {
    const toolbar = document.createElement('div');
    toolbar.className = 'fdt-toolbar';

    const btnDl = document.createElement('button');
    btnDl.type = 'button';
    btnDl.className = 'fdt-tool fdt-tool--download fdt-icon-btn is-download';
    btnDl.setAttribute('aria-label', 'Download');
    btnDl.innerHTML = '<img class="fdt-icon" src="https://foleo.co/wp-content/uploads/SVG/download-icon2.svg" alt="" aria-hidden="true">';

    const btnPrint = document.createElement('button');
    btnPrint.type = 'button';
    btnPrint.className = 'fdt-tool fdt-tool--print fdt-icon-btn is-print';
    btnPrint.setAttribute('aria-label', 'Print');
    btnPrint.innerHTML = '<img class="fdt-icon" src="https://foleo.co/wp-content/uploads/SVG/Print-icon.svg" alt="" aria-hidden="true">';

    toolbar.appendChild(btnDl);
    toolbar.appendChild(btnPrint);

    const shell = mount.closest('.fdt-shell.is-scroll');
    const controls = shell ? shell.querySelector('.fdt-controls') : null;

    if (controls) {
      controls.appendChild(toolbar);
    } else {
      mount.appendChild(toolbar);
    }

    btnDl.addEventListener('click', () => {
      const filename = settings.filename || 'foleo-table.csv';
      downloadTableAsCSV(filename, columns, rows);
    });
  }

  mount.dataset.rendered = '1';
}

// Public init
Modules.init = function initFoleoModules() {
  const mounts = document.querySelectorAll('[data-foleo-dynamic-table]');
  if (!mounts.length) return;
  mounts.forEach(renderFoleoDynamicTable);
};

(function bootFoleoModules() {
  try {
    if (typeof Modules.init !== "function") return;

    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => Modules.init(), { once: true });
      return;
    }

    Modules.init();
  } catch (e) {
    console.warn("[FoleoModules] boot failed", e);
  }
})();
})();
