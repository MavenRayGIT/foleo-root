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

  const contentRoot = document.querySelector('[data-foleo-content-app]');
  const configNode = document.getElementById('foleo-content-ui-config');
  if (!contentRoot || !configNode) {
    return;
  }

  let config = null;
  try {
    config = JSON.parse(configNode.textContent || '{}');
  } catch (error) {
    return;
  }
  if (!config || !config.foleoPageId || !config.routes) {
    return;
  }

  const CONTENT_SNAPSHOTS = [
    {
      uploadState: { hasPendingChanges: true, lastScannedAt: '12:04' },
      scorecard: {
        sections: [
          { key: 'narrative', label: 'Narrative', scorePct: 60, status: 'warn', helperText: 'Narrative is usable but light on proof-backed specifics.', tooltipText: 'Narrative score reflects positioning clarity, evidence usage, and call-to-action quality.' },
          { key: 'visuals', label: 'Visuals', scorePct: 80, status: 'good', helperText: 'Visual coverage is strong enough for an initial launch.', tooltipText: 'Visual score reflects quantity, quality, and placement readiness.' },
          { key: 'proof', label: 'Proof', scorePct: 50, status: 'bad', helperText: 'Proof assets are still below minimum confidence.', tooltipText: 'Proof score tracks case studies, team credibility, and measurable outcomes.' },
        ],
        tokens: [
          { key: 'case_studies', label: 'Case Studies', current: 1, min: 1, recommended: 3, status: 'warn', allowNotNeeded: true, isNotNeeded: false },
          { key: 'team_profiles', label: 'Team Profiles', current: 1, min: 2, recommended: 3, status: 'bad', allowNotNeeded: true, isNotNeeded: false },
          { key: 'hero_image', label: 'Hero Image', current: 0, min: 1, recommended: 1, status: 'bad', allowNotNeeded: true, isNotNeeded: false },
          { key: 'cta_link', label: 'CTA Link', current: 1, min: 1, recommended: 1, status: 'good', allowNotNeeded: false, isNotNeeded: false },
        ],
      },
      report: {
        banner: { tone: 'warn', text: 'This can launch as-is, but it has several gaps. Resolve as many as possible before approval.' },
        decisionCard: {
          statusLabel: 'Proceed with gaps',
          topGaps: ['+2 case studies recommended', '+2 team profiles recommended', '+1 hero image missing'],
          proceedEnabled: false,
        },
        generalPoints: [
          { title: 'General Point #1', body: 'Core narrative exists and can support an initial pass, but it needs stronger proof moments.' },
          { title: 'General Point #2', body: 'Visual direction is mostly complete; add one hero image variant for stronger first impression.' },
          { title: 'General Point #3', body: 'CTA structure is in place. Add supporting proof to improve conversion confidence.' },
        ],
        reportSections: [
          {
            key: 'narrative',
            label: 'Narrative',
            mode: 'bucket',
            scoreDisplay: '60%',
            statusSentence: 'The narrative is functional but undersupported by concrete examples.',
            gaps: ['Add one client-specific value statement.', 'Add one measurable outcome in opening section.', 'Tighten CTA language for urgency.'],
            sources: [{ label: 'Q4 Narrative Brief.docx' }, { label: 'Homepage Strategy Notes', sublabelOptional: 'Shared drive' }, { label: 'Client Interview Transcript' }],
            sourcesMoreCount: 0,
          },
          {
            key: 'visuals',
            label: 'Visuals',
            mode: 'bucket',
            scoreDisplay: '80%',
            statusSentence: 'Visual quality is strong; one more hero-ready asset is recommended.',
            gaps: ['Provide one alternate hero image.', 'Tag existing imagery with usage context.', 'Add a source note for licensing status.'],
            sources: [{ label: 'Brand Deck.pdf' }, { label: 'Moodboard Link' }, { label: 'Case Study Screenshot Pack.zip' }, { label: 'Team Headshots 2026.zip' }, { label: 'Product Screens RAW' }],
            sourcesMoreCount: 1,
          },
          {
            key: 'proof',
            label: 'Proof',
            mode: 'token',
            scoreDisplay: '1 of 3 recommended',
            statusSentence: 'Proof is currently the main blocker for confidence.',
            gaps: ['Add two additional case studies.', 'Add at least one team profile with credentials.', 'Include one quantified result in each study.'],
            sources: [{ label: 'Client Results Summary.docx' }, { label: 'Internal Sales Metrics.pdf' }],
            sourcesMoreCount: 0,
          },
        ],
      },
    },
    {
      uploadState: { hasPendingChanges: false, lastScannedAt: '12:19' },
      scorecard: {
        sections: [
          { key: 'narrative', label: 'Narrative', scorePct: 74, status: 'good', helperText: 'Narrative now covers key value and intent with better flow.', tooltipText: 'Narrative score reflects positioning clarity, evidence usage, and call-to-action quality.' },
          { key: 'visuals', label: 'Visuals', scorePct: 84, status: 'good', helperText: 'Visual inventory meets recommended baseline.', tooltipText: 'Visual score reflects quantity, quality, and placement readiness.' },
          { key: 'proof', label: 'Proof', scorePct: 66, status: 'warn', helperText: 'Proof is improved but still has optional gaps.', tooltipText: 'Proof score tracks case studies, team credibility, and measurable outcomes.' },
        ],
        tokens: [
          { key: 'case_studies', label: 'Case Studies', current: 2, min: 1, recommended: 3, status: 'warn', allowNotNeeded: true, isNotNeeded: false },
          { key: 'team_profiles', label: 'Team Profiles', current: 3, min: 2, recommended: 3, status: 'good', allowNotNeeded: true, isNotNeeded: false },
          { key: 'hero_image', label: 'Hero Image', current: 1, min: 1, recommended: 1, status: 'good', allowNotNeeded: true, isNotNeeded: false },
          { key: 'cta_link', label: 'CTA Link', current: 1, min: 1, recommended: 1, status: 'good', allowNotNeeded: false, isNotNeeded: false },
        ],
      },
      report: {
        banner: { tone: 'success', text: 'Content is in a good position. Remaining gaps are optional improvements before approval.' },
        decisionCard: {
          statusLabel: 'Ready',
          topGaps: ['+1 case study recommended', 'Optional: add one testimonial quote'],
          proceedEnabled: true,
        },
        generalPoints: [
          { title: 'General Point #1', body: 'Narrative and visuals are now aligned with the selected template intent.' },
          { title: 'General Point #2', body: 'Proof indicators improved substantially. One additional case study will strengthen confidence.' },
          { title: 'General Point #3', body: 'Current package is suitable for preview and stakeholder review.' },
        ],
        reportSections: [
          {
            key: 'narrative',
            label: 'Narrative',
            mode: 'bucket',
            scoreDisplay: '74%',
            statusSentence: 'Narrative is clear, cohesive, and mostly complete.',
            gaps: ['Consider adding one tighter opening hook.', 'Add one industry-specific phrase for resonance.'],
            sources: [{ label: 'Q4 Narrative Brief.docx' }, { label: 'AI Direction Notes' }, { label: 'Foleo Positioning Memo' }],
            sourcesMoreCount: 0,
          },
          {
            key: 'visuals',
            label: 'Visuals',
            mode: 'bucket',
            scoreDisplay: '84%',
            statusSentence: 'Visual package meets recommended quality and quantity.',
            gaps: ['Optional: add one alternate hero crop.', 'Optional: replace one low-res screenshot.'],
            sources: [{ label: 'Brand Deck.pdf' }, { label: 'Hero Image Set.zip' }, { label: 'Team Headshots 2026.zip' }, { label: 'UI Screens Pack.zip' }],
            sourcesMoreCount: 0,
          },
          {
            key: 'proof',
            label: 'Proof',
            mode: 'token',
            scoreDisplay: '2 of 3 recommended',
            statusSentence: 'Proof set is solid but can be strengthened with one more case study.',
            gaps: ['Add one more quantified case study.', 'Optional: include one cross-industry project reference.'],
            sources: [{ label: 'Client Results Summary.docx' }, { label: 'Case Study 2025.pdf' }, { label: 'Benchmark Report 2026.xlsx' }],
            sourcesMoreCount: 0,
          },
        ],
      },
    },
    {
      uploadState: { hasPendingChanges: false, lastScannedAt: '12:31' },
      scorecard: {
        sections: [
          { key: 'narrative', label: 'Narrative', scorePct: 52, status: 'bad', helperText: 'Narrative confidence dropped after conflicting direction notes.', tooltipText: 'Narrative score reflects positioning clarity, evidence usage, and call-to-action quality.' },
          { key: 'visuals', label: 'Visuals', scorePct: 78, status: 'good', helperText: 'Visual supply remains adequate for build.', tooltipText: 'Visual score reflects quantity, quality, and placement readiness.' },
          { key: 'proof', label: 'Proof', scorePct: 42, status: 'bad', helperText: 'Proof is below minimum and should be addressed before launch.', tooltipText: 'Proof score tracks case studies, team credibility, and measurable outcomes.' },
        ],
        tokens: [
          { key: 'case_studies', label: 'Case Studies', current: 0, min: 1, recommended: 3, status: 'bad', allowNotNeeded: true, isNotNeeded: false },
          { key: 'team_profiles', label: 'Team Profiles', current: 2, min: 2, recommended: 3, status: 'warn', allowNotNeeded: true, isNotNeeded: false },
          { key: 'hero_image', label: 'Hero Image', current: 1, min: 1, recommended: 1, status: 'good', allowNotNeeded: true, isNotNeeded: false },
          { key: 'cta_link', label: 'CTA Link', current: 0, min: 1, recommended: 1, status: 'bad', allowNotNeeded: false, isNotNeeded: false },
        ],
      },
      report: {
        banner: { tone: 'danger', text: 'Launch is blocked until required narrative/proof gaps are resolved.' },
        decisionCard: {
          statusLabel: 'Blocked',
          topGaps: ['+3 case studies recommended', '+1 CTA link missing', 'Narrative consistency is below threshold'],
          proceedEnabled: false,
        },
        generalPoints: [
          { title: 'General Point #1', body: 'Current narrative signals are inconsistent and need one consolidated direction source.' },
          { title: 'General Point #2', body: 'Proof package is below baseline; gather supporting case outcomes before proceeding.' },
          { title: 'General Point #3', body: 'Visuals are acceptable and can remain while narrative/proof are fixed.' },
        ],
        reportSections: [
          {
            key: 'narrative',
            label: 'Narrative',
            mode: 'bucket',
            scoreDisplay: '52%',
            statusSentence: 'Narrative quality is below launch threshold.',
            gaps: ['Consolidate contradictory positioning statements.', 'Replace generic claims with specific outcomes.', 'Rebuild opening section with one strong value message.'],
            sources: [{ label: 'Q4 Narrative Brief.docx' }, { label: 'Old Sales Deck v3' }, { label: 'Ad Hoc Notes (Untitled)' }],
            sourcesMoreCount: 0,
          },
          {
            key: 'visuals',
            label: 'Visuals',
            mode: 'bucket',
            scoreDisplay: '78%',
            statusSentence: 'Visual inventory is acceptable for now.',
            gaps: ['Optional: align image tone with revised narrative.', 'Optional: remove duplicated screenshot rows.'],
            sources: [{ label: 'Brand Deck.pdf' }, { label: 'Screenshot Pack.zip' }, { label: 'Hero Option A.png' }],
            sourcesMoreCount: 0,
          },
          {
            key: 'proof',
            label: 'Proof',
            mode: 'token',
            scoreDisplay: '0 of 3 recommended',
            statusSentence: 'Proof content is missing and blocks confidence.',
            gaps: ['Add at least one case study immediately.', 'Add one team profile with relevant credentials.', 'Insert one CTA destination link.'],
            sources: [{ label: 'Internal Notes Only' }],
            sourcesMoreCount: 0,
          },
        ],
      },
    },
  ];

  const DEFAULT_ASSETS = [
    { id: 'asset_1', name: 'Q4 Narrative Brief.docx', type: 'DOCX', sizeLabel: '2.1 MB', sourceLabel: 'Upload', canOpen: true, notesPreview: 'Use this for section one framing and audience context.', hasNotes: true },
    { id: 'asset_2', name: 'Client Results Summary.pdf', type: 'PDF', sizeLabel: '3.5 MB', sourceLabel: 'Upload', canOpen: true, notesPreview: '', hasNotes: false },
    { id: 'asset_3', name: 'Brand Deck 2026.pptx', type: 'PPTX', sizeLabel: '8.4 MB', sourceLabel: 'Upload', canOpen: true, notesPreview: '', hasNotes: false },
    { id: 'asset_4', name: 'https://macklee.example/case-study', type: 'URL', sizeLabel: 'Link', sourceLabel: 'Link', canOpen: true, notesPreview: 'Reference for proof section and CTA.', hasNotes: true },
    { id: 'asset_5', name: 'Team Headshots.zip', type: 'ZIP', sizeLabel: '12.2 MB', sourceLabel: 'Upload', canOpen: false, notesPreview: '', hasNotes: false },
  ];

  const stateKey = `foleo-content-ui-${config.foleoPageId}`;
  const stepKey = String(config.step || 'upload');
  const nowLabel = () => {
    const date = new Date();
    return date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }).toLowerCase();
  };

  const safeClone = (value) => JSON.parse(JSON.stringify(value));
  const baselineState = {
    snapshotIndex: 0,
    assets: safeClone(DEFAULT_ASSETS),
    tokenNotNeeded: {},
    expandedSources: {},
  };

  let uiState = safeClone(baselineState);
  try {
    const cachedRaw = localStorage.getItem(stateKey);
    if (cachedRaw) {
      const cached = JSON.parse(cachedRaw);
      if (cached && typeof cached === 'object') {
        uiState.snapshotIndex = Number.isInteger(cached.snapshotIndex) ? cached.snapshotIndex % CONTENT_SNAPSHOTS.length : 0;
        uiState.assets = Array.isArray(cached.assets) ? cached.assets : safeClone(DEFAULT_ASSETS);
        uiState.tokenNotNeeded = cached.tokenNotNeeded && typeof cached.tokenNotNeeded === 'object' ? cached.tokenNotNeeded : {};
        uiState.expandedSources = cached.expandedSources && typeof cached.expandedSources === 'object' ? cached.expandedSources : {};
      }
    }
  } catch (error) {
    uiState = safeClone(baselineState);
  }

  let isRescanLoading = false;

  const persistState = () => {
    try {
      localStorage.setItem(stateKey, JSON.stringify(uiState));
    } catch (error) {
      // Ignore local storage write errors.
    }
  };

  const hasUnannotatedAssets = () => uiState.assets.some((asset) => !asset.hasNotes);
  const snapshot = () => {
    const next = safeClone(CONTENT_SNAPSHOTS[uiState.snapshotIndex] || CONTENT_SNAPSHOTS[0]);
    next.scorecard.tokens = next.scorecard.tokens.map((token) => ({
      ...token,
      isNotNeeded: Boolean(uiState.tokenNotNeeded[token.key] || token.isNotNeeded),
    }));
    return next;
  };

  const warningTokenCount = (tokens) => tokens.filter((token) => !token.isNotNeeded && token.status === 'bad').length;

  const statusClass = (status) => {
    if (status === 'good') return 'is-good';
    if (status === 'bad') return 'is-bad';
    return 'is-warn';
  };

  const tokenVisuals = (token) => {
    const total = Math.max(1, Number(token.recommended) || 1);
    const filled = Math.max(0, Math.min(total, Number(token.current) || 0));
    const boxes = [];
    for (let i = 0; i < total; i += 1) {
      boxes.push(`<span class="foleo-v1__token-box ${i < filled ? 'is-filled' : 'is-empty'}" aria-hidden="true"></span>`);
    }
    return `<div class="foleo-v1__token-boxes">${boxes.join('')}</div>`;
  };

  const buildReportSections = (reportSections, tokens) => {
    const sections = Array.isArray(reportSections) ? [...reportSections] : [];
    const hasCase = sections.some((section) => section.key === 'case_studies');
    const hasTeam = sections.some((section) => section.key === 'team_profiles');
    const caseToken = tokens.find((token) => token.key === 'case_studies');
    const teamToken = tokens.find((token) => token.key === 'team_profiles');

    if (!hasCase && caseToken) {
      sections.push({
        key: 'case_studies',
        label: 'Case Studies',
        mode: 'token',
        scoreDisplay: `${caseToken.current} of ${caseToken.recommended} recommended`,
        statusSentence: caseToken.current >= caseToken.min ? 'Case-study coverage is present but can still be strengthened.' : 'Case-study coverage is below target and should be expanded.',
        gaps: ['Add one additional case study with outcomes.', 'Include measurable impact metrics where possible.'],
        sources: [{ label: 'Case Study Notes.docx' }, { label: 'Wins Tracker Q1.pdf' }, { label: 'Client Testimonial Drafts' }],
        sourcesMoreCount: 0,
      });
    }
    if (!hasTeam && teamToken) {
      sections.push({
        key: 'team_profiles',
        label: 'Team Profiles',
        mode: 'token',
        scoreDisplay: `${teamToken.current} of ${teamToken.recommended} recommended`,
        statusSentence: teamToken.current >= teamToken.min ? 'Team-profile coverage meets minimum confidence.' : 'Team-profile coverage is below minimum confidence.',
        gaps: ['Add profiles with role + credibility context.', 'Attach one headshot or proof point per profile.'],
        sources: [{ label: 'Team Headshots 2026.zip' }, { label: 'Leadership Bios.docx' }],
        sourcesMoreCount: 0,
      });
    }
    return sections;
  };

  const openModal = (contentHtml, callbacks = {}) => {
    const existing = document.querySelector('.foleo-v1__content-modal-backdrop');
    if (existing) existing.remove();
    const backdrop = document.createElement('div');
    backdrop.className = 'foleo-v1__content-modal-backdrop';
    backdrop.innerHTML = `<div class="foleo-v1__content-modal">${contentHtml}</div>`;
    document.body.appendChild(backdrop);
    const close = () => backdrop.remove();
    backdrop.addEventListener('click', (event) => {
      if (event.target === backdrop) close();
    });
    backdrop.querySelectorAll('[data-modal-close]').forEach((node) => {
      node.addEventListener('click', close);
    });
    if (callbacks.onReady) callbacks.onReady(backdrop, close);
  };

  const escapeHtml = (value) => {
    const div = document.createElement('div');
    div.textContent = String(value == null ? '' : value);
    return div.innerHTML;
  };

  const renderScorecard = (snap) => {
    const missingRequired = warningTokenCount(snap.scorecard.tokens);
    const pendingClass = snap.uploadState.hasPendingChanges ? ' is-pending' : '';
    const tokensHtml = snap.scorecard.tokens.map((token) => `
      <div class="foleo-v1__score-token ${token.isNotNeeded ? 'is-muted' : ''}" data-token-key="${escapeHtml(token.key)}">
        <div class="foleo-v1__score-token-main">
          <h5 class="foleo-ui-type-metric">${escapeHtml(token.label)}</h5>
          <p>${escapeHtml(`${token.current} of ${token.recommended} recommended`)}</p>
          <small>Minimum: ${escapeHtml(token.min)}</small>
        </div>
        ${tokenVisuals(token)}
        <div class="foleo-v1__score-token-actions">
          ${token.allowNotNeeded ? `<button type="button" class="button foleo-ui-btn foleo-ui-btn--utility" data-token-not-needed="${escapeHtml(token.key)}">${token.isNotNeeded ? 'mark needed' : 'not needed'}</button>` : ''}
        </div>
      </div>
    `).join('');
    const sectionsHtml = snap.scorecard.sections.map((section) => `
      <section class="foleo-v1__score-bucket ${statusClass(section.status)}">
        <header>
          <h4 class="foleo-ui-type-subsection">${escapeHtml(section.label)} <span class="dashicons dashicons-info-outline" title="${escapeHtml(section.tooltipText)}"></span></h4>
          <strong>${escapeHtml(`${section.scorePct}%`)}</strong>
        </header>
        <p>${escapeHtml(section.helperText)}</p>
      </section>
    `).join('');
    return `
      <aside class="foleo-v1__content-scorecard${pendingClass}">
        ${isRescanLoading ? '<div class="foleo-v1__scorecard-scrim"><div class="foleo-v1__scorecard-spinner" aria-hidden="true"></div><p>Rescanning Content</p></div>' : ''}
        <div class="foleo-v1__content-scorecard-head">
          <h3 class="foleo-ui-type-subsection">Content Scorecard</h3>
          ${snap.uploadState.hasPendingChanges ? '<p class="foleo-v1__score-inline-warning">Changes pending. Re-scan to refresh.</p>' : ''}
          ${missingRequired > 0 ? '<p class="foleo-v1__score-inline-warning is-required">Missing required items</p>' : ''}
          ${hasUnannotatedAssets() ? '<p class="foleo-v1__score-inline-note">Some assets have no notes. Results may be less accurate.</p>' : ''}
        </div>
        ${sectionsHtml}
        <div class="foleo-v1__score-tokens">${tokensHtml}</div>
        <footer>
          <span>scanned at ${escapeHtml(snap.uploadState.lastScannedAt)}</span>
          <button type="button" class="button foleo-ui-btn foleo-ui-btn--primary" data-score-rescan ${isRescanLoading ? 'disabled' : ''}>${isRescanLoading ? 're-scanning…' : 're-scan'}</button>
        </footer>
      </aside>
    `;
  };

  const renderAssetRows = () => {
    if (!uiState.assets.length) {
      return `<tr><td colspan="5"><p class="foleo-v1__assets-empty">No assets added yet.</p></td></tr>`;
    }
    return uiState.assets.map((asset) => `
      <tr data-asset-id="${escapeHtml(asset.id)}">
        <td><input type="checkbox" aria-label="Select ${escapeHtml(asset.name)}"></td>
        <td class="foleo-v1__asset-name">${escapeHtml(asset.name)}${asset.hasNotes ? '<span class="foleo-v1__asset-has-notes">notes</span>' : ''}</td>
        <td>${escapeHtml(asset.sizeLabel)}</td>
        <td>${escapeHtml(asset.type)}</td>
        <td>
          <div class="foleo-v1__asset-actions">
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary foleo-v1__asset-icon-btn" data-asset-notes="${escapeHtml(asset.id)}" data-tooltip="Add notes" title="Add notes"><span class="dashicons dashicons-media-text"></span></button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary foleo-v1__asset-icon-btn" data-asset-open="${escapeHtml(asset.id)}" data-tooltip="View document" title="View document" ${asset.canOpen ? '' : 'disabled'}><span class="dashicons dashicons-visibility"></span></button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary foleo-ui-btn--delete" data-asset-delete="${escapeHtml(asset.id)}" title="Delete asset"><span class="dashicons dashicons-trash"></span></button>
          </div>
        </td>
      </tr>
    `).join('');
  };

  const renderUpload = () => {
    const snap = snapshot();
    contentRoot.innerHTML = `
      <div class="foleo-v1__content-upload-layout">
        <section class="foleo-v1__drawer foleo-v1__upload-card foleo-ui-panel--feature">
          <h3 class="foleo-ui-type-subsection">If you have content, we want it.<br>The more the better.</h3>
          <p>Drop in documents, links, decks, screenshots, and source notes. The richer the input, the stronger the report.</p>
          <p>Uploads on this screen are UI stubs for now; this pass focuses on workflow and interaction design.</p>
          <button type="button" class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary">Upload a file</button>
        </section>
        <section class="foleo-v1__drawer foleo-v1__upload-card">
          <h3 class="foleo-ui-type-subsection">Adding Direction</h3>
          <p>If you want to include additional guidance, add your own AI notes or a notation brief for targeting and fidelity.</p>
          <div class="foleo-v1__upload-card-actions">
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--utility">use my own ai</button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--utility">add a notation brief</button>
          </div>
        </section>
        ${renderScorecard(snap)}
        <section class="foleo-v1__drawer foleo-v1__assets-table-wrap">
          <table class="foleo-v1__assets-table" aria-label="Uploaded assets">
            <thead>
              <tr>
                <th></th>
                <th>Asset Name</th>
                <th>Size</th>
                <th>Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              ${renderAssetRows()}
            </tbody>
          </table>
        </section>
      </div>
      <div class="foleo-v1__content-bottom-actions">
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary" href="${escapeHtml(config.routes.setup)}">Back</a>
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary" href="${escapeHtml(config.routes.report)}">Save &amp; Continue</a>
      </div>
    `;
    bindUploadEvents();
  };

  const renderReportSections = (sections) => sections.map((section) => {
    const expanded = Boolean(uiState.expandedSources[section.key]);
    const visibleSources = expanded ? section.sources : section.sources.slice(0, 4);
    const hiddenCount = Math.max(0, section.sources.length - visibleSources.length);
    const sourceText = visibleSources.map((source) => {
      if (source.sublabelOptional) {
        return `${source.label} (${source.sublabelOptional})`;
      }
      return source.label;
    }).join(', ');
    return `
      <article class="foleo-v1__report-section">
        <div class="foleo-v1__report-section-col">
          <h3 class="foleo-ui-type-subsection">${escapeHtml(section.label)} <span>${escapeHtml(section.scoreDisplay)}</span></h3>
          <p>${escapeHtml(section.statusSentence)}</p>
        </div>
        <div class="foleo-v1__report-section-col">
          <h4 class="foleo-ui-type-metric">${escapeHtml(section.label)} Gaps</h4>
          <ul>${section.gaps.map((gap) => `<li>${escapeHtml(gap)}</li>`).join('')}</ul>
        </div>
        <div class="foleo-v1__report-section-col">
          <h4 class="foleo-ui-type-metric">${escapeHtml(section.label)} Source</h4>
          <p class="foleo-v1__report-sources-inline"><a href="#">${escapeHtml(sourceText)}</a></p>
          ${(hiddenCount > 0 || section.sourcesMoreCount > 0) ? `<button type="button" class="button-link" data-toggle-sources="${escapeHtml(section.key)}">${expanded ? 'Show less' : `+${escapeHtml(hiddenCount || section.sourcesMoreCount)} more`}</button>` : ''}
        </div>
      </article>
    `;
  }).join('');

  const renderReport = () => {
    const snap = snapshot();
    const report = snap.report;
    const reportSections = buildReportSections(report.reportSections, snap.scorecard.tokens);
    const toneClass = report.banner.tone === 'success' ? 'is-success' : (report.banner.tone === 'danger' ? 'is-danger' : 'is-warn');
    contentRoot.innerHTML = `
      <section class="foleo-v1__report-banner ${toneClass}">${escapeHtml(report.banner.text)}</section>
      <section class="foleo-v1__report-summary">
        <div class="foleo-v1__report-main">
          <section class="foleo-v1__report-head">
            <h3 class="foleo-ui-type-subsection">Content Readiness Report</h3>
          </section>
          <div class="foleo-v1__report-general-grid">
            ${report.generalPoints.map((point) => `<article><h4 class="foleo-ui-type-metric">${escapeHtml(point.title)}</h4><p>${escapeHtml(point.body)}</p></article>`).join('')}
          </div>
        </div>
        <aside class="foleo-v1__report-decision">
          <div class="foleo-v1__report-decision-row"><span>Status</span><strong>${escapeHtml(report.decisionCard.statusLabel)}</strong></div>
          <div class="foleo-v1__report-decision-row"><span>Top Gaps</span><ul>${report.decisionCard.topGaps.map((gap) => `<li>${escapeHtml(gap)}</li>`).join('')}</ul></div>
          <div class="foleo-v1__report-decision-actions">
            <a class="button foleo-ui-btn foleo-ui-btn--secondary" href="${escapeHtml(config.routes.upload)}">Go Back</a>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--primary" data-report-proceed>${report.decisionCard.proceedEnabled ? 'Proceed' : 'Proceed anyway'}</button>
          </div>
        </aside>
      </section>
      <section class="foleo-v1__drawer foleo-v1__report-stack">
        ${renderReportSections(reportSections)}
      </section>
      <div class="foleo-v1__content-bottom-actions">
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary" href="${escapeHtml(config.routes.upload)}">Back to Content Upload</a>
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary" href="${escapeHtml(config.routes.preview)}">Save &amp; Continue</a>
      </div>
    `;
    bindReportEvents(report.decisionCard.proceedEnabled);
  };

  const renderPreviewStub = () => {
    contentRoot.innerHTML = `
      <section class="foleo-v1__drawer foleo-v1__preview-stub">
        <h2 class="foleo-ui-type-page">Preview &amp; Approval (Placeholder)</h2>
        <p>This is a UI-only placeholder route for workflow navigation. Real preview rendering will be integrated in a later pass.</p>
      </section>
      <div class="foleo-v1__content-bottom-actions">
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--secondary" href="${escapeHtml(config.routes.report)}">Back to Content Report</a>
        <a class="button foleo-ui-page-action-btn foleo-ui-page-action-btn--primary" href="${escapeHtml(config.routes.setup)}">Save &amp; Continue</a>
      </div>
    `;
  };

  const bindUploadEvents = () => {
    const rescanBtn = contentRoot.querySelector('[data-score-rescan]');
    if (rescanBtn) {
      rescanBtn.addEventListener('click', () => {
        if (isRescanLoading) return;
        isRescanLoading = true;
        renderUpload();
        const delay = Math.floor(4000 + Math.random() * 600);
        window.setTimeout(() => {
          uiState.snapshotIndex = (uiState.snapshotIndex + 1) % CONTENT_SNAPSHOTS.length;
          const snap = CONTENT_SNAPSHOTS[uiState.snapshotIndex];
          snap.uploadState.lastScannedAt = nowLabel();
          snap.uploadState.hasPendingChanges = false;
          isRescanLoading = false;
          persistState();
          renderUpload();
        }, delay);
      });
    }

    contentRoot.querySelectorAll('[data-asset-notes]').forEach((button) => {
      button.addEventListener('click', () => {
        const assetId = button.getAttribute('data-asset-notes');
        const asset = uiState.assets.find((item) => item.id === assetId);
        if (!asset) return;
        openModal(`
          <header><h3>Edit Notes</h3></header>
          <p>${escapeHtml(asset.name)}</p>
          <textarea rows="6" data-notes-input>${escapeHtml(asset.notesPreview || '')}</textarea>
          <footer>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary" data-modal-close>Cancel</button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--primary" data-notes-save>Save notes</button>
          </footer>
        `, {
          onReady: (rootNode, close) => {
            const saveBtn = rootNode.querySelector('[data-notes-save]');
            const input = rootNode.querySelector('[data-notes-input]');
            if (!saveBtn || !input) return;
            saveBtn.addEventListener('click', () => {
              asset.notesPreview = input.value.trim();
              asset.hasNotes = asset.notesPreview.length > 0;
              const snap = CONTENT_SNAPSHOTS[uiState.snapshotIndex];
              snap.uploadState.hasPendingChanges = true;
              persistState();
              close();
              renderUpload();
            });
          },
        });
      });
    });

    contentRoot.querySelectorAll('[data-asset-open]').forEach((button) => {
      button.addEventListener('click', () => {
        const assetId = button.getAttribute('data-asset-open');
        const asset = uiState.assets.find((item) => item.id === assetId);
        if (!asset) return;
        openModal(`
          <header><h3>Asset Preview</h3></header>
          <p>Open asset: ${escapeHtml(asset.name)}</p>
          <footer>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary" data-modal-close>Close</button>
          </footer>
        `);
      });
    });

    contentRoot.querySelectorAll('[data-asset-delete]').forEach((button) => {
      button.addEventListener('click', () => {
        const assetId = button.getAttribute('data-asset-delete');
        const asset = uiState.assets.find((item) => item.id === assetId);
        if (!asset) return;
        openModal(`
          <header><h3>Delete asset?</h3></header>
          <p>${escapeHtml(asset.name)}</p>
          <p>This is UI-only for now. The row will be removed from local state.</p>
          <footer>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary" data-modal-close>Cancel</button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--delete" data-delete-confirm>Delete</button>
          </footer>
        `, {
          onReady: (rootNode, close) => {
            const confirmBtn = rootNode.querySelector('[data-delete-confirm]');
            if (!confirmBtn) return;
            confirmBtn.addEventListener('click', () => {
              uiState.assets = uiState.assets.filter((item) => item.id !== assetId);
              const snap = CONTENT_SNAPSHOTS[uiState.snapshotIndex];
              snap.uploadState.hasPendingChanges = true;
              persistState();
              close();
              renderUpload();
            });
          },
        });
      });
    });

    contentRoot.querySelectorAll('[data-token-not-needed]').forEach((button) => {
      button.addEventListener('click', () => {
        const key = button.getAttribute('data-token-not-needed');
        if (!key) return;
        const isNeeded = Boolean(uiState.tokenNotNeeded[key]);
        const copy = isNeeded ? 'Mark this token as needed again?' : 'Mark this token as not needed for this FOLEO?';
        openModal(`
          <header><h3>${isNeeded ? 'Restore token requirement' : 'Mark token not needed'}</h3></header>
          <p>${escapeHtml(copy)}</p>
          <footer>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary" data-modal-close>Cancel</button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--primary" data-not-needed-confirm>Confirm</button>
          </footer>
        `, {
          onReady: (rootNode, close) => {
            const confirmBtn = rootNode.querySelector('[data-not-needed-confirm]');
            if (!confirmBtn) return;
            confirmBtn.addEventListener('click', () => {
              uiState.tokenNotNeeded[key] = !isNeeded;
              const snap = CONTENT_SNAPSHOTS[uiState.snapshotIndex];
              snap.uploadState.hasPendingChanges = true;
              persistState();
              close();
              renderUpload();
            });
          },
        });
      });
    });
  };

  const bindReportEvents = (proceedEnabled) => {
    const proceedButton = contentRoot.querySelector('[data-report-proceed]');
    if (proceedButton) {
      proceedButton.addEventListener('click', () => {
        if (proceedEnabled) {
          window.location.href = config.routes.preview;
          return;
        }
        openModal(`
          <header><h3>Proceed anyway?</h3></header>
          <p>There are still unresolved content gaps. You can proceed, but preview quality may be reduced.</p>
          <footer>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--secondary" data-modal-close>Cancel</button>
            <button type="button" class="button foleo-ui-btn foleo-ui-btn--primary" data-report-confirm-proceed>Proceed anyway</button>
          </footer>
        `, {
          onReady: (rootNode, close) => {
            const confirmBtn = rootNode.querySelector('[data-report-confirm-proceed]');
            if (!confirmBtn) return;
            confirmBtn.addEventListener('click', () => {
              close();
              window.location.href = config.routes.preview;
            });
          },
        });
      });
    }

    contentRoot.querySelectorAll('[data-toggle-sources]').forEach((button) => {
      button.addEventListener('click', () => {
        const key = button.getAttribute('data-toggle-sources');
        if (!key) return;
        uiState.expandedSources[key] = !uiState.expandedSources[key];
        persistState();
        renderReport();
      });
    });
  };

  const render = () => {
    if (stepKey === 'report') {
      renderReport();
      return;
    }
    if (stepKey === 'preview') {
      renderPreviewStub();
      return;
    }
    renderUpload();
  };

  render();
})();
