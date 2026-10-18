# FolioForge — Laravel Portfolio Template Generator

This is a Laravel source-code overlay for the **Online Portfolio Template Generator** assignment. It provides CRUD, profile image upload, exactly three portfolio templates (Simple, Modern, Creative), template selection, preview, and print/save-as-PDF.

> This is not a prebuilt Laravel framework/vendor bundle. Add these files to a fresh Laravel 11 or 12 application.

## 1. Create a Laravel project

In VS Code terminal, run:

```bash
composer create-project laravel/laravel portfolio-generator
cd portfolio-generator
```

Copy the folders/files from this package into the matching paths in the new `portfolio-generator` folder, merging when prompted. Keep the generated Laravel framework files.

## 2. Configure an online PostgreSQL database

Create a PostgreSQL database with a provider such as Supabase, Neon, or Railway. Copy the provider's connection values into `.env`:

```dotenv
APP_NAME="FolioForge"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://YOUR-PUBLIC-SITE.example

DB_CONNECTION=pgsql
DB_HOST=YOUR_CLOUD_DATABASE_HOST
DB_PORT=5432
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD="YOUR_DATABASE_PASSWORD"
```

Use the provider's required SSL setting if specified. Never commit `.env` or expose database credentials in frontend JavaScript.

For local testing, use your provider's cloud credentials too; this verifies that data is stored online rather than only on your computer.

## 3. Install PHP database support and prepare storage

Make sure PHP has `pdo_pgsql` enabled. Then run:

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan serve
```

Open `http://127.0.0.1:8000`.

If you use a provider other than PostgreSQL, change `DB_CONNECTION` and the corresponding connection settings. The migration uses Laravel's JSON columns, supported by PostgreSQL and modern MySQL/MariaDB.

## 4. Routes / test flow

- `/` — Home
- `/portfolios/create` — Enter information and save it
- `/portfolios/{id}/templates` — Select one of the three templates
- `/portfolios/{id}/preview` — Generated portfolio preview
- `/portfolios` — Manage saved portfolios
- `/portfolios/{id}/edit` — Edit information
- Delete button on Manage Portfolios — Delete a record and its uploaded image

The portfolio data is saved to the database. Profile pictures are saved to Laravel's public storage disk. For deployment, configure persistent/object storage for uploaded files if your host uses an ephemeral filesystem.

## 5. Deploy

A straightforward option is Render (PHP web service) plus a managed PostgreSQL provider, or Laravel-compatible hosting. Configure the same environment variables in the host dashboard; do not upload `.env`.

Typical deployment commands:

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
```

Set `APP_ENV=production`, `APP_DEBUG=false`, a strong `APP_KEY`, and the real `APP_URL`. Make sure the web server document root points to Laravel's `public/` directory.

**Important for uploaded profile pictures:** many application hosts have ephemeral disks. Use a persistent disk or S3-compatible object storage for production uploads, otherwise uploaded images may disappear on redeploy. Database rows themselves persist in the cloud database.

## 6. Before submitting

- [ ] The published URL opens without login
- [ ] Create a portfolio and save it
- [ ] Check that a row appears in the cloud database
- [ ] Choose Simple, Modern, and Creative and verify their designs differ
- [ ] Refresh the page and confirm saved portfolio data remains
- [ ] Edit the portfolio and verify changes persist
- [ ] Delete the portfolio and verify the row is removed
- [ ] Test on a phone-sized browser
- [ ] Verify no secrets are committed to GitHub

## Security / assignment note

This starter is designed as a classroom demo and does not include user accounts or per-user access controls. Do not store sensitive personal information in a public demo. Before using it with real users, add authentication, authorization policies, rate limiting, and appropriate upload/storage protections.
