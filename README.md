# e-Trust website: Your expert IT solution

The official website of **e-Trust** (https://www.e-trust.online), an IT solutions company in Moghbazar, Dhaka, serving Bangladesh and Sydney.
Laravel 12, hand-written, no template. Every page is a scroll-driven 3D page (Three.js) with its own colour theme and its own 3D scene.

## Pages

| URL | Theme | 3D scene |
| --- | --- | --- |
| `/` | Studio grey | 3D e-Trust "Et" logo that turns, changes colour and zooms as you scroll |
| `/about` | Night navy | Globe with a light arc from Dhaka to Sydney |
| `/services` | Mint | Ring of 7 service objects (browser, phone, shield, AI chip, pen, chart, cloud) |
| `/projects` | Graphite | Laptop that opens and shows each project on its screen |
| `/dorkari` | Deep purple | Ring of the 8 DORKARI product tiles (Bangla + English names) |
| `/team` | Warm sand | Ring of team photos connected by lines |
| `/assistant` | Rose | AI orb with chat bubbles, plus the full-screen free AI chat |
| `/contact` | Black + green | Paper plane flying around a Dhaka location pin, working contact form |

A floating "Ask e-Trust AI" chat button is on every page (except `/assistant`).
Old Bootstrap pages are kept (not routed) in `resources/views/pages`.

## Edit the content

Almost all text lives in **`config/etrust.php`**: contact details, mission, vision, values, services, process, DORKARI products, projects, team, FAQ and AI settings.

- Pages: `resources/views/pages3d/*.blade.php` (each page's 3D poses are at the top of its file)
- Shared layout, navbar, footer, chat: `resources/views/layouts/three.blade.php`, `resources/views/partials3d/`
- Styles and page themes: `public/css/three-site.css`
- 3D engine (all scenes): `public/js/three-site.js` (three.js is self-hosted in `public/js/vendor/three`)
- AI chat: `public/js/chat.js`, `app/Http/Controllers/ChatController.php`, `app/Services/AiAssistant.php`
- Team photos and images: `public/img/`

## Deploy on Render (Docker)

Push to GitHub; Render builds the `Dockerfile`. In **Render > Environment** set:

| Key | Value |
| --- | --- |
| `APP_KEY` | your existing key |
| `APP_ENV` / `APP_DEBUG` | `production` / `false` |
| `APP_URL` | `https://www.e-trust.online` |
| `LOG_CHANNEL` | `stderr` (errors and contact messages show in Render > Logs) |
| `AI_API_KEY` | free Groq key from https://console.groq.com/keys (optional; without it the chat uses built-in answers) |
| `MAIL_MAILER` + `RESEND_KEY` | `resend` + your key (Render's free plan blocks SMTP; Resend works over HTTPS) |
| `MAIL_FROM_ADDRESS` / `CONTACT_TO_ADDRESS` | `info@e-trust.online` |

Contact messages are (1) logged, (2) saved to `storage/app/private/contact-messages.jsonl`, and (3) emailed once mail is configured.

## Run locally

```bash
php artisan serve
```

Open http://127.0.0.1:8000. For local use set `APP_ENV=local` in `.env` (production forces https).
`bootstrap/polyfills.php` adds `mb_split()` for lightweight PHP builds (php.new / Herd Lite).

## AI troubleshooting

Run `php artisan ai:test`. It tries every AI key you set and prints OK or the exact error.

- `HTTP 401` / invalid key: copy the key again (no spaces or quotes), then `php artisan config:clear`.
- `HTTP 429`: free limit used up; wait, or add a second provider (e.g. GEMINI_API_KEY).
- `cURL error 60` (common on Windows): PHP cannot verify SSL. Download https://curl.se/ca/cacert.pem, then in the php.ini shown by `php --ini` add:
  `curl.cainfo="C:\path\to\cacert.pem"` and `openssl.cafile="C:\path\to\cacert.pem"`, then restart `php artisan serve`.
- curl: NO: enable `extension=curl` in php.ini.
