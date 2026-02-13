# LOGIC

## Overview
- Short description of core behaviors and invariants.

## Core Flows
- Step-by-step outlines of main user/system flows.
- `/compiler/{id}` rewrite → query vars → `template_redirect` validates access → sets `FOLEO_COMPILER_MODE` → forces builder mode via `breakdance=builder` and `id` → injects FOLEO UI and tweaks via Breakdance shell hook.

## Tricky Behaviors
- Edge cases and non-obvious rules.
- Client-shell admin IA v1 owns nav via Dashboard submenu routes (`foleo-workspace`, `edit.php?post_type=foleo_page`, `foleo-assets`, `foleo-setup`) while hidden-but-routable internal pages (`foleo-v1-detail`, `foleo-v1-new`) stay registered and are hidden via CSS to avoid wp-admin "not allowed" regressions.
- `foleo-workspace` must remain registered under `index.php` (Dashboard parent) so the top-level Workspace menu target resolves to Workspace; do not register it as `null` parent in client shell.
- FOLEOs list uses native `edit.php?post_type=foleo_page` under Workspace. Client-shell category toggles (`foleo_bucket=published|draft|all`) are visual helpers layered on top of native views and are applied in query filters (`pre_get_posts` + `posts_where`) so “Published” includes `post_status=publish` OR non-empty `foleo_live_url`.
- FOLEO native list columns are customized for client shell (`manage_edit-foleo_page_columns`): SEO Visibility (row On/Off toggle), Status, Get URL, and Action (View/Preview/Build). SEO row toggle is nonce-protected on `admin_init` and writes both `foleo_seo_enabled` and `foleo_public_seo_enabled`.
- SEO compatibility bridge: FOLEO SEO writes also mirror to legacy `foleo_seo_visibility` (`on`/`off`), and FOLEO SEO reads use that key as fallback when FOLEO-native SEO meta is absent.
- Client-shell `foleo_page` list declutter: row actions under title are suppressed; edit-post links and `post.php?post={id}` are normalized to FOLEO OPEN detail route (`admin.php?page=foleo-v1-detail&foleo_page_id={id}`).
- FOLEO rename lives in OPEN detail Setup form (`foleo_name`) and saves `post_title` during `review_status_save`; no separate name-only editor flow is required in client shell.
- Client-shell `foleo_page` list UX locks for v1: hide Screen Options/help tabs, keep native `All|Published|Trash` views, emphasize current view via styling, and enforce decluttered table visuals (no zebra striping, thin row separators, hidden duplicate footer header row).
- FOLEO list control layout is intentionally remapped in client shell via `foleo-v1.js`: Add FOLEO is shown in the top-right search area while list search controls are relocated to top tablenav actions; `foleo_page` post-state chips under title are suppressed.
- FOLEO list action hierarchy (v1): `Edit` is primary (blue outline), `Get URL`/`Preview`/`View` are secondary (gray border/black text), delete is icon-only trailing action; SEO On/Off remains text-state based with active state rendered in bold black.
- Utility button class for admin UX baseline: `foleo-v1-btn-utility` (light gray fill, gray lowercase text, no border, subtle shadow, darker hover). In current FOLEO list implementation this class is applied to bulk Apply and search submit controls only.
- Action button hierarchy is now class-based and reusable (not one-off): `foleo-v1-btn-action` base + modifiers `foleo-v1-btn-action--secondary`, `foleo-v1-btn-action--primary`, `foleo-v1-btn-action--delete`. Primary is a highlight modifier on top of shared base dimensions/radius/shadow.
- Shared admin UX pattern classes are now defined in `assets/css/admin-client.css` for cross-screen adoption: `foleo-ui-views`, `foleo-ui-page-action`, `foleo-ui-utilitybar`, and `foleo-ui-btn` with `--secondary|--primary|--delete|--utility` variants.
- Page-level action sizing pattern: `foleo-ui-page-action-btn` defines a larger action tier (15px text, 38px height, centered label, content-width sizing) with reusable variants `foleo-ui-page-action-btn--primary` (blue) and `foleo-ui-page-action-btn--secondary` (neutral gray/black).
- Workspace CTA implementation now uses page-action pattern classes (`Upload content`, `Create FOLEO`, `Help`) and a content-width flex row (`foleo-v1__cta-grid`) instead of equal-width 3-column buttons.
- Workspace recent-cards now include a placeholder media frame (`.foleo-v1__card-media`) with a fixed 1:1 ratio and section-head spacing standard of 60px under `Recent FOLEOs` in workspace context.
- Client-shell admin footer is overridden via `admin_footer_text`/`update_footer` filters so WordPress default footer text/version do not appear in client view.
- FOLEO card-grid behavior now uses snapped breakpoint columns (`4 -> 3 -> 2 -> 1`) for `.foleo-v1__card-grid` and `.foleo-v1__picker-grid` to reduce fluid card resizing as viewport width changes.
- FOLEOs list Actions now includes `Clone`, wired to the existing `foleo-v1-new&base_id={id}` clone flow; `Edit` remains the primary action and uses high-specificity primary button selectors in the action column to avoid being overridden by generic secondary button styles.
- Client-admin UX now follows a 4-layer contract: Layer 1 tokens/base theme, Layer 2 reusable `foleo-ui-*` patterns, Layer 3 screen composition (`foleo-v1.css`), Layer 4 WP adapter overrides (`admin-client-wp-adapter.css` + `admin-client-wp-adapter.js`) for high-risk WP selector/DOM remaps.
- Layer boundary enforcement update: `admin-client.css` now contains only FOLEO-scoped selectors (`.foleo-admin-theme-scope` and `foleo-ui-*` patterns). WP primitives (`.wrap`, `.button`, `.wp-list-table`, `.tablenav`, `.notice`) live only in Layer 4 adapter files.
- Layer 4 adapter split: shell-wide nav/adminmenu behavior stays in `admin-client-wp-adapter.css`, while FOLEO native list-table remap rules moved to `admin-client-wp-list-adapter.css`, enqueued only on `edit.php?post_type=foleo_page` and additionally gated by `body.edit-php.post-type-foleo_page`.
- FOLEOs list WP remap selectors were moved from `foleo-v1.css` into Layer 4 adapter CSS; submenu/nav hide/indent selectors were moved from `admin-client.css` into Layer 4 adapter CSS.
- FOLEOs list DOM reshaping (search relocation/filter removal/button utility classes) was moved from `foleo-v1.js` into Layer 4 adapter JS. `foleo-v1.js` now focuses on FOLEO component behavior (copy-url interactions).
- Workspace regression guard: Recent FOLEO cards now render `Edit` exactly once in all states; `Preview` is additive when draft URL exists.
- WP adapter JS now removes the native date filter submit by stable id selector (`#post-query-submit`) instead of button value text matching.
- Copy-url interactions now preserve each button’s original label after the temporary `Copied` state (instead of always resetting to `Copy URL`).
- Pattern adoption rule: when migrating screens, add shared `foleo-ui-*` classes alongside existing local classes first (dual-class period), then remove old local classes only after visual parity is confirmed.
- Properties panel is designed to sit above Breakdance UI, but responsive menu is a known conflict, so Properties auto-closes on responsive menu open.
- Canonical redirects are disabled for compiler requests, URL is normalized to `/compiler/{id}` via `history.replaceState`.
- Builder shell bypasses WP enqueues, injection relies on the Breakdance hook, with fallback injection path if present.
- In edit contexts, Lottie renders as a last-frame placeholder; admin-only overlay controls can preview once and return to last frame.
- Breakdance iframe renders CF Stream placeholders after initial DOMContentLoaded; edit-mode poster overlays must rescan and watch for mutations to attach posters and play buttons.
- Edit-mode video behavior is poster-first: no SDK/HLS preloading in builder iframe, click-to-hydrate only, and unload-on-exit returns to poster.
- Edit-mode video ghosting: keep iframe above placeholder via z-index after hydrate to avoid poster bleed-through.
- Legacy compile HUD for copy fields was tied to `?compile=1` and `.compile-type` selectors. It will not appear in normal builder/property editing flows, and copy edits should use native Breakdance custom-field bindings. Compile overlays now target media/table/lottie only.

## Regressions to Watch
- Known pitfalls and tests that must not fail.

## TODOs
- Open implementation questions or gaps.
