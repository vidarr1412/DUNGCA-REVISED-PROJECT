<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education – Dungca Portfolio</title>
    <link rel="stylesheet" href="dungca.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

    <!-- ── Header ── -->
    <header class="header">
        <a href="dung.php" class="logo">COFFEE PALDO</a>
        <nav class="navbar">
            <a href="dung.php">Home</a>
            <a href="about.php">About Me</a>
            <a href="services.php">Services</a>
            <a href="skills.php">Skills</a>
            <a href="education.php" class="active">Education</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php" class="logout-btn"><i class='bx bxs-log-out'></i> Logout</a>
        </nav>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class='bx bx-menu'></i>
        </button>
    </header>

    <!-- ── Education Section ── -->
    <section class="education-page inner-page">
        <div class="text-content scrollable">

            <div class="page-heading">
                <h1>My Education</h1>
                <span class="heading-line"></span>
            </div>

            <div class="education-timeline">

                <div class="glass-card edu-card">
                    <div class="edu-step">01</div>
                    <div class="edu-details">
                        <div class="edu-year">2005 – 2006</div>
                        <h3>Kindergarten</h3>
                        <p>I attended kindergarten and developed basic social and academic skills.</p>
                    </div>
                </div>

                <div class="glass-card edu-card">
                    <div class="edu-step">02</div>
                    <div class="edu-details">
                        <div class="edu-year">2006 – 2012</div>
                        <h3>Elementary School</h3>
                        <p>I attended elementary school and continued to develop my academic and social skills.</p>
                    </div>
                </div>

                <div class="glass-card edu-card">
                    <div class="edu-step">03</div>
                    <div class="edu-details">
                        <div class="edu-year">2012 – 2018</div>
                        <h3>High School and Senior High School</h3>
                        <p>I attended high school and senior high school, further developing my academic and social skills.</p>
                    </div>
                </div>

                <div class="glass-card edu-card">
                    <div class="edu-step">04</div>
                    <div class="edu-details">
                        <div class="edu-year">2022 – Present</div>
                        <h3>College</h3>
                        <p>I am currently pursuing a degree in Information Technology and continue to develop my academic skills.</p>
                    </div>
                </div>

            </div>
        </div>

        <span class="home-imgHover"></span>
    </section>

    <button id="scrollToTopBtn" class="scroll-top-btn" title="Go to top" aria-label="Scroll to top">
        <i class='bx bx-up-arrow-alt'></i>
    </button>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function () {
            document.querySelector('.navbar').classList.toggle('open');
        });

        const scrollBtn = document.getElementById('scrollToTopBtn');
        window.addEventListener('scroll', function () {
            scrollBtn.style.display = window.scrollY > 300 ? 'flex' : 'none';
        });
        scrollBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
