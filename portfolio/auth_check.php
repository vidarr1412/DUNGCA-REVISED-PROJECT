<?php
/**
 * auth_check.php
 * Include at the top of every protected page.
 * Redirects to login.php if the user is not authenticated.
 */
require_once __DIR__ . '/config.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Regenerate session ID periodically to prevent fixation
if (empty($_SESSION['last_regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['last_regenerated'] = time();
} elseif (time() - $_SESSION['last_regenerated'] > 900) { // every 15 min
    session_regenerate_id(true);
    $_SESSION['last_regenerated'] = time();
}
