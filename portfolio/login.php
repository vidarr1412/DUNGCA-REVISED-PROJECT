<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/supabase.php';

// Already logged in → go to home
if (!empty($_SESSION['user_id'])) {
    header('Location: dung.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid form submission. Please try again.';
    } else {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $error = 'Please fill in all fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {
            // Fetch user by email (service key)
            $query  = 'email=eq.' . urlencode($email) . '&select=id,username,email,password_hash&limit=1';
            $result = supabase()->select('users', $query);

            if (!$result['success'] || empty($result['data'])) {
                // Generic message to avoid user enumeration
                $error = 'Invalid email or password.';
            } else {
                $user = $result['data'][0];
                if (password_verify($password, $user['password_hash'])) {
                    // Regenerate session ID on login
                    session_regenerate_id(true);
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['username']  = $user['username'];
                    $_SESSION['email']     = $user['email'];
                    $_SESSION['last_regenerated'] = time();
                    header('Location: dung.php');
                    exit;
                } else {
                    $error = 'Invalid email or password.';
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
    <title>Login – Dungca Portfolio</title>
    <link rel="stylesheet" href="auth.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">COFFEE PALDO</div>
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to your account</p>

            <?php if ($error !== ''): ?>
                <div class="alert alert-error">
                    <i class='bx bxs-error-circle'></i>
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

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
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
                            <i class='bx bx-show'></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class='bx bxs-log-in-circle'></i> Login
                </button>
            </form>

            <p class="auth-link">
                Don't have an account? <a href="register.php">Create one</a>
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
