<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home – Dungca Portfolio</title>
    <link rel="stylesheet" href="dungca.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

    <!-- ── Header ── -->
    <header class="header">
        <a href="dung.php" class="logo">COFFEE PALDO</a>
        <nav class="navbar">
            <a href="dung.php" class="active">Home</a>
            <a href="about.php">About Me</a>
            <a href="services.php">Services</a>
            <a href="skills.php">Skills</a>
            <a href="education.php">Education</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php" class="logout-btn"><i class='bx bxs-log-out'></i> Logout</a>
        </nav>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class='bx bx-menu'></i>
        </button>
    </header>

    <!-- ── Home Section ── -->
    <section class="home">
        <div class="text-content">
            <div class="home-content">
                <h1>Hi, I'm <span>Carlo P. Dungca</span></h1>
                <h3>Shop Owner &amp; Graphic Designer</h3>
                <p>A shop that sells coffee that you will definitely like.<br>
                   Passionate about design, creativity, and great brews.</p>
                <div class="btn-box">
                    <a href="contact.php">Hire Me!</a>
                    <a href="contact.php" class="btn-outline">Let's Talk!</a>
                </div>
            </div>
        </div>

        <div class="home-sci">
            <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class='bx bxl-facebook'></i></a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener"><i class='bx bxl-instagram'></i></a>
        </div>

        <span class="home-imgHover"></span>
    </section>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function () {
            document.querySelector('.navbar').classList.toggle('open');
        });
    </script>
</body>
</html>
