# CHANGELOG

## Entries
- Dated entries, newest first.

## Entry Template
- YYYY-MM-DD: Short summary of changes or discoveries.
- 2026-02-11: Compile mode: removed `.compile-type` targeting from `Compile.js` so copy blocks no longer open FOLEO HUD; native Breakdance/custom-field editing is now the default for copy. Documented root cause of missing HUD (`?compile=1` gating and class-based targeting).
- 2026-02-10: Builder iframe videos: z-index fix prevents poster ghosting after hydrate.
- 2026-02-10: Builder iframe videos: edit-mode poster-first flow with click-to-hydrate and mutation-based rescan for CF Stream placeholders.
- 2026-02-09: Consolidated operating docs under `_reference/__agents/`, added `AGENTS.md`, archived duplicate references, and added root stubs pointing to canonical docs.
- 2026-02-09: Compiler UI: Properties auto-closes on responsive menu open to avoid overlay conflict.
- 2026-02-09: Docs: added compiler route + Breakdance injection contract notes and post-update checklist items.
- 2026-02-09: Builder iframe: gated runtime animation bundles (GSAP/ScrollTrigger/Lenis) to prevent console errors.
- 2026-02-09: Builder iframe: narrowed guard to skip runtime JS bundles while allowing safe CSS.
- 2026-02-09: Editor Lottie preview: last-frame placeholder with admin-only preview controls in edit contexts.
- 2026-02-09: Editor Lottie preview enabled in compiler/builder shell for editors (no ScrollTrigger).
