<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills – Dungca Portfolio</title>
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
            <a href="skills.php" class="active">Skills</a>
            <a href="education.php">Education</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php" class="logout-btn"><i class='bx bxs-log-out'></i> Logout</a>
        </nav>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class='bx bx-menu'></i>
        </button>
    </header>

    <!-- ── Skills Section ── -->
    <section class="skills-page inner-page">
        <div class="text-content scrollable">

            <div class="page-heading">
                <h1>My Skills</h1>
                <span class="heading-line"></span>
            </div>

            <div class="cards-grid">

                <div class="glass-card skill-profile-card">
                    <div class="skill-profile-icon"><i class='bx bxs-pencil'></i></div>
                    <h3>Carlo P. Dungca</h3>
                    <p>Throughout my learning journey, I have developed a strong foundation in both technical and
                    personal skills that allow me to create efficient, creative, and user-friendly projects.
                    I have experience in front-end web development using HTML, CSS, and JavaScript, which enables
                    me to design responsive and visually appealing websites.</p>
                </div>

                <div class="glass-card">
                    <h3>Technical Skills</h3>
                    <ul class="skill-list">
                        <li><i class='bx bx-check-circle'></i> HTML &amp; CSS</li>
                        <li><i class='bx bx-check-circle'></i> JavaScript</li>
                        <li><i class='bx bx-check-circle'></i> PHP &amp; MySQL</li>
                        <li><i class='bx bx-check-circle'></i> Adobe Photoshop</li>
                        <li><i class='bx bx-check-circle'></i> Graphic Design</li>
                        <li><i class='bx bx-check-circle'></i> Digital Art Editing</li>
                    </ul>
                </div>

                <div class="glass-card">
                    <h3>Personal Skills</h3>
                    <ul class="skill-list">
                        <li><i class='bx bx-check-circle'></i> Creativity &amp; Innovation</li>
                        <li><i class='bx bx-check-circle'></i> Attention to Detail</li>
                        <li><i class='bx bx-check-circle'></i> Time Management</li>
                        <li><i class='bx bx-check-circle'></i> Team Collaboration</li>
                        <li><i class='bx bx-check-circle'></i> Problem Solving</li>
                        <li><i class='bx bx-check-circle'></i> Continuous Learning</li>
                    </ul>
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
