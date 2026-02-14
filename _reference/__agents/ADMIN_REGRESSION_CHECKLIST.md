# Admin Regression Checklist
Last updated: 2026-02-14
Baseline reference: `FOLEO_CORE_VERSION 0.4.62`

Run this after any FOLEO admin CSS/JS change.

## 1) Workspace
URL:
- `https://macklee.foleo.co/wp-admin/admin.php?page=foleo-workspace`

Gate assertions:
- Body includes `foleo-client-shell-active`.
- `.wrap` includes `foleo-admin-theme-scope`.
- Page root includes `.foleo-page--workspace`.

Golden UI assertions:
- CTA hierarchy holds: primary for Upload/Create, secondary for Help.
- CTA buttons are content-width, not full-width.
- Recent FOLEOs spacing and card rhythm unchanged.
- Card grid snap behavior remains stable.
- Footer override remains FOLEO client footer.

## 2) Add Gate (Template Picker)
URL:
- `https://macklee.foleo.co/wp-admin/admin.php?page=foleo-v1-new`

Gate assertions:
- Body includes `foleo-client-shell-active`.
- `.wrap` includes `foleo-admin-theme-scope`.
- Page root includes `.foleo-page--new`.

Golden UI assertions:
- Feature panel appears and remains compact.
- "Start with a template" section spacing is stable.
- Card metadata lines (Business type, Intent) render.
- Card CTAs remain Preview (secondary) and Select (primary).
- Template terminology remains user-facing.

## 3) Detail / Setup
URL:
- `https://macklee.foleo.co/wp-admin/admin.php?page=foleo-v1-detail&foleo_page_id=<id>`

Gate assertions:
- Body includes `foleo-client-shell-active`.
- `.wrap` includes `foleo-admin-theme-scope`.
- Page roots include `.foleo-page--detail-shell` and `.foleo-page--detail`.
- Setup step root includes `.foleo-page--setup`.

Golden UI assertions:
- Header region under `.foleo-page--detail-shell` is styled.
- Name field sizing and status line layout are correct.
- Top Save/Save & Continue align to the right column.
- Progress bar spacing and labels remain intact.
- Three stacked white panels remain separated vertically.
- "Select another template" is compact utility style.

## 4) Assets
URL:
- `https://macklee.foleo.co/wp-admin/admin.php?page=foleo-assets`

Gate assertions:
- Body includes `foleo-client-shell-active`.
- `.wrap` includes `foleo-admin-theme-scope`.
- Page root includes `.foleo-page--assets`.

Golden UI assertions:
- Page spacing/panel structure unchanged.
- No list-table chrome leaks onto Assets.
- Button hierarchy and form styles match shell patterns.

## 5) FOLEOs List
URL:
- `https://macklee.foleo.co/wp-admin/edit.php?post_type=foleo_page`

Gate assertions:
- Body includes `foleo-client-shell-active`.
- `.wrap` includes `foleo-admin-theme-scope`.
- List root includes `.foleo-page--list`.

Hook assertions:
- Page action has `.foleo-list-page-action`.
- Utility bars include `.foleo-list-utilitybar`.
- Action buttons include `.foleo-list-action-btn` with variants.

Golden UI assertions:
- Active view chip/pill appearance unchanged.
- Add FOLEO action position unchanged.
- Top/bottom utility bars keep grey panel/radius/padding.
- Apply and Search are compact utility style.
- Search icon is visible and aligned.
- Table has no zebra striping.
- Header title text and sort arrow color unchanged.
- Row title alignment and weight unchanged.
- SEO On/Off active state bold black.
- Actions column alignment/sizing unchanged.
- Delete icon centered and red on hover.

## Pass Rule
If any gate or golden assertion fails, block merge until fixed or explicitly accepted.
