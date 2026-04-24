# Dungca Portfolio – Setup Guide

## Requirements
- PHP 7.4+ (with `curl` and `openssl` extensions)
- A web server: Apache (XAMPP/WAMP) or Nginx
- A [Supabase](https://supabase.com) account (free tier works)

---

## 1 — Supabase Setup

### Create the database tables

Open your Supabase project → **SQL Editor** → paste and run:

```sql
-- Users table (custom password-based auth)
CREATE TABLE users (
    id            UUID DEFAULT gen_random_uuid() PRIMARY KEY,
    username      TEXT NOT NULL UNIQUE,
    email         TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    created_at    TIMESTAMPTZ DEFAULT NOW()
);

-- Contact messages
CREATE TABLE contact_messages (
    id         UUID DEFAULT gen_random_uuid() PRIMARY KEY,
    full_name  TEXT NOT NULL,
    email      TEXT NOT NULL,
    phone      TEXT,
    subject    TEXT NOT NULL,
    message    TEXT NOT NULL,
    created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Row Level Security
ALTER TABLE users ENABLE ROW LEVEL SECURITY;
ALTER TABLE contact_messages ENABLE ROW LEVEL SECURITY;

-- Allow anonymous inserts to contact_messages (via PHP proxy)
CREATE POLICY "allow_insert_contact"
    ON contact_messages FOR INSERT TO anon WITH CHECK (true);
```

### Get your API credentials

Go to **Settings → API** in your Supabase project:
- **Project URL** → `https://xxxxxx.supabase.co`
- **anon / public key**
- **service_role key** (keep secret – server-side only)

---

## 2 — Configure `config.php`

Open `portfolio/config.php` and replace the placeholders:

```php
define('SUPABASE_URL',         'https://YOUR_PROJECT_REF.supabase.co');
define('SUPABASE_ANON_KEY',    'YOUR_ANON_KEY');
define('SUPABASE_SERVICE_KEY', 'YOUR_SERVICE_ROLE_KEY');
```

---

## 3 — Add the person photo

Place Carlo's photo at:

```
portfolio/assets/images/carlo.png
```

- Use a **PNG with a transparent background** for best results
- Recommended size: ~800 × 900 px, portrait orientation
- The image will appear on the right side of every page

---

## 4 — Deploy / Run locally

### Using XAMPP/WAMP

1. Copy the entire `portfolio/` folder into `htdocs/` (XAMPP) or `www/` (WAMP).
2. Start Apache.
3. Open `http://localhost/portfolio/login.php`.

### Using PHP built-in server (development only)

```bash
cd portfolio
php -S localhost:8000
```

Then open `http://localhost:8000/login.php`.

---

## File Structure

```
portfolio/
├── config.php          ← Supabase credentials (edit this)
├── supabase.php        ← REST API helper
├── auth_check.php      ← Session guard for protected pages
├── login.php           ← Login page
├── register.php        ← Register page
├── logout.php          ← Clears session & redirects
├── dung.php            ← Home (protected)
├── about.php           ← About Me (protected)
├── services.php        ← Services (protected)
├── skills.php          ← Skills (protected)
├── yes.php             ← Alias → skills.php
├── education.php       ← Education (protected)
├── contact.php         ← Contact + info (protected)
├── send_message.php    ← AJAX contact form handler
├── dungca.css          ← Portfolio stylesheet
├── auth.css            ← Login / Register stylesheet
└── assets/
    └── images/
        └── carlo.png   ← ⬅ Place your photo here
```

---

## Usage Flow

1. Visit `/login.php` → Log in or click **Create one** to register.
2. After logging in, you land on the **Home** page.
3. Navigate between pages using the top navbar.
4. The **Contact** page stores messages directly in Supabase.
5. Click **Logout** to end your session.
