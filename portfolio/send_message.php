<?php
/**
 * send_message.php — AJAX handler for the contact form.
 * Protected: only accepts requests from logged-in users.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/supabase.php';

header('Content-Type: application/json');

// Must be authenticated
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
    exit;
}

// Must be POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// CSRF
if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

// Sanitize & validate
$fullName = trim($_POST['full_name'] ?? '');
$email    = trim($_POST['email']     ?? '');
$phone    = trim($_POST['phone']     ?? '');
$subject  = trim($_POST['subject']   ?? '');
$message  = trim($_POST['message']   ?? '');

if ($fullName === '' || $email === '' || $subject === '' || $message === '') {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}
if (strlen($fullName) > 100 || strlen($subject) > 150 || strlen($message) > 2000) {
    echo json_encode(['success' => false, 'message' => 'One or more fields exceed the maximum length.']);
    exit;
}

// Store in Supabase
$result = supabase()->insert('contact_messages', [
    'full_name' => $fullName,
    'email'     => $email,
    'phone'     => $phone !== '' ? $phone : null,
    'subject'   => $subject,
    'message'   => $message,
], false); // use anon key — policy allows anon INSERT

if ($result['success']) {
    echo json_encode(['success' => true, 'message' => 'Your message has been sent! I\'ll get back to you soon.']);
} else {
    error_log('Supabase insert error: ' . json_encode($result));
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again later.']);
}
