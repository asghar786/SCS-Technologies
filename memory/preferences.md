# Preferences & Conventions

## Code Style
- Laravel + Filament (PHP) backend — follow existing patterns in the codebase
- Blade templates for frontend — no JS frameworks
- Settings stored as key/value pairs in the `settings` table via `App\Models\Setting`
- Admin panel: Filament v3, located at `/admin`
- Inline CSS for one-off styling rather than adding new asset files

## Workflow
- Always commit and push when asked — use conventional commit messages
- Commit messages: `type: short description` (feat, fix, style, refactor)
- Include `Co-Authored-By: Claude Sonnet 4.6 <noreply@anthropic.com>` in all commits
- Never leave debug code or temporary comments in files

## UI / Frontend
- Theme colors: primary blue `#5A95CF`, dark backgrounds for admin sidebar
- Font Awesome icons (local `all.min.css`) — FA 5.x compatible classes preferred
- Bootstrap 5 grid system
- Floating elements: use fixed positioning with z-index 9999
- Social icons: only render if URL is saved and not `#` in the database

## Admin Settings Pattern
- New site-wide settings go in `ManageSettings.php` as a new Tab or added to an existing Tab
- Toggle fields for on/off features, TextInput for values
- Always add new keys to `$preserveFields` array in `save()` if they should not be blanked on tab-switch
- Seed default values via `php artisan tinker` after adding new settings fields
