# e-Trust website (e-trust.online)

Company website of **e-Trust IT Solutions** (Moghbazar, Dhaka · serving Bangladesh and Sydney).
Laravel 12, hand-written, Three.js 3D, Poppins font (self-hosted), database: **MongoDB**.

## Pages

| URL | Colour | Notes |
| --- | --- | --- |
| `/` | Light | 3D logo tour, Our Innovation (Soon), launch-updates form |
| `/about` | Light | Globe Dhaka → Sydney |
| `/services` | Navy | 7 services (incl. Cyber security), "Get a quote" opens Contact with the service picked |
| `/projects` | Navy | Laptop scene, case study, demos in `public/demos` |
| `/team` | Navy | Team + HR "Send your CV" |
| `/assistant` | Navy | Free AI chat (also a floating chat button on every page) |
| `/contact` | Navy | Contact form |
| `/audit` | Light | Free website audit form |
| `/privacy`, `/terms` | Light | PDFs in `public/docs` |

Old URLs redirect: `/dorkari` and `/innovation` → `/#innovation`, `/privacy-policy` → `/privacy`, `/terms-of-service` → `/terms`.
`www.e-trust.online` → `https://e-trust.online` (production only, `app/Http/Middleware/CanonicalHost.php`).

## Where things are

- Pages: `resources/views/site/*.blade.php`, layout `resources/views/layouts/site.blade.php`
- Nav and footer: `resources/views/site/partials/`
- Styles: `public/css/site.css` (shared) and `public/css/pages/*.css`
- 3D: `public/js/three-site.js` (each page's 3D poses are in `window.SCENE` inside its view)
- AI chat: `public/js/chat.js`, `app/Services/AiAssistant.php`, `app/Http/Controllers/ChatController.php`
- Leads (email code): `app/Http/Controllers/LeadController.php`
- Forms: `ContactController`, `AuditController`, `LaunchUpdatesController`
- Contact details, services, team, AI providers: `config/etrust.php`
- Admin: `/admin` (all enquiries, filters, CSV download)

## Database: MongoDB

1. Make a free cluster on MongoDB Atlas (https://www.mongodb.com/atlas) and a database user.
2. Atlas → **Network Access** → allow `0.0.0.0/0` (Render free plan has no fixed IP).
3. Atlas → **Connect → Drivers** → copy the connection string.

The `Dockerfile` installs the PHP MongoDB extension and the `mongodb/laravel-mongodb` package.
Tables/collections and indexes are made by `php artisan migrate`, which runs on every start.

Quick local test without MongoDB: set `DB_CONNECTION=sqlite` (the code works with both).

## Run on your PC (Windows, VS Code terminal)

```
composer install
composer update mongodb/laravel-mongodb --with-dependencies --ignore-platform-req=ext-mongodb
copy .env.example .env
php artisan key:generate
```

In `.env` set: `APP_ENV=local`, `APP_DEBUG=true`, `APP_URL=http://127.0.0.1:8000`, `DB_CONNECTION=sqlite`, `MAIL_MAILER=log`.
(For MongoDB instead: install the PHP `mongodb` extension, then `DB_CONNECTION=mongodb` + `MONGODB_URI` + `MONGODB_DATABASE=etrust_test`.)

```
New-Item database\database.sqlite -ItemType File
php artisan config:clear
php artisan migrate --force
php artisan etrust:admin info@e-trust.online
php -S 127.0.0.1:8000 -t public
```

Open http://127.0.0.1:8000 (admin: http://127.0.0.1:8000/admin). Keep that terminal open.
Emails and the AI chat's email codes go to `storage\logs\laravel.log` while `MAIL_MAILER=log`.

## Deploy on Render (Docker)

Push to GitHub; Render builds the `Dockerfile`. In **Render → Environment** set:

| Key | Value |
| --- | --- |
| `APP_KEY` | your existing key |
| `APP_ENV` / `APP_DEBUG` | `production` / `false` |
| `APP_URL` | `https://e-trust.online` |
| `DB_CONNECTION` | `mongodb` |
| `MONGODB_URI` | your Atlas connection string |
| `MONGODB_DATABASE` | `etrust` |
| `MAIL_MAILER` + `RESEND_KEY` | `resend` + your key (Render free plan blocks SMTP) |
| `MAIL_FROM_ADDRESS` / `CONTACT_TO_ADDRESS` | `info@e-trust.online` |
| AI keys | see below |

After the first deploy, open **Render → Shell** and make the admin login:

```
php artisan etrust:admin info@e-trust.online
```

(It asks for a password, at least 10 characters.)

## AI keys

In `.env.example` every AI key says `API key here`. Replace it with a real key on Render.
A key left as `API key here` is ignored. Free providers are tried first; if one is busy, the next answers.
With no keys at all, the chat gives a short built-in answer with our contact details.

## Domain

In Render → Settings → Custom Domains add `e-trust.online` and `www.e-trust.online`, then point DNS as Render shows.
Sitemap: `https://e-trust.online/sitemap.xml` (submit it in Google Search Console).

## Before going live

- Saad Habib's quote on Home/Projects: get his OK.
- Privacy Policy and Terms: have a lawyer review them.
