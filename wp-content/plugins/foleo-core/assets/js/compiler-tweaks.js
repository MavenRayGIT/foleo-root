(() => {
  const TARGET_TEXT = 'Element Studio is for developers and is provided as-is.';
  const REPLACEMENT_HTML =
    '<h4>Element Studio is locked in FOLEO.</h4>' +
    '<p><small>If you need a custom element, request it through your FOLEO admin.</small></p>';

  const patchElementStudioNotice = (root = document) => {
    const headings = Array.from(root.querySelectorAll('h4'));
    headings.forEach((h4) => {
      if (h4.textContent.trim() !== TARGET_TEXT) return;
      const wrapper = h4.closest('div');
      if (!wrapper || wrapper.dataset.foleoPatched === '1') return;
      wrapper.dataset.foleoPatched = '1';
      wrapper.innerHTML = REPLACEMENT_HTML;
    });
  };

  let debounceTimer = null;
  let patchExitToWordPress = null;
  const schedulePatch = () => {
    if (debounceTimer) return;
    debounceTimer = window.setTimeout(() => {
      debounceTimer = null;
      patchElementStudioNotice(document);
      if (patchExitToWordPress) {
        patchExitToWordPress(document);
      }
    }, 100);
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', schedulePatch);
  } else {
    schedulePatch();
  }

  const observer = new MutationObserver(() => {
    schedulePatch();
  });

  observer.observe(document.body, { childList: true, subtree: true });

  const exitConfig =
    typeof window.FOLEO_COMPILER_TWEAKS === 'object' && window.FOLEO_COMPILER_TWEAKS
      ? window.FOLEO_COMPILER_TWEAKS
      : {};
  const exitUrl =
    typeof exitConfig.exitUrl === 'string'
      ? exitConfig.exitUrl
      : typeof window.FOLEO_COMPILER_EXIT_URL === 'string'
        ? window.FOLEO_COMPILER_EXIT_URL
        : '';

  if (!exitConfig.exitUrl && exitUrl) {
    window.FOLEO_COMPILER_TWEAKS = { exitUrl };
  }

  if (exitUrl && !window.__foleoCompilerExitBound) {
    window.__foleoCompilerExitBound = true;

    const getExitControl = (root = document) => {
      const nodes = Array.from(root.querySelectorAll('a, button, [role=\"menuitem\"]'));
      for (const node of nodes) {
        const text = node.textContent ? node.textContent.trim() : '';
        if (!text.includes('Exit to WordPress')) continue;
        const control = node.closest('a, button, [role=\"menuitem\"]');
        if (control) return control;
      }
      return null;
    };

    const enforceExitHref = () => {
      const control = getExitControl(document);
      if (!control) return;
      if (control.tagName === 'A') {
        const current = control.getAttribute('href') || '';
        if (current !== exitUrl) {
          control.setAttribute('href', exitUrl);
        }
      }
    };

    patchExitToWordPress = () => {
      enforceExitHref();
    };

    schedulePatch();
    enforceExitHref();

    const isExitControl = (element) => {
      const control = element?.closest
        ? element.closest('a, button, [role=\"menuitem\"]')
        : null;
      if (!control) return null;

      const text = control.textContent ? control.textContent.trim() : '';
      if (text.includes('Exit to WordPress')) {
        return control;
      }

      return null;
    };

    document.addEventListener(
      'click',
      (event) => {
        const match = isExitControl(event.target);
        if (!match) return;
        enforceExitHref();
        event.preventDefault();
        event.stopPropagation();
        window.location.href = exitUrl;
      },
      true
    );
  }
})();
