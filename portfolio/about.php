<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me – Dungca Portfolio</title>
    <link rel="stylesheet" href="dungca.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>

    <!-- ── Header ── -->
    <header class="header">
        <a href="dung.php" class="logo">COFFEE PALDO</a>
        <nav class="navbar">
            <a href="dung.php">Home</a>
            <a href="about.php" class="active">About Me</a>
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

    <!-- ── About Section ── -->
    <section class="about-page inner-page">
        <div class="text-content scrollable">

            <div class="page-heading">
                <h1>About Me</h1>
                <span class="heading-line"></span>
            </div>

            <div class="cards-grid">

                <div class="glass-card">
                    <h2>Who I Am</h2>
                    <p>Hello! I'm Carlo Paculba Dungca, an amateur graphic designer with a passion for creating
                    visually stunning and impactful designs. I'm currently honing my skills in graphic design and
                    digital art creation, with a particular focus on Photoshop and digital artwork editing.</p>
                </div>

                <div class="glass-card">
                    <h2>My Journey</h2>
                    <p>I started my journey into graphic design driven by a strong desire to bring creative
                    concepts to life. As someone who is continuously learning and evolving, I'm committed to
                    developing my craft and staying updated with the latest design trends and techniques.</p>
                </div>

                <div class="glass-card">
                    <h2>What Drives Me</h2>
                    <p>I'm passionate about creating designs that not only look beautiful but also communicate
                    messages effectively. I believe in the power of visual communication and strive to make every
                    project I work on meaningful.</p>
                </div>

                <div class="glass-card">
                    <h2>Let's Connect</h2>
                    <p>I'm always excited to work with others and bring creative visions to life. Whether you have
                    a project in mind or just want to connect and discuss design, feel free to reach out on
                    social media or through the contact page.</p>
                </div>

                <div class="glass-card wide-card">
                    <h2>Work Experience</h2>
                    <p>While I may not have formal work experience in the graphic design industry, my dedication
                    to learning and improving my skills has allowed me to create a portfolio of personal projects
                    and freelance work. I have completed various design projects for friends, family, and local
                    businesses, which has given me valuable hands-on experience in understanding client needs,
                    managing deadlines, and delivering high-quality designs.</p>
                    <div class="card-sci">
                        <a href="https://www.facebook.com/carlo.dungca" target="_blank" rel="noopener"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/carlo.dungca" target="_blank" rel="noopener"><i class='bx bxl-instagram'></i></a>
                    </div>
                </div>

            </div>
        </div>

        <span class="home-imgHover"></span>
    </section>

    <!-- Scroll to top -->
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
