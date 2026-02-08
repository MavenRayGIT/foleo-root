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
  const schedulePatch = () => {
    if (debounceTimer) return;
    debounceTimer = window.setTimeout(() => {
      debounceTimer = null;
      patchElementStudioNotice(document);
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
})();
