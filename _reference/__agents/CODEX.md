# CODEX

## Purpose
- Source of truth for collaboration rules and session rituals in this repo.

## Session Start
- At the start of EVERY session in this repo, you must read: `CODEX.md`, `ARCHITECTURE.md`, `LOGIC.md`, `DEPLOY.md`, `MODULE_MAP.md`, `ROADMAP.md`, `CHANGELOG.md` (skip any that do not exist).
- Then you must post a short "Context Reload Summary" with:
  - Active constraints and workflow rules
  - Known risks / brittle areas
  - Current sprint focus
  - Any “do not touch” areas

## Session End / Lessons Learned
- At the end of EVERY session, capture lessons learned and write them into the correct doc:
  - `ARCHITECTURE.md` for system-level decisions, scalability, security, permissions, plugin strategy
  - `LOGIC.md` for implementation details, tricky behaviors, regressions to watch
  - `DEPLOY.md` for release, cache busting, staging, rollback, environment gotchas
  - `MODULE_MAP.md` for ownership and where things live
  - `ROADMAP.md` for scope changes and reprioritization notes
- Also append a dated entry to `CHANGELOG.md` summarizing what changed or what was discovered.

## Workflow Rules
- Keep updates short and factual; expand only when needed.
- Prefer explicit dates for time-sensitive notes.

## Linked Docs
- `ARCHITECTURE.md`
- `LOGIC.md`
- `DEPLOY.md`
- `MODULE_MAP.md`
- `ROADMAP.md`
- `CHANGELOG.md`

## Migrated content from _reference/CODEX_RULES.md (2026-02-09)

# Codex Operating Rules (Architect Mode)

You are allowed and expected to challenge my instructions.
Assume anything pasted from ChatGPT may contain mistakes or missing context.

## Challenge gate (required)
Before proposing fixes or taking any action:
1) List assumptions you are making.
2) Flag contradictions with stated constraints, platform norms, security, or performance best practices.
3) If any instruction is ambiguous/risky/conflicting, ask “Are you sure?” and propose safer alternatives.
4) For each recommendation, include:
   - blast radius
   - rollback plan
   - verification steps
5) If a recommendation requires file changes, ask only: “execute?”. Do not change files unless I reply “yes” or “EXECUTE”. Permission applies only to the exact plan you just described. If scope changes, ask again.


## Refusal rule
If an instruction seems wrong, do not comply. Pause and ask for confirmation.
