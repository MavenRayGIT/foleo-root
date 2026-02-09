# FOLEO UI Surfaces (V1)

## Properties Panel (Compiler)
- Location: `/compiler/<id>`
- Audience: client editors only
- Source of truth: FOLEO REST (`/wp-json/foleo/v1/page/<id>`)
- Fields:
  - Title
  - Slug
  - Status (draft/publish)
  - Thumbnail (set/clear by ID)
  - Meta allowlist: foleo_fade_img_1/2/3, foleo_poster, foleo_cf_stream_id
- UI: gear toggle button opens/closes panel
- Gated by: client shell kill switch + client editor + compiler context

## Settings Page (Stub)
- Location: Workspace → Settings (wp-admin)
- Audience: client editors only
- Status: placeholder only (“FOLEO Settings (coming soon)”)
- Future: binder/profile configuration
- Gated by: client shell kill switch
