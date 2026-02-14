# Admin Guardrails
Last updated: 2026-02-14

## Pre-merge Greps

### Layer 3 must not contain WP primitives (`foleo-v1.css`)
```bash
rg -n "\\.tablenav|\\.wp-list-table|\\.widefat|\\.button|#adminmenu" wp-content/plugins/foleo-core/assets/css/foleo-v1.css
```
Expected: no matches.

### Layer 1-2 must not contain WP primitives (`admin-client.css`)
```bash
rg -n "#adminmenu|\\.wp-list-table|\\.tablenav" wp-content/plugins/foleo-core/assets/css/admin-client.css
```
Expected: no matches.

### List adapter gate integrity
```bash
rg -n "^body\\.foleo-client-shell-active" wp-content/plugins/foleo-core/assets/css/admin-client-wp-list-adapter.css | rg -v "foleo-page--list"
```
Expected: no matches.

### Shell adapter primitive usage must stay shell-gated
```bash
rg -n "^body" wp-content/plugins/foleo-core/assets/css/admin-client-wp-adapter.css | rg -v "foleo-client-shell-active"
```
Expected: no matches (except intentional non-body rules documented inline).

### Prevent `.tablenav` from reappearing in page markup (`foleo_v1.php`)
```bash
rg -n "tablenav" wp-content/plugins/foleo-core/includes/admin_client/foleo_v1.php
```
Expected: no Setup/Detail usage; only list-adapter contexts if any are intentionally documented.

## Post-merge Stats

### `!important` targets
- list adapter <= 20
- shell adapter <= 25
- components (`admin-client.css` + `foleo-v1.css`) <= 2 total

Commands:
```bash
rg -o "!important" wp-content/plugins/foleo-core/assets/css/admin-client-wp-list-adapter.css | wc -l
rg -o "!important" wp-content/plugins/foleo-core/assets/css/admin-client-wp-adapter.css | wc -l
rg -o "!important" wp-content/plugins/foleo-core/assets/css/admin-client.css wp-content/plugins/foleo-core/assets/css/foleo-v1.css | wc -l
```

## Exception Policy
Exceptions are rare and must be documented inline.

Allowed exception cases:
- unavoidable WP core collision in Layer 4 only
- minimal nav fallback safety style when adapter assets fail

Comment format:
- `/* WHY WP collision: <reason> */`
- `/* WHY fallback: <reason> */`
