(() => {
  const config = window.FOLEO_SEARCH_VISIBILITY;
  if (!config) return;

  const rowToggles = Array.from(document.querySelectorAll('[data-foleo-seo-toggle="1"]'));

  const hideSeoNotice = () => {
    const notices = Array.from(document.querySelectorAll('.notice'));
    notices.forEach((notice) => {
      const text = notice.textContent ? notice.textContent.trim() : '';
      if (!text) return;
      const isSeoNotice =
        /seo\s*notice/i.test(text) &&
        (/no\s*index/i.test(text) ||
          /noindex/i.test(text) ||
          /discourag/i.test(text) ||
          /search engine visibility/i.test(text) ||
          /your site is set to no index/i.test(text));
      if (isSeoNotice) {
        notice.style.display = 'none';
      }
    });
  };

  hideSeoNotice();
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', hideSeoNotice);
  }
  const noticeObserver = new MutationObserver(() => {
    hideSeoNotice();
  });
  noticeObserver.observe(document.body, { childList: true, subtree: true });

  const request = async (url, method, body) => {
    const response = await fetch(url, {
      method,
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': config.nonce,
      },
      body: body ? JSON.stringify(body) : undefined,
    });

    if (!response.ok) {
      throw new Error('Request failed');
    }

    return response.json();
  };

  const setRowState = (toggle, value, disabled) => {
    toggle.checked = value === 'on';
    toggle.disabled = disabled;
    const wrap = toggle.closest('.foleo-seo-toggle');
    if (wrap) {
      wrap.classList.toggle('is-disabled', !!disabled);
      const left = wrap.querySelector('[data-foleo-seo-label-left="1"]');
      const right = wrap.querySelector('[data-foleo-seo-label-right="1"]');
      if (left && right) {
        left.classList.toggle('is-active', value === 'on');
        right.classList.toggle('is-active', value === 'off');
      }
    }
  };

  const setAllRows = (value, disabled) => {
    rowToggles.forEach((toggle) => {
      setRowState(toggle, value, disabled);
    });
  };

  const setMasterState = (value) => {
    const master = document.querySelector('[data-foleo-seo-master="1"]');
    if (master) {
      master.checked = value === 'on';
    }
    const wrap = master?.closest('.foleo-seo-master');
    if (wrap) {
      const left = wrap.querySelector('[data-foleo-seo-label-left="1"]');
      const right = wrap.querySelector('[data-foleo-seo-label-right="1"]');
      if (left && right) {
        left.classList.toggle('is-active', value === 'on');
        right.classList.toggle('is-active', value === 'off');
      }
    }
  };

  const initRowStates = () => {
    rowToggles.forEach((toggle) => {
      const value = toggle.checked ? 'on' : 'off';
      setRowState(toggle, value, toggle.disabled);
    });
  };

  let masterState = config.state === 'off' ? 'off' : 'on';
  setMasterState(masterState);
  if (masterState === 'off') {
    setAllRows('off', true);
  } else {
    initRowStates();
  }

  document.addEventListener('change', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLInputElement)) return;
    if (target.getAttribute('data-foleo-seo-master') === '1') {
      const next = target.checked ? 'on' : 'off';
      target.disabled = true;

      request(config.restUrl, 'POST', {
        value: next,
        bulk_noindex_pages: true,
        scope: config.scope || {},
      })
        .then(() => {
          masterState = next;
          setMasterState(next);
          setAllRows(next, next === 'off');
        })
        .catch(() => {
          setMasterState(masterState);
          alert('Search Visibility update failed. Please try again.');
        })
        .finally(() => {
          target.disabled = false;
        });
      return;
    }

    if (target.getAttribute('data-foleo-seo-toggle') === '1') {
      const postId = target.getAttribute('data-post-id');
      if (!postId) {
        return;
      }

      if (masterState === 'off') {
        setRowState(target, 'off', true);
        return;
      }

      const nextValue = target.checked ? 'on' : 'off';
      setRowState(target, nextValue, true);

      request(`${config.pageRestUrl}${postId}`, 'POST', { value: nextValue })
        .then((data) => {
          const newValue = data && data.value === 'off' ? 'off' : 'on';
          setRowState(target, newValue, false);
        })
        .catch(() => {
          setRowState(target, nextValue === 'on' ? 'off' : 'on', false);
          alert('Search Visibility update failed. Please try again.');
        });
    }
  });
})();
