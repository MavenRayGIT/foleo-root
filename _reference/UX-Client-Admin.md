# UX Client Admin

Baseline UX standard for FOLEO client admin. This is a living spec.

## Scope
- Applies to client-shell wp-admin views only (`body.foleo-client-shell-active`).
- Current baseline screens:
  - Workspace (`admin.php?page=foleo-workspace`)
  - FOLEOs list (`edit.php?post_type=foleo_page`)

## Layer Contract
1. **Layer 1: Tokens + Base Theme**
- File: `wp-content/plugins/foleo-core/assets/css/admin-client.css`
- Owns color/type/spacing variables and FOLEO-scoped base styles.
- Base element styling is anchored to `.foleo-admin-theme-scope` (not generic WP primitives).
- Must not include WP markup hacks.

2. **Layer 2: FOLEO Reusable Patterns**
- File: `wp-content/plugins/foleo-core/assets/css/admin-client.css`
- Owns reusable classes (`foleo-ui-*`) used across screens.
- No screen-specific layout assumptions.

3. **Layer 3: Screen Composition**
- File: `wp-content/plugins/foleo-core/assets/css/foleo-v1.css`
- Owns page layouts and component assembly (`foleo-v1*` shells/grids/cards).
- Uses Layer 1 and Layer 2 classes.

4. **Layer 4: WP Adapter (High-Risk Overrides)**
- Files:
  - `wp-content/plugins/foleo-core/assets/css/admin-client-wp-adapter.css`
  - `wp-content/plugins/foleo-core/assets/css/admin-client-wp-list-adapter.css`
  - `wp-content/plugins/foleo-core/assets/js/admin-client-wp-adapter.js`
- Owns WP-specific selector hacks, submenu/menu DOM adaptations, and list-table remaps.
- Scope split:
  - `admin-client-wp-adapter.css`: shell-wide nav/admin chrome adapter.
  - `admin-client-wp-list-adapter.css`: FOLEOs list screen only (`edit.php?post_type=foleo_page` + `body.edit-php.post-type-foleo_page`).
  - `admin-client-wp-adapter.js`: shell adapter bootstrap + FOLEOs list DOM remap guard.
- This is the first place to check when WP updates change markup/behavior.

5. **Layer 4b: Nav Fallback Sublayer (Intentional WP Fragility Isolation)**
- File: `wp-content/plugins/foleo-core/includes/admin_client/menus.php`
- Purpose: left-nav resilience only when adapter assets are delayed/missed.
- Strict boundary:
  - Client-shell gated.
  - CSS anchored to `#adminmenuwrap #adminmenu` only.
  - JS queries/mutations rooted to `#adminmenu` subtree.
- Idempotency:
  - Uses `.foleo-admin-logo` existence guard.
  - Uses `data-foleo-nav-fallback="1"` sentinel on `#adminmenu`.
  - Retry loop is capped and exits cleanly.

## Established Patterns
### Views (page filters)
- Class: `foleo-ui-views`
- Behavior:
  - Inactive: blue text
  - Active: white chip, dark text, no shadow
- Usage: `All | Published | Trash` style view tabs.

### Primary Page Action (single action near page title/views row)
- Class: `foleo-ui-page-action`
- Use for single top-level action in list/header areas (ex: Add FOLEO).

### Page Action Buttons (multi-action CTA row)
- Base: `foleo-ui-page-action-btn`
- Variants:
  - `foleo-ui-page-action-btn--primary`
  - `foleo-ui-page-action-btn--secondary`
- Use for larger page-level CTAs (Workspace: Upload content, Create FOLEO, Help).
- Setup/detail header rule:
  - Primary control (`Save & Continue`) must use `foleo-ui-page-action-btn--primary`.
  - Companion control (`Save`) must use `foleo-ui-page-action-btn--secondary`.

### Utility Bar
- Class: `foleo-ui-utilitybar`
- Purpose: filtering/search/utility controls (`Bulk actions`, `Apply`, `Search` icon).

### Element Action Buttons (inside list rows/cards)
- Base: `foleo-ui-btn`
- Variants:
  - `foleo-ui-btn--secondary` (default row action)
  - `foleo-ui-btn--primary` (highlight one action in a set; ex: Edit)
  - `foleo-ui-btn--delete` (danger hover red)
  - `foleo-ui-btn--utility` (light gray, lowercase, no border)

### SEO Visibility Toggle
- Pattern: text links, not button pills.
- Active state: bold + black.
- Inactive state: blue + regular weight.

### Card Grid Snap Behavior
- For FOLEO card/picker grids: snap columns by breakpoint (`4/3/2/1`), avoid fluid per-card stretching.

## Workspace Baseline
- Header: `Workspace`.
- `Get started` section uses page-action button row (content-width buttons).
- `Recent FOLEOs` section:
  - 60px spacing under section header.
  - Cards include 1:1 media placeholder.
  - Actions follow element-action hierarchy.

## FOLEOs List Baseline
- Native WP list table adapted to FOLEO UX through Layer 4 list adapter.
- Adapter CSS/JS remap must apply only on FOLEOs list screen signature.
- Actions column order:
  - `Edit` (primary blue)
  - `Clone` (secondary)
  - `Preview/View/Build` (secondary)
  - `Delete` icon (secondary + delete variant)
- Search submit is icon-only utility action.
- Screen Options/help visibility and menu route hiding are adapter concerns.

## Implementation Rules
- Add new UX behavior in this order:
  1. Reuse existing `foleo-ui-*` class.
  2. If needed, add new reusable `foleo-ui-*` pattern (Layer 2).
  3. Compose in screen CSS (Layer 3).
  4. Use Layer 4 only when required by WP markup constraints.
  5. Use Layer 4b nav fallback only for left-nav resilience; keep it minimal and isolated.
- Avoid adding new `!important` outside Layer 4.
- Avoid text/value-based DOM selectors in JS unless no stable attribute exists.

## Audit Checklist for New Screens
- Pattern reuse: no duplicate one-off button styles.
- Layer placement: no WP selector hacks in Layers 1-3.
- Primary vs secondary action hierarchy applied consistently.
- Responsive behavior: snap columns or explicit breakpoints, no accidental fluid drift.
- Adapter scripts/styles guarded by screen/body checks.
- Nav fallback (if present) stays `#adminmenu`-only and sentinel/idempotent.
