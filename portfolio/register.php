<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/supabase.php';

// Already logged in → go to home
if (!empty($_SESSION['user_id'])) {
    header('Location: dung.php');
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid form submission. Please try again.';
    } else {
        $username        = trim($_POST['username']         ?? '');
        $email           = trim($_POST['email']            ?? '');
        $password        = $_POST['password']              ?? '';
        $confirmPassword = $_POST['confirm_password']      ?? '';

        // Validate inputs
        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $error = 'All fields are required.';
        } elseif (strlen($username) < 3 || strlen($username) > 30) {
            $error = 'Username must be between 3 and 30 characters.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $error = 'Username may only contain letters, numbers, and underscores.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters.';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
        } else {
            // Check if email already exists
            $checkEmail = supabase()->select(
                'users',
                'email=eq.' . urlencode($email) . '&select=id&limit=1'
            );
            if (!empty($checkEmail['data'])) {
                $error = 'An account with that email already exists.';
            } else {
                // Check if username already exists
                $checkUser = supabase()->select(
                    'users',
                    'username=eq.' . urlencode($username) . '&select=id&limit=1'
                );
                if (!empty($checkUser['data'])) {
                    $error = 'That username is already taken.';
                } else {
                    // Insert new user
                    $hash   = password_hash($password, PASSWORD_BCRYPT);
                    $result = supabase()->insert('users', [
                        'username'      => $username,
                        'email'         => $email,
                        'password_hash' => $hash,
                    ]);

                    if ($result['success'] && !empty($result['data'])) {
                        $success = 'Account created! You can now <a href="login.php">log in</a>.';
                    } else {
                        $error = 'Registration failed. Please try again later.';
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – Dungca Portfolio</title>
    <link rel="stylesheet" href="auth.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">COFFEE PALDO</div>
            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Join to view the portfolio</p>

            <?php if ($error !== ''): ?>
                <div class="alert alert-error">
                    <i class='bx bxs-error-circle'></i>
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
                <div class="alert alert-success">
                    <i class='bx bxs-check-circle'></i>
                    <?= $success /* safe: only internal value with one safe anchor tag */ ?>
                </div>
            <?php endif; ?>

            <?php if ($success === ''): ?>
            <form method="POST" action="register.php" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="username" name="username" placeholder="Choose a username"
                               value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               maxlength="30" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class='bx bxs-envelope'></i>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                               value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" id="password" name="password"
                               placeholder="At least 8 characters" required minlength="8">
                        <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
                            <i class='bx bx-show'></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-wrapper">
                        <i class='bx bxs-lock'></i>
                        <input type="password" id="confirm_password" name="confirm_password"
                               placeholder="Re-enter your password" required minlength="8">
                        <button type="button" class="toggle-pw" onclick="togglePw('confirm_password', this)" tabindex="-1">
                            <i class='bx bx-show'></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class='bx bxs-user-plus'></i> Create Account
                </button>
            </form>
            <?php endif; ?>

            <p class="auth-link">
                Already have an account? <a href="login.php">Sign in</a>
            </p>
        </div>
    </div>

    <script>
        function togglePw(fieldId, btn) {
            const field = document.getElementById(fieldId);
            const icon  = btn.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'bx bx-hide';
            } else {
                field.type = 'password';
                icon.className = 'bx bx-show';
            }
        }
    </script>
</body>
</html>
