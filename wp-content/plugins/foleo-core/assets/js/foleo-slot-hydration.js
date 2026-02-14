(() => {
  const configNode = document.getElementById('foleo-slot-hydration-config');
  if (!configNode) {
    return;
  }

  let config;
  try {
    config = JSON.parse(configNode.textContent || '{}');
  } catch (error) {
    console.error('[FOLEO slots] Invalid hydration config payload.', error);
    return;
  }

  const foleoId = Number(config.foleoId || 0);
  const signEndpoint = String(config.signEndpoint || '');
  const mode = String(config.mode || 'preview');
  const previewToken = String(config.previewToken || '');
  if (!foleoId || !signEndpoint) {
    return;
  }

  const slotNodes = Array.from(document.querySelectorAll('[data-foleo-slot-type="video"][data-foleo-slot]'));
  if (!slotNodes.length) {
    return;
  }

  const uniqueSlotKeys = Array.from(
    new Set(
      slotNodes
        .map((node) => String(node.getAttribute('data-foleo-slot') || '').trim())
        .filter(Boolean),
    ),
  );

  if (!uniqueSlotKeys.length) {
    return;
  }

  fetch(signEndpoint, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    credentials: 'same-origin',
    body: JSON.stringify({
      foleoId,
      mode,
      previewToken,
      slotKeys: uniqueSlotKeys,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Signer HTTP ${response.status}`);
      }
      return response.json();
    })
    .then((payload) => {
      const items = Array.isArray(payload?.items) ? payload.items : [];
      const bySlot = new Map(items.map((item) => [String(item.slotKey || ''), item]));

      slotNodes.forEach((slotNode) => {
        const slotKey = String(slotNode.getAttribute('data-foleo-slot') || '').trim();
        if (!slotKey) {
          return;
        }

        const item = bySlot.get(slotKey);
        if (!item || !item.hlsUrl) {
          console.warn(`[FOLEO slots] Missing signed URL for slot: ${slotKey}`);
          slotNode.setAttribute('data-foleo-slot-error', 'missing-signed-url');
          return;
        }

        mountVideoSlot(slotNode, item);
      });
    })
    .catch((error) => {
      console.warn('[FOLEO slots] Video hydration failed. Leaving placeholders in place.', error);
      slotNodes.forEach((node) => node.setAttribute('data-foleo-slot-error', 'signer-failed'));
    });

  function mountVideoSlot(slotNode, item) {
    try {
      const player = document.createElement('media-player');
      player.setAttribute('title', String(item.slotKey || 'FOLEO Video'));
      player.setAttribute('src', String(item.hlsUrl));
      player.setAttribute('crossorigin', 'anonymous');
      player.setAttribute('stream-type', 'on-demand');
      player.setAttribute('view-type', 'video');
      player.setAttribute('playsinline', '');
      player.setAttribute('style', 'width:100%;aspect-ratio:16/9;display:block;background:#000;');
      if (item.posterUrl) {
        player.setAttribute('poster', String(item.posterUrl));
      }

      const provider = document.createElement('media-provider');
      const layout = document.createElement('media-video-layout');
      layout.setAttribute('thumbnails', '');

      player.appendChild(provider);
      player.appendChild(layout);

      slotNode.innerHTML = '';
      slotNode.appendChild(player);
      slotNode.setAttribute('data-foleo-slot-hydrated', '1');
    } catch (error) {
      console.warn('[FOLEO slots] Failed to mount player.', error);
      slotNode.setAttribute('data-foleo-slot-error', 'mount-failed');
    }
  }
})();
