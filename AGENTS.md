# AGENTS

## Session Start
Read these in order:
- _reference/__agents/CODEX.md
- _reference/__agents/ARCHITECTURE.md
- _reference/__agents/LOGIC.md
- _reference/__agents/DEPLOY.md
- _reference/__agents/MODULE_MAP.md
- _reference/__agents/ROADMAP.md
- _reference/__agents/CHANGELOG.md
- _reference/__agents/RISK_REGISTER.md

Then post a Context Reload Summary with:
- Active constraints and workflow rules
- Known risks and brittle areas
- Current sprint focus
- Do-not-touch areas

Default mode: Diagnose + Recommend only. No edits unless user says "Execute".

## Session End
- Capture lessons learned in the correct doc(s).
- Append a dated entry to CHANGELOG.md.

## FOLEO Client Admin UX (required)
For any changes to FOLEO client-shell wp-admin UX, you MUST follow:
- UX-Client-Admin.md (living spec): layer contract, patterns, nav fallback boundaries, and QA checklist.

Rules of engagement
- Enforce the 4-layer contract. No WP primitive selectors in Layers 1-3.
- WP markup hacks and DOM remaps live only in Layer 4 files.
- Left-nav resilience fallback is allowed only under the Layer 4b rules in UX-Client-Admin.md.
- After any UX change, run the manual QA checklist from UX-Client-Admin.md and report results.
