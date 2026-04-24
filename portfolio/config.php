<?php
/**
 * Dungca Portfolio - Supabase Configuration
 *
 * SETUP INSTRUCTIONS:
 * 1. Go to https://supabase.com and create a new project.
 * 2. Replace the values below with your project credentials.
 *    - Project URL:  Settings > API > Project URL
 *    - Anon Key:     Settings > API > anon public key
 *    - Service Key:  Settings > API > service_role key  (keep secret!)
 *
 * 3. Open the Supabase SQL Editor and run the following:
 *
 *    -- Users table (custom auth)
 *    CREATE TABLE users (
 *        id            UUID DEFAULT gen_random_uuid() PRIMARY KEY,
 *        username      TEXT NOT NULL UNIQUE,
 *        email         TEXT NOT NULL UNIQUE,
 *        password_hash TEXT NOT NULL,
 *        created_at    TIMESTAMPTZ DEFAULT NOW()
 *    );
 *
 *    -- Contact messages table
 *    CREATE TABLE contact_messages (
 *        id         UUID DEFAULT gen_random_uuid() PRIMARY KEY,
 *        full_name  TEXT NOT NULL,
 *        email      TEXT NOT NULL,
 *        phone      TEXT,
 *        subject    TEXT NOT NULL,
 *        message    TEXT NOT NULL,
 *        created_at TIMESTAMPTZ DEFAULT NOW()
 *    );
 *
 *    -- Enable Row Level Security
 *    ALTER TABLE users ENABLE ROW LEVEL SECURITY;
 *    ALTER TABLE contact_messages ENABLE ROW LEVEL SECURITY;
 *
 *    -- Allow service_role to read/write users (default, no extra policy needed)
 *    -- Allow anyone to insert contact messages
 *    CREATE POLICY "allow_insert_contact"
 *        ON contact_messages FOR INSERT TO anon WITH CHECK (true);
 *
 * 4. Place your personal photo at:  assets/images/carlo.png
 */

// ── Supabase credentials ──────────────────────────────────────────────────────
define('SUPABASE_URL',         'https://YOUR_PROJECT_REF.supabase.co');
define('SUPABASE_ANON_KEY',    'YOUR_ANON_KEY');
define('SUPABASE_SERVICE_KEY', 'YOUR_SERVICE_ROLE_KEY');

// ── PHP Session hardening ─────────────────────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// ── CSRF token ────────────────────────────────────────────────────────────────
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * Verify a CSRF token submitted with a form.
 */
function verify_csrf(string $token): bool {
    return isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}
