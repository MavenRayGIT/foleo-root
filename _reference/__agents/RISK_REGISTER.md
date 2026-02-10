# RISK_REGISTER

## Open Risks
- Risk, impact, likelihood, owner, mitigation.
- Breakdance toolbar popovers vs FOLEO Properties overlay
  Symptom: responsive menu/popover can appear under Properties panel.
  Mitigation: auto-close Properties panel when responsive menu opens, avoid z-index wars with brittle selectors.
  Regression test: open compiler, open Properties, click responsive icon, confirm menu is visible and Properties closes.
- Breakdance iframe DOM mutates after initial load, which can drop CF Stream edit overlays.
  - Mitigation: run poster/overlay rescan after render and attach mutation observers for placeholder changes.
  - Regression test: in builder iframe, posters and play overlays appear on all CF Stream placeholders after a hard reload; click hydrates and plays; scroll-away unload returns to poster.
- Breakdance shell hook `unofficial_i_am_kevin_geary_master_of_all_things_css_and_html` may change, FOLEO injection fails.
  - Mitigation: keep fallback injection path, run post-update smoke tests.
- Breakdance query param contract changes (`breakdance=builder`, `id`) can break compiler routing.
  - Mitigation: verify `/compiler/{id}` after updates, update enforcement logic if needed.
- Rewrite rules can remain stale across multisite until admin visit.
  - Mitigation: ensure admin visit post-update or manual flush, bump `FOLEO_COMPILER_REWRITE_VERSION` when needed.
- Builder/compiler/iframe contexts must avoid runtime JS bundles (GSAP/ScrollTrigger/Lenis); safe CSS only.
  - Mitigation: gate runtime asset enqueues in MU loader for builder contexts.
- Builder iframe aims for production fidelity, tolerate minor console warnings, block only disruptive runtime errors.

## Mitigations
- Active mitigation plans and status.
