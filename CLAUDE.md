# SCS Technologies — Claude Instructions

## Session Start
Read these files at the start of every session to restore context:
- `memory/user.md` — who the user is and how they work
- `memory/preferences.md` — code conventions, UI rules, workflow habits
- `memory/people.md` — key contacts and company info
- `memory/decisions.md` — past architectural and feature decisions

## Session End
Update any memory files that changed during the session:
- New preferences or corrections → `memory/preferences.md`
- New people or contact details → `memory/people.md`
- New architectural/feature decisions → `memory/decisions.md`
- Changes to user profile or working style → `memory/user.md`

## Decision Logging
When the user describes a decision they are making, append a row to `memory/decisions.csv` with:
- `date` — today's date (YYYY-MM-DD)
- `decision` — one-line summary of what was decided
- `reasoning` — why this option was chosen
- `expected_outcome` — what success looks like
- `review_date` — 30 days from today (YYYY-MM-DD)

## Project Stack
- **Framework:** Laravel 11 + Filament v3
- **Frontend:** Blade templates, Bootstrap 5, Font Awesome 5.x (local)
- **Admin path:** `/admin`
- **Settings model:** `App\Models\Setting` — key/value, cached
- **Branch:** `master` → remote `origin` (GitHub: asghar786/SCS-Technologies)

## Commit Rules
- Format: `type: short description` (feat / fix / style / refactor)
- Always include: `Co-Authored-By: Claude Sonnet 4.6 <noreply@anthropic.com>`
- Push only when user explicitly asks

## Key Rules
- Never render social icons when URL is empty or `#`
- New admin settings always go in `ManageSettings.php` under Site Settings
- Seed default DB values after adding new settings fields
- Test visually — type checking alone is not enough
