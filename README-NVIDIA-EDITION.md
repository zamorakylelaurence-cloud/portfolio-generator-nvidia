# MyPortfolio — NVIDIA-inspired dark edition

This is a separate copy of the MyPortfolio Laravel project with a dark NVIDIA-inspired visual theme. The original project is not modified.

Palette: `#76B900` green, `#101010` black, `#1F1F1F` charcoal.

## Setup

1. Install PHP dependencies: `composer install`
2. Copy `.env.example` to `.env` and configure your own environment/database credentials. Do not copy credentials into source control.
3. Generate the app key: `php artisan key:generate`
4. Install frontend dependencies: `npm install`
5. Build assets: `npm run build`
6. Run migrations if needed: `php artisan migrate`
7. Start Laravel: `php artisan serve`

This archive intentionally excludes `.env`, `.git`, `vendor/`, and `node_modules/`. Configure the `.env` for this copy independently. If you point both versions to the same Supabase database, they will share portfolio data; use a separate database/project if you want complete data separation.

## Main theme files

- `resources/views/layouts/app.blade.php` — shared navigation, forms, cards, and global UI theme.
- `resources/css/app.css` — Simple, Modern, and Creative portfolio templates.
