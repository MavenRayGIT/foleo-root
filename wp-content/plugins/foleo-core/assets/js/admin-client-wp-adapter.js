(() => {
  const isClientShell = document.body.classList.contains('foleo-client-shell-active');
  const isFoleoList =
    document.body.classList.contains('post-type-foleo_page') &&
    document.body.classList.contains('edit-php');

  if (!isClientShell && !isFoleoList) {
    return;
  }

  const workspaceUrl =
    (window.foleoAdminAdapter && window.foleoAdminAdapter.workspaceUrl) ||
    '/wp-admin/admin.php?page=foleo-workspace';

  const wrap = document.querySelector('#wpbody-content .wrap');
  if (wrap && isClientShell) {
    wrap.classList.add('foleo-admin-theme-scope');
  }

  const ensureLogo = () => {
    const menu = document.getElementById('adminmenu');
    if (!menu || menu.querySelector('.foleo-admin-logo')) {
      return;
    }

    const li = document.createElement('li');
    li.className = 'foleo-admin-logo';
    const link = document.createElement('a');
    link.href = workspaceUrl;
    link.setAttribute('aria-label', 'FOLEO');
    link.innerHTML = '<span class="foleo-logo-icon"></span><span class="foleo-logo-word"></span>';
    li.appendChild(link);
    menu.insertBefore(li, menu.firstChild);
  };

  const ensureWorkspaceMenuLink = () => {
    const dashboardLink = document.querySelector('#menu-dashboard > a.menu-top');
    if (dashboardLink) {
      dashboardLink.href = workspaceUrl;
    }
  };

  const suppressSeoNotice = () => {
    const notices = document.querySelectorAll('.notice');
    notices.forEach((notice) => {
      const text = (notice.textContent || '').toLowerCase();
      if (!text) {
        return;
      }
      if (
        text.includes('seo notice') &&
        (text.includes('no index') || text.includes('noindex') || text.includes('search engine visibility'))
      ) {
        notice.style.display = 'none';
      }
    });
  };

  const applyFoleoListRemap = () => {
    const topNav = document.querySelector('.tablenav.top');
    const searchBox = document.querySelector('.search-box');
    const pageAction = document.querySelector('.page-title-action');

    if (pageAction) {
      pageAction.classList.add('foleo-ui-page-action');
    }

    const utilityButtons = document.querySelectorAll('.tablenav input[type="submit"].action');
    utilityButtons.forEach((button) => {
      button.classList.add('foleo-v1-btn-utility', 'foleo-ui-btn', 'foleo-ui-btn--utility');
    });

    if (topNav) {
      const monthSelect = topNav.querySelector('.actions select[name="m"]');
      const filterSubmit = topNav.querySelector('.actions #post-query-submit');
      if (monthSelect) {
        monthSelect.remove();
      }
      if (filterSubmit) {
        filterSubmit.remove();
      }
    }

    if (searchBox && topNav) {
      const actions = topNav.querySelector('.actions:not(.bulkactions)');
      if (actions) {
        actions.appendChild(searchBox);
      }

      const searchInput = searchBox.querySelector('input[type="search"]');
      const searchSubmit = searchBox.querySelector('input[type="submit"]');
      if (searchInput) {
        searchInput.placeholder = 'Search';
      }
      if (searchSubmit) {
        searchSubmit.value = '';
        searchSubmit.title = 'Search';
        searchSubmit.setAttribute('aria-label', 'Search');
        searchSubmit.classList.add('foleo-v1-search-icon-btn', 'foleo-v1-btn-utility', 'foleo-ui-btn', 'foleo-ui-btn--utility');
      }
    }
  };

  const runShellAdapters = () => {
    if (isClientShell) {
      ensureLogo();
      ensureWorkspaceMenuLink();
      suppressSeoNotice();
    }
    if (isFoleoList) {
      applyFoleoListRemap();
    }
  };

  runShellAdapters();

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', runShellAdapters);
  }

  // Some admin screens finalize menu markup late; retry briefly.
  let retries = 0;
  const retryTimer = window.setInterval(() => {
    runShellAdapters();
    retries += 1;
    if (((!isClientShell) || document.querySelector('#adminmenu .foleo-admin-logo')) || retries >= 8) {
      window.clearInterval(retryTimer);
    }
  }, 200);
})();
