(() => {
  const isClientShell = document.body.classList.contains('foleo-client-shell-active');
  if (!isClientShell) {
    return;
  }
  const isFoleoList =
    document.body.classList.contains('post-type-foleo_page') &&
    document.body.classList.contains('edit-php');

  const workspaceUrl =
    (window.foleoAdminAdapter && window.foleoAdminAdapter.workspaceUrl) ||
    '/wp-admin/admin.php?page=foleo-workspace';

  const wrap = document.querySelector('#wpbody-content .wrap');
  if (wrap) {
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
    const listRoot = document.querySelector('#wpbody-content .wrap.foleo-page--list');
    if (!listRoot) {
      return;
    }

    const topNav = listRoot.querySelector('.tablenav.top');
    const bottomNav = listRoot.querySelector('.tablenav.bottom');
    const views = listRoot.querySelector('.subsubsub');
    const searchBox = listRoot.querySelector('.search-box');
    const pageAction = listRoot.querySelector('.page-title-action');
    const titleLinks = listRoot.querySelectorAll('.wp-list-table .column-title .row-title, .wp-list-table .manage-column.column-title a');
    const rowTitleLinks = listRoot.querySelectorAll('.wp-list-table .column-title .row-title');
    const sortIndicators = listRoot.querySelectorAll('.wp-list-table .column-title .sorting-indicator');
    const actionButtons = listRoot.querySelectorAll(
      '.wp-list-table .column-foleo_primary_action .button, .wp-list-table .column-foleo_get_url .button'
    );

    if (views) {
      views.classList.add('foleo-list-views');
      views.querySelectorAll('a').forEach((link) => {
        link.classList.add('foleo-list-views__link');
      });
    }

    if (topNav) {
      topNav.classList.add('foleo-list-utilitybar', 'foleo-list-utilitybar--top');
    }
    if (bottomNav) {
      bottomNav.classList.add('foleo-list-utilitybar', 'foleo-list-utilitybar--bottom');
    }
    if (searchBox) {
      searchBox.classList.add('foleo-list-searchbox');
    }

    if (pageAction) {
      pageAction.classList.add('foleo-ui-page-action', 'foleo-list-page-action');
    }

    titleLinks.forEach((link) => {
      link.classList.add('foleo-list-title-link');
    });
    rowTitleLinks.forEach((link) => {
      link.classList.add('foleo-list-row-title');
    });
    sortIndicators.forEach((indicator) => {
      indicator.classList.add('foleo-list-sort-indicator');
    });

    actionButtons.forEach((button) => {
      const text = (button.textContent || '').trim().toLowerCase();
      const isDelete =
        button.classList.contains('foleo-v1-btn-action--delete') ||
        button.classList.contains('foleo-v1-action-delete') ||
        !!button.querySelector('.dashicons-trash');
      const isPrimary =
        button.classList.contains('foleo-v1-btn-action--primary') ||
        button.classList.contains('foleo-v1-action-primary') ||
        text === 'edit';

      button.classList.add('foleo-list-action-btn');
      button.classList.remove('foleo-list-action-btn--primary', 'foleo-list-action-btn--secondary', 'foleo-list-action-btn--delete');

      if (isDelete) {
        button.classList.add('foleo-list-action-btn--delete');
      } else if (isPrimary) {
        button.classList.add('foleo-list-action-btn--primary');
      } else {
        button.classList.add('foleo-list-action-btn--secondary');
      }
    });

    const utilityButtons = listRoot.querySelectorAll('.tablenav input[type="submit"].action');
    utilityButtons.forEach((button) => {
      button.classList.add('foleo-ui-btn', 'foleo-ui-btn--utility');
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
        searchSubmit.classList.add('foleo-v1-search-icon-btn', 'foleo-ui-btn', 'foleo-ui-btn--utility');
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
      if (wrap) {
        wrap.classList.add('foleo-page--list');
      }
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
    if (document.querySelector('#adminmenu .foleo-admin-logo') || retries >= 8) {
      window.clearInterval(retryTimer);
    }
  }, 200);
})();
