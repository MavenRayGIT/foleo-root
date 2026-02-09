# Client Shell (WP Admin)

Purpose
- Provide a simplified, client-safe WordPress admin UI for client editors.
- Hide WordPress complexity while preserving full admin behavior.

Scope
- Applies to client editors only: users with `edit_posts` and without `manage_options`.
- Only in wp-admin (not network admin).
- Admins see default WordPress + Breakdance UI.

Kill Switch (Disable Client Shell)
- Define in `wp-config.php` (or a MU file):
  `define('FOLEO_CLIENT_SHELL_ENABLED', false);`
- Or use a filter:
  `add_filter('foleo_client_shell_enabled', '__return_false');`
- When disabled, all client-only menu/CSS/JS/admin-bar changes are skipped.

Known Fragility Points
- WP admin menu DOM selectors (WordPress updates may rename classes/markup).
- Collapsed menu behaviors (`folded`/`auto-fold` classes).
- Rank Math profile field markup (third-party plugin changes).
- Breakdance admin components should remain untouched.

Quick Rollback
1) Disable the client shell via the kill switch above.
2) If needed, comment out requires in `wp-content/plugins/foleo-core/foleo-core.php` for:
   - `includes/admin_client/menus.php`
   - `includes/admin_client/pages_list.php`
   - `includes/admin_client/search_visibility.php`
   - `includes/admin_client/editor_block.php`
   - `includes/admin_client/profile.php`
3) Clear cache and refresh admin pages.

Test Checklist
- Admin user:
  - Default WP admin UI.
  - No renamed Dashboard, no custom logo/tooltips, admin bar normal.
- Client editor:
  - Custom nav layout (logo, Logout/Profile top, Workspace/Media centered, Collapse bottom).
  - Admin bar hidden.
  - Pages list shows custom row action + Search Visibility UI.
  - Profile page trimmed (no Rank Math/"About Yourself"/admin color scheme, etc.).
- Kill switch OFF:
  - Client UI returns to default WP admin without errors.

Files Involved
- `wp-content/plugins/foleo-core/includes/core/context.php`
  - Client shell enable/disable helpers.
- `wp-content/plugins/foleo-core/includes/admin_client/menus.php`
  - Admin menu layout, logo, tooltips, nav spacing.
- `wp-content/plugins/foleo-core/includes/admin_client/pages_list.php`
  - Pages list row actions, title rename.
- `wp-content/plugins/foleo-core/includes/admin_client/search_visibility.php`
  - Search Visibility column + REST endpoints.
- `wp-content/plugins/foleo-core/includes/admin_client/editor_block.php`
  - Client redirects to /compiler/<id>.
- `wp-content/plugins/foleo-core/includes/admin_client/profile.php`
  - Client profile page cleanup + admin bar hide.
