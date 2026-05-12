# Key Project Decisions

## Architecture
- **2026-05-12** — Chose Filament v3 for admin panel over a custom-built solution.
  - *Reasoning:* Faster to build, consistent UI, built-in auth.
- **2026-05-12** — Settings stored as flat key/value rows in a `settings` table rather than a config file.
  - *Reasoning:* Allows non-technical admin to change values without a deployment.

## Features
- **2026-05-12** — WhatsApp floating button placed bottom-left (not bottom-right).
  - *Reasoning:* User's explicit preference.
- **2026-05-12** — Social icons hidden on frontend when URL is empty or `#`.
  - *Reasoning:* Prevents broken/placeholder links from appearing publicly.
- **2026-05-12** — Added TikTok, Pinterest, Threads as additional social handles.
  - *Reasoning:* User requested 3 more popular platforms beyond the original 5.

## Content
- **2026-05-12** — Blog section renamed to "Insights".
  - *Reasoning:* More professional tone for a B2B audience.
