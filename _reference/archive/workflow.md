# Workflow Notes

Last updated: 2026-02-08

## Deploy Workflow (Safe)
1. Disable MU loader (rename to not `.php`).
2. Upload plugin as `foleo-core__NEW`.
3. Verify critical files exist:
   - `includes/core/capabilities.php`
   - `includes/core/context.php`
   - `includes/core/assets.php`
4. Atomic swap:
   - `foleo-core` → `foleo-core__BROKEN`
   - `foleo-core__NEW` → `foleo-core`
5. Re-enable MU loader.
6. Verify:
   - `/wp-login.php`
   - `/compiler/<id>`

## Multisite Clone Checklist
1. Clone site.
2. First admin visit triggers one-time rewrite auto-flush.
3. Confirm `/compiler/<id>` works.
4. Confirm client wp-admin shows Pages only.

## Debug Checklist (Copy/Paste)
When JS tweaks do not run:
- View Source in builder: confirm `FOLEO_COMPILER_TWEAKS` exists.
- Network: `compiler-tweaks.js` loads 200.
- If missing, builder-shell hook injection is broken.

When users see builder URLs:
- Ensure Pages list action is Compile only.
- Ensure direct builder URLs redirect to `/compiler/<id>` for clients.

## Naming Conventions
- Use “builder” (not “Breakdance builder”) in docs.
- Use “compiler” for FOLEO client editing surface.
