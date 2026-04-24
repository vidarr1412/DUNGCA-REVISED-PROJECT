<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services – Dungca Portfolio</title>
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
            <a href="services.php" class="active">Services</a>
            <a href="skills.php">Skills</a>
            <a href="education.php">Education</a>
            <a href="contact.php">Contact</a>
            <a href="logout.php" class="logout-btn"><i class='bx bxs-log-out'></i> Logout</a>
        </nav>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class='bx bx-menu'></i>
        </button>
    </header>

    <!-- ── Services Section ── -->
    <section class="services-page inner-page">
        <div class="text-content scrollable">

            <div class="page-heading">
                <h1>My Services</h1>
                <span class="heading-line"></span>
            </div>

            <div class="cards-grid">

                <div class="glass-card service-card">
                    <div class="service-icon"><i class='bx bxs-paint'></i></div>
                    <h3>Graphic Designing</h3>
                    <p>Professional graphic design services including logo creation, branding materials, and
                    visual identity design. I specialize in creating visually stunning designs that effectively
                    communicate your message and brand identity.</p>
                </div>

                <div class="glass-card service-card">
                    <div class="service-icon"><i class='bx bxs-edit'></i></div>
                    <h3>Digital Art Editing</h3>
                    <p>Expert digital artwork editing and enhancement services using industry-standard tools
                    like Adobe Photoshop. I can enhance, retouch, and transform your digital images to create
                    stunning visual content.</p>
                </div>

                <div class="glass-card service-card">
                    <div class="service-icon"><i class='bx bxs-folder-open'></i></div>
                    <h3>Visual Content Creation</h3>
                    <p>Create compelling visual content for social media, websites, and marketing campaigns.
                    From custom illustrations to photo compositions, I deliver high-quality visuals that
                    capture attention and drive engagement.</p>
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
