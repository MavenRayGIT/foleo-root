(() => {
  const root = document.querySelector('.foleo-v1');
  if (root) {
    root.setAttribute('data-foleo-v1-ready', '1');
  }

  const copyButtons = document.querySelectorAll('.foleo-v1-copy-url');
  copyButtons.forEach((button) => {
    if (!button.dataset.initialLabel) {
      button.dataset.initialLabel = button.textContent ? button.textContent.trim() : 'Copy URL';
    }
    button.addEventListener('click', async () => {
      const value = button.getAttribute('data-copy-url') || '';
      if (!value) {
        return;
      }
      try {
        await navigator.clipboard.writeText(value);
        button.textContent = 'Copied';
        setTimeout(() => {
          button.textContent = button.dataset.initialLabel || 'Copy URL';
        }, 1200);
      } catch (error) {
        window.prompt('Copy URL', value);
      }
    });
  });
})();
