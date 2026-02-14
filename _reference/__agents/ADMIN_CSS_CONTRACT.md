# ADMIN CSS Contract
Last updated: 2026-02-14
Baseline reference: `FOLEO_CORE_VERSION 0.4.62`

## Scope Root Contract
All FOLEO admin CSS must be gated by:
- `body.foleo-client-shell-active .foleo-admin-theme-scope`

All FOLEO admin JS remap behavior must:
- require `body.foleo-client-shell-active` before running
- only add `.foleo-admin-theme-scope` to the wrap, never use wrap class to infer shell context

Exception: minimal nav fallback inline CSS is allowed only to prevent a broken admin nav when assets fail, and must not attempt to fully theme.

## Layer Definitions

### Layer 1: Tokens only
Owner files:
- `wp-content/plugins/foleo-core/assets/css/admin-client.css`

Allowed selectors:
- shell-scoped token roots and custom properties

Not allowed:
- page composition selectors
- WP primitive selectors

### Layer 2: FOLEO components only (`foleo-ui-*`)
Owner files:
- `wp-content/plugins/foleo-core/assets/css/admin-client.css`

Allowed selectors:
- `.foleo-ui-*` reusable patterns

Not allowed:
- page-specific composition
- WP primitive selectors

### Layer 3: Page modules only (`foleo-page--*`)
Owner files:
- `wp-content/plugins/foleo-core/assets/css/foleo-v1.css`

Allowed selectors:
- `.foleo-page--*` roots + `.foleo-v1__*` descendants

Rule:
- If a selector targets `.foleo-v1__*`, it must also include exactly one `.foleo-page--*` gate.

Current page roots:
- `.foleo-page--workspace`
- `.foleo-page--new`
- `.foleo-page--detail-shell`
- `.foleo-page--detail`
- `.foleo-page--setup`
- `.foleo-page--assets`
- `.foleo-page--setup-shell`
- `.foleo-page--list` (JS injected)

### Layer 4: WP adapters only
Owner files:
- `wp-content/plugins/foleo-core/assets/css/admin-client-wp-adapter.css`
- `wp-content/plugins/foleo-core/assets/css/admin-client-wp-list-adapter.css`
- `wp-content/plugins/foleo-core/assets/js/admin-client-wp-adapter.js`

Allowed selectors:
- WP primitive selectors only in adapter files
- must still be gated by shell and page root where relevant

## Standard-First Decision Gate (required)
When implementing from a mockup:
- Default to existing global standards first (`foleo-ui-*` + `--bd-*` tokens).
- Do not create new style-owning ad-hoc classes if an existing global primitive can express the intent.
- If a requested style is not covered by current standards, ask and classify before adding:
  - `Global standard (reusable everywhere)`
  - `Page-level exception (local only)`

Implementation rule:
- Any new visual primitive (button tier, typography tier, color role, alert tone, panel family) must be added to Layer 1/2 first unless explicitly approved as page-level exception.
- Page-level exceptions in Layer 3 must be documented with a short intent comment near the selector block.

Review gate:
- For any new class in Layer 3, confirm whether it is:
  - layout/composition only (allowed), or
  - visual primitive ownership (not allowed; move to Layer 1/2).

## WP Primitive Selector Policy
Disallowed in Layers 1-3:
- `.tablenav`
- `.wp-list-table`
- `.widefat`
- `.button`
- `.notice`
- `.wp-core-ui`
- `#adminmenu`
- `#wpbody-content`
- `.wrap`

Allowed in Layer 4 only.

## `!important` Policy
Allowed only in Layer 4 Category C blocks (documented WP collision blocks).

Required comment format on each Category C block:
- `/* WHY WP collision: <short reason> */`

Target thresholds:
- list adapter `!important` <= 20
- shell adapter `!important` <= 25
- component layers (`admin-client.css` + `foleo-v1.css`) <= 2 total

## Enqueue Policy
- `foleo-v1.css` remains a single handle for now and must be page-root gated.
- List adapter CSS is list-only and must be gated under `.foleo-page--list`.
- Do not broaden list adapter styling to non-list pages.

## JS Remap Policy
`admin-client-wp-adapter.js` is for DOM remap hooks and class assignment only.

Rules:
- list-only hook logic executes only when shell is active and FOLEOs list signature matches (`edit.php` + `post_type=foleo_page`)
- add classes, do not encode visual styling decisions in JS
- keep hooks idempotent
