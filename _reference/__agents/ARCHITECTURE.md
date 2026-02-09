# ARCHITECTURE

## Overview
- One-paragraph system summary and boundaries.

## System Context
- Key actors, data flows, and integrations.

## Key Decisions
- Rationale for major architectural choices.

## Cadence and Roles
- ChatGPT is Architect (strategy, constraints, design, decisions, roadmap, risk framing).
- Codex is Dev (repo discovery, diagnosis, implementation proposals, can challenge assumptions).
- Default process: Diagnose and recommend first. Only implement after an explicit "Execute" request.

## Constraints
- Non-negotiables, platform limits, performance requirements.

## Risks / Brittle Areas
- Places most likely to break or regress.

## Future Considerations
- Scalability, security, compliance, long-term evolution.

## Migrated content from _reference/architecture.md (2026-02-09)

# FOLEO Core Architecture

Last updated: 2026-02-08

## FOLEO Core System Overview
FOLEO Core provides a client-safe editing surface on top of Breakdance and WordPress multisite.
The canonical entry point is `/compiler/<id>` (not direct builder URLs).

FOLEO Core lives in `wp-content/plugins/foleo-core/` and owns:
- `/compiler/<id>` routing and rewrite maintenance
- Compiler UI tweaks and Exit behavior
- Client-facing wp-admin presentation rules
- Page utility REST endpoints and overlay UI
- Binder/profile schema placeholders

A minimal MU loader in `wp-content/mu-plugins/foleo-loader.php` can require the plugin for must-use behavior.

## Request Flow (High Level)
- Client clicks “Compile FOLEO” in Pages list → `/compiler/<id>`
- `/compiler/<id>` rewrite sets builder mode for that post ID
- Breakdance serves the builder app shell

## Breakdance Builder Shell vs Normal WP Render
The Breakdance builder UI is a standalone app shell rendered by `wp-content/plugins/breakdance/plugin/loader/loader.php`. That shell:
- Outputs its own HTML, CSS, and JS bundles
- Does NOT execute normal WordPress `wp_head` / `wp_footer` enqueues
- Provides a Breakdance-specific hook at the end of the shell HTML:
  `unofficial_i_am_kevin_geary_master_of_all_things_css_and_html`

Because the builder shell bypasses WP enqueues, compiler tweaks must be injected using the builder-shell hook.
FOLEO uses that hook to print:
- `window.FOLEO_COMPILER_TWEAKS` config
- `assets/js/compiler-tweaks.js`
- `assets/css/compiler-tweaks.css`
The injection logic lives in:
`wp-content/plugins/foleo-core/includes/compiler/tweaks.php`

A fallback injection is registered on `admin_print_footer_scripts` but only when a compiler request is active and a builder request is detected. If the Breakdance hook stops firing in a future update, FOLEO logs a rate-limited warning:
`FOLEO: builder-shell injection hook not fired; Breakdance update may have changed hook.`

Normal WP enqueues are still valid for non-builder pages (wp-admin lists, front-end, and overlays), but not for the Breakdance builder shell.

## Gating Rules (Single Source)
- Client editor: `edit_posts` true AND `manage_options` false
- Admin: `manage_options` true
- Compiler view: `/compiler/<id>`
- Client wp-admin:
  - Pages-only navigation
  - `post.php` editing is blocked/redirected

## FOLEO Core Module Map
Core helpers:
- `includes/core/capabilities.php` - client/admin capability gates
- `includes/core/context.php` - compiler and builder request detection
- `includes/core/assets.php` - asset URL resolution

Compiler:
- `includes/compiler/route.php` - `/compiler/<id>` rewrite + auto-flush
- `includes/compiler/tweaks.php` - builder-shell injection + tweaks gating
- `includes/compiler/widgets.php` - placeholder for compiler widgets
- `includes/compiler/rest.php` - placeholder for compiler REST endpoints

Page utility:
- `includes/page_utility/rest.php` - title/slug/status/thumbnail/meta REST
- `includes/page_utility/overlay.php` - compiler overlay UI injection

Client wp-admin:
- `includes/admin_client/menus.php` - menu pruning + dashboard redirect
- `includes/admin_client/pages_list.php` - row actions + post state labels
- `includes/admin_client/editor_block.php` - redirect post editor
- `includes/admin_client/profile.php` - profile cleanup + admin bar

Binder (placeholders):
- `includes/binder/schema.php`
- `includes/binder/rest.php`
- `includes/binder/ui.php`

Assets:
- `assets/js/compiler-tweaks.js` - builder UI patches and Exit handling
- `assets/js/compiler-utility.js` - overlay UI
- `assets/js/binder-panel.js` - binder UI placeholder
- `assets/css/compiler-tweaks.css`
- `assets/css/compiler-utility.css`
- `assets/css/admin-client.css`

## Deterministic Routing Rules
- `/compiler/<id>` is the canonical entry point for building pages.
- Any `?breakdance=builder&id=<id>` client entry should redirect to `/compiler/<id>`.
- Client wp-admin is Pages-only and “Edit” routes to `/compiler/<id>`.
- Admins retain full wp-admin and do not see compiler tweaks.

## Known Failure Modes + Fixes
- Fatal on load after deploy (missing includes): upload the full plugin folder; the soft-fail guard prevents total outage if a file is missing.
- `/compiler/<id>` 404 after clone: one-time auto-flush runs on first admin visit; bump rewrite version if needed.
- Exit to WordPress broken: confirm builder-shell injection ran (View Source includes `FOLEO_COMPILER_TWEAKS`).
- “Edit in Breakdance” reappears: ensure row actions filter runs at priority `999` and returns only Compile.
