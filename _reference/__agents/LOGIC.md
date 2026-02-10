# LOGIC

## Overview
- Short description of core behaviors and invariants.

## Core Flows
- Step-by-step outlines of main user/system flows.
- `/compiler/{id}` rewrite → query vars → `template_redirect` validates access → sets `FOLEO_COMPILER_MODE` → forces builder mode via `breakdance=builder` and `id` → injects FOLEO UI and tweaks via Breakdance shell hook.

## Tricky Behaviors
- Edge cases and non-obvious rules.
- Properties panel is designed to sit above Breakdance UI, but responsive menu is a known conflict, so Properties auto-closes on responsive menu open.
- Canonical redirects are disabled for compiler requests, URL is normalized to `/compiler/{id}` via `history.replaceState`.
- Builder shell bypasses WP enqueues, injection relies on the Breakdance hook, with fallback injection path if present.
- In edit contexts, Lottie renders as a last-frame placeholder; admin-only overlay controls can preview once and return to last frame.
- Breakdance iframe renders CF Stream placeholders after initial DOMContentLoaded; edit-mode poster overlays must rescan and watch for mutations to attach posters and play buttons.
- Edit-mode video behavior is poster-first: no SDK/HLS preloading in builder iframe, click-to-hydrate only, and unload-on-exit returns to poster.
- Edit-mode video ghosting: keep iframe above placeholder via z-index after hydrate to avoid poster bleed-through.

## Regressions to Watch
- Known pitfalls and tests that must not fail.

## TODOs
- Open implementation questions or gaps.
