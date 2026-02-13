# MODULE_MAP

## High-Level Map
- Major areas of the codebase and their responsibilities.

## Ownership
- Team or owner per module.

## Key Modules
- Important folders/files and what they do.

## Integration Points
- Where modules connect, data contracts, APIs.
- Compiler routing and builder enforcement: `includes/compiler/route.php`.
- Shell injection: `includes/compiler/tweaks.php` and `includes/page_utility/overlay.php` via unofficial Breakdance hook.
- Context gating helpers: `includes/*/context.php` and capabilities helpers, used to detect compiler requests and client editor roles.
- Client-admin UX layers:
  - Tokens/patterns: `assets/css/admin-client.css`
  - Screen composition: `assets/css/foleo-v1.css`
  - WP adapter (high-risk overrides): `assets/css/admin-client-wp-adapter.css`, `assets/js/admin-client-wp-adapter.js`
