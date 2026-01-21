# FOLEO UI SPEC (FUIS)

## Principles
- Spec-first, implementation second
- No page-level selectors
- Tokens over raw values
- Mobile explicitly defined
- Debug borders during layout phase

## Tokens
- Spacing: --space-8, --space-16, --space-24, --space-48, --space-96
- Radius: --radius-sm, --radius-md, --radius-lg
- Color: --color-bg, --color-surface, --color-text, --color-accent

## Canonical Components
- Container: .container-xl
- Stack: .stack-24, .stack-48
- Card: .card, .card--stat
- Button: .btn, .btn-primary

## Layout Rules
- Sections must declare a root hook class
- Children only targeted via that root
- No Breakdance auto-classes targeted
