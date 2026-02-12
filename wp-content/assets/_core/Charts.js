(() => {
  if (typeof window === "undefined") return;
  if (window.FOLEO_DISABLE_CHARTS === true) return;
  if (!window.Chart) return;

  const readVar = (el, name, fallback = "") => {
    if (!el) return fallback;
    const value = getComputedStyle(el).getPropertyValue(name).trim();
    return value || fallback;
  };

  const parseNumber = (value, fallback) => {
    const n = parseFloat(value);
    return Number.isFinite(n) ? n : fallback;
  };

  const applyTheme = (config, el) => {
    const root = el ? el.closest('.foleo-chart') || el : document.documentElement;
    const fontFamily = readVar(root, '--foleo-chart-font-family', 'Avenir, "Avenir Next", Arial, system-ui, sans-serif');
    const fontSize = parseNumber(readVar(root, '--foleo-chart-font-size', ''), 12);
    const fontWeight = readVar(root, '--foleo-chart-font-weight', '400');
    const textColor = readVar(root, '--foleo-chart-text-color', '#111827');

    const gridColor = readVar(root, '--foleo-chart-grid-color', '#e5e7eb');
    const axisColor = readVar(root, '--foleo-chart-axis-color', '#9ca3af');
    const tickColor = readVar(root, '--foleo-chart-tick-color', textColor);

    const tooltipBg = readVar(root, '--foleo-chart-tooltip-bg', '#111827');
    const tooltipColor = readVar(root, '--foleo-chart-tooltip-color', '#ffffff');
    const tooltipBorder = readVar(root, '--foleo-chart-tooltip-border', '#111827');
    const legendColor = readVar(root, '--foleo-chart-legend-color', textColor);

    config.options = config.options || {};
    config.options.plugins = config.options.plugins || {};
    config.options.scales = config.options.scales || {};

    const ensureScale = (key) => {
      config.options.scales[key] = config.options.scales[key] || {};
      config.options.scales[key].grid = config.options.scales[key].grid || {};
      config.options.scales[key].ticks = config.options.scales[key].ticks || {};
    };

    ensureScale('x');
    ensureScale('y');

    config.options.scales.x.grid.color ||= gridColor;
    config.options.scales.y.grid.color ||= gridColor;
    config.options.scales.x.border ||= {};
    config.options.scales.y.border ||= {};
    config.options.scales.x.border.color ||= axisColor;
    config.options.scales.y.border.color ||= axisColor;
    config.options.scales.x.ticks.color ||= tickColor;
    config.options.scales.y.ticks.color ||= tickColor;

    config.options.plugins.legend = config.options.plugins.legend || {};
    config.options.plugins.legend.labels = config.options.plugins.legend.labels || {};
    config.options.plugins.legend.labels.color ||= legendColor;

    config.options.plugins.tooltip = config.options.plugins.tooltip || {};
    config.options.plugins.tooltip.backgroundColor ||= tooltipBg;
    config.options.plugins.tooltip.titleColor ||= tooltipColor;
    config.options.plugins.tooltip.bodyColor ||= tooltipColor;
    config.options.plugins.tooltip.borderColor ||= tooltipBorder;
    config.options.plugins.tooltip.borderWidth ||= 1;

    config.options.font = config.options.font || {};
    config.options.font.family ||= fontFamily;
    config.options.font.size ||= fontSize;
    config.options.font.weight ||= fontWeight;

    config.options.color ||= textColor;
  };

  const getConfig = (id) => {
    const script = document.querySelector(`script[type="application/json"][data-chart-config="${id}"]`);
    if (!script) return null;
    try {
      return JSON.parse(script.textContent || '{}');
    } catch (e) {
      console.warn('[FOLEO] chart config JSON parse failed', id, e);
      return null;
    }
  };

  let tooltipEl = null;
  let tooltipLabelEl = null;
  let tooltipValueEl = null;
  let tooltipDotEl = null;
  let tooltipVisible = false;
  let tooltipRoot = null;
  let tooltipChart = null;
  const isCoarsePointer = () =>
    !!(window.matchMedia && window.matchMedia('(hover: none) and (pointer: coarse)').matches);
  let tooltipRaf = 0;
  let pendingTooltipPos = null;
  const flushTooltipPosition = () => {
    tooltipRaf = 0;
    if (!pendingTooltipPos || !tooltipEl) return;
    const { x, y } = pendingTooltipPos;
    pendingTooltipPos = null;
    tooltipEl.style.transform = `translate3d(${Math.round(x)}px, ${Math.round(y)}px, 0)`;
  };
  const hideTooltip = () => {
    if (tooltipRaf) {
      cancelAnimationFrame(tooltipRaf);
      tooltipRaf = 0;
    }
    pendingTooltipPos = null;
    if (tooltipEl) tooltipEl.classList.remove('is-visible');
    tooltipVisible = false;
    tooltipChart = null;
  };
  const ensureTooltip = (root) => {
    const targetRoot = root || document.body;
    if (!tooltipEl) {
      tooltipEl = document.createElement('div');
      tooltipEl.className = 'foleo-chart-tooltip';
      tooltipEl.innerHTML = `
        <div class="foleo-chart-tooltip__single">
          <span class="foleo-chart-tooltip__dot"></span>
          <span class="foleo-chart-tooltip__value"></span>
          <span class="foleo-chart-tooltip__label"></span>
        </div>
        <div class="foleo-chart-tooltip__multi">
          <div class="foleo-chart-tooltip__title"></div>
          <div class="foleo-chart-tooltip__rows"></div>
        </div>
      `;
      tooltipDotEl = tooltipEl.querySelector('.foleo-chart-tooltip__dot');
      tooltipValueEl = tooltipEl.querySelector('.foleo-chart-tooltip__value');
      tooltipLabelEl = tooltipEl.querySelector('.foleo-chart-tooltip__label');
    }
    if (tooltipRoot !== targetRoot || tooltipEl.parentElement !== targetRoot) {
      tooltipRoot = targetRoot;
      tooltipRoot.appendChild(tooltipEl);
    }
  };
  const positionTooltip = (chart, tooltip, pointer) => {
    if (!tooltipEl || !chart || !chart.canvas) return;
    const root = chart.canvas.closest('.foleo-chart') || chart.canvas.parentElement || document.body;
    ensureTooltip(root);

    const rootRect = root.getBoundingClientRect();
    const canvasRect = chart.canvas.getBoundingClientRect();
    const localX =
      Number.isFinite(pointer?.x)
        ? pointer.x
        : Number.isFinite(tooltip?.caretX)
          ? tooltip.caretX
          : 0;
    const localY =
      Number.isFinite(pointer?.y)
        ? pointer.y
        : Number.isFinite(tooltip?.caretY)
          ? tooltip.caretY
          : 0;
    const anchorX = (canvasRect.left - rootRect.left) + localX;
    const anchorY = (canvasRect.top - rootRect.top) + localY;
    const pad = 12;
    const tipRect = tooltipEl.getBoundingClientRect();
    const rootW = root.clientWidth || Math.round(rootRect.width) || 0;

    let x = anchorX + pad;
    if (rootW && tipRect.width && x + tipRect.width > rootW - 8) {
      x = anchorX - tipRect.width - pad;
    }
    if (x < 8) x = 8;

    pendingTooltipPos = { x, y: anchorY + 12 };
    if (!tooltipRaf) {
      tooltipRaf = requestAnimationFrame(flushTooltipPosition);
    }
  };

  const externalTooltipHandler = (context) => {
    const { chart, tooltip } = context;
    if (!chart || !chart.canvas) return;
    const root = chart.canvas.closest('.foleo-chart') || chart.canvas.parentElement || document.body;
    ensureTooltip(root);
    tooltipChart = chart;

    if (!tooltip || !tooltip.opacity || !tooltip.dataPoints || !tooltip.dataPoints.length) {
      hideTooltip();
      return;
    }

    const singleWrap = tooltipEl.querySelector('.foleo-chart-tooltip__single');
    const multiWrap = tooltipEl.querySelector('.foleo-chart-tooltip__multi');
    const multiTitle = tooltipEl.querySelector('.foleo-chart-tooltip__title');
    const multiRows = tooltipEl.querySelector('.foleo-chart-tooltip__rows');

    const dataPoints = tooltip.dataPoints || [];
    if (dataPoints.length <= 1) {
      if (singleWrap) singleWrap.style.display = 'flex';
      if (multiWrap) multiWrap.style.display = 'none';

      const dp = dataPoints[0];
      const raw = typeof dp.raw === 'number' ? dp.raw : Number(dp.raw);
      const label = dp.label || '';
      const color = dp.element && dp.element.options ? dp.element.options.backgroundColor : '';
      let valueText = '';
      if (chart.config?.type === 'doughnut') {
        const total = dp.dataset && Array.isArray(dp.dataset.data)
          ? dp.dataset.data.reduce((sum, v) => sum + (typeof v === 'number' ? v : Number(v) || 0), 0)
          : 0;
        const pct = total > 0 ? Math.round((raw / total) * 100) : 0;
        valueText = `${pct}%`;
      } else {
        valueText = Number.isFinite(raw) ? String(raw) : String(dp.raw ?? '');
      }

      if (tooltipDotEl) tooltipDotEl.style.background = color || '#2563eb';
      if (tooltipValueEl) tooltipValueEl.textContent = valueText;
      if (tooltipLabelEl) tooltipLabelEl.textContent = label;
    } else {
      if (singleWrap) singleWrap.style.display = 'none';
      if (multiWrap) multiWrap.style.display = 'flex';
      if (multiTitle) {
        const title = tooltip.title && tooltip.title.length ? tooltip.title[0] : '';
        multiTitle.textContent = title;
      }
      if (multiRows) {
        multiRows.innerHTML = '';
        dataPoints.forEach((dp) => {
          const raw = typeof dp.raw === 'number' ? dp.raw : Number(dp.raw);
          const label = dp.label || '';
          const color = dp.element && dp.element.options ? dp.element.options.backgroundColor : '';
          let valueText = '';
          if (chart.config?.type === 'doughnut') {
            const total = dp.dataset && Array.isArray(dp.dataset.data)
              ? dp.dataset.data.reduce((sum, v) => sum + (typeof v === 'number' ? v : Number(v) || 0), 0)
              : 0;
            const pct = total > 0 ? Math.round((raw / total) * 100) : 0;
            valueText = `${pct}%`;
          } else {
            valueText = Number.isFinite(raw) ? String(raw) : String(dp.raw ?? '');
          }

          const row = document.createElement('div');
          row.className = 'foleo-chart-tooltip__row';
          row.innerHTML = `
            <span class="foleo-chart-tooltip__dot" style="background:${color || '#2563eb'}"></span>
            <span class="foleo-chart-tooltip__value">${valueText}</span>
            <span class="foleo-chart-tooltip__label">${label}</span>
          `;
          multiRows.appendChild(row);
        });
      }
    }

    const fontFamily = chart.canvas && chart.canvas.closest
      ? getComputedStyle(chart.canvas.closest('.foleo-chart') || chart.canvas).fontFamily
      : '';
    if (fontFamily) {
      tooltipEl.style.fontFamily = fontFamily;
    }
    const pos = isCoarsePointer()
      ? { x: tooltip.caretX, y: tooltip.caretY }
      : (chart._foleoCursor || { x: tooltip.caretX, y: tooltip.caretY });
    const chartW = chart.width || 0;
    if (tooltipEl) {
      if (pos.x > chartW * 0.6) {
        tooltipEl.classList.add('is-right');
      } else {
        tooltipEl.classList.remove('is-right');
      }
    }
    tooltipVisible = true;
    tooltipEl.classList.add('is-visible');
    positionTooltip(chart, tooltip, pos);
  };

  const initChart = (canvas) => {
    if (!canvas || canvas.dataset.chartInit === '1') return;
    const id = canvas.getAttribute('data-chart-id') || canvas.id;
    if (!id) return;

    const config = getConfig(id);
    if (!config) return;

    applyTheme(config, canvas);
    config.options = config.options || {};
    config.options.plugins = config.options.plugins || {};
    config.options.plugins.tooltip = config.options.plugins.tooltip || {};
    config.options.plugins.tooltip.enabled = false;
    config.options.plugins.tooltip.external = externalTooltipHandler;
    try {
      canvas.dataset.chartInit = '1';
      const ctx = canvas.getContext('2d');
      if (!ctx) return;
      if (window.Chart.getChart) {
        const existing = window.Chart.getChart(canvas);
        if (existing) {
          existing.destroy();
        }
      }
      canvas.addEventListener('mousemove', (e) => {
        const canvasRect = canvas.getBoundingClientRect();
        chart._foleoCursor = {
          x: e.clientX - canvasRect.left,
          y: e.clientY - canvasRect.top
        };
        if (tooltipVisible && tooltipEl && tooltipChart === chart) {
          positionTooltip(chart, chart.tooltip, chart._foleoCursor);
        }
      }, { passive: true });
      canvas.addEventListener('mouseleave', () => {
        hideTooltip();
      });
      const chart = new window.Chart(ctx, config);
    } catch (e) {
      console.warn('[FOLEO] chart init failed', id, e);
    }
  };

  const shouldEnableCharts = () => {
    if (window.FOLEO_DISABLE_CHARTS === true) return false;
    if (window.FOLEO_CHARTS_ENABLED === true) return true;
    let pageKey = '';
    try {
      const params = new URLSearchParams(window.location.search || '');
      pageKey = params.get('pageKey') || '';
    } catch (e) {}
    if (['cx', 'tofu', 'pitch'].includes(pageKey)) return true;
    return !!document.querySelector('[data-chart-id], script[type="application/json"][data-chart-config]');
  };

  const boot = () => {
    if (!shouldEnableCharts()) return;
    const canvases = document.querySelectorAll('[data-chart-id], canvas[id]');
    const validCanvases = [];
    canvases.forEach((canvas) => {
      if (!(canvas instanceof HTMLCanvasElement)) return;
      const id = canvas.getAttribute('data-chart-id') || canvas.id;
      if (!id) return;
      if (!document.querySelector(`script[type="application/json"][data-chart-config="${id}"]`)) return;
      validCanvases.push(canvas);
    });

    if (!validCanvases.length) return;

    if (typeof window.IntersectionObserver !== 'function') {
      validCanvases.forEach((canvas) => initChart(canvas));
      return;
    }

    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const canvas = entry.target;
          initChart(canvas);
          obs.unobserve(canvas);
        });
      },
      { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.1 }
    );

    validCanvases.forEach((canvas) => observer.observe(canvas));
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
  } else {
    boot();
  }
  document.addEventListener('touchstart', (e) => {
    if (!tooltipVisible || !tooltipEl) return;
    const target = e.target;
    if (!(target instanceof Element)) return;
    if (target.closest('.foleo-chart')) return;
    hideTooltip();
  }, { passive: true });
  document.addEventListener('pointerdown', (e) => {
    if (!tooltipVisible || !tooltipEl) return;
    const target = e.target;
    if (!(target instanceof Element)) return;
    if (target.closest('.foleo-chart')) return;
    hideTooltip();
  }, { passive: true });
  window.addEventListener('scroll', hideTooltip, { passive: true });
  window.addEventListener('resize', hideTooltip, { passive: true });
})();
