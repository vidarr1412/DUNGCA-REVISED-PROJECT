<?php require_once __DIR__ . '/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact – Dungca Portfolio</title>
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
            <!-- <a href="skills.php">Skills</a> -->
            <a href="education.php">Education</a>
            <a href="contact.php" class="active">Contact</a>
            <a href="logout.php" class="logout-btn"><i class='bx bxs-log-out'></i> Logout</a>
        </nav>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class='bx bx-menu'></i>
        </button>
    </header>

    <!-- ── Contact Info Section ── -->
    <section class="contact-page inner-page">
        <div class="text-content">

            <div class="glass-card contact-info-card">
                <h1>Get In Touch!</h1>
                <h3>Contact COFFEE PALDO</h3>
                <p>Have a project in mind or just want to say hi? I'd love to hear from you.</p>

                <div class="contact-info">
                    <div class="info-item">
                        <i class='bx bxs-phone'></i>
                        <div>
                            <span class="info-label">Phone</span>
                            <span>09525503565</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class='bx bxs-envelope'></i>
                        <div>
                            <span class="info-label">Email</span>
                            <span>dungcacarlo285@gmail.com</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class='bx bxs-map'></i>
                        <div>
                            <span class="info-label">Location</span>
                            <span>Brgy. Mat-i, Surigao City, Surigao Del Norte</span>
                        </div>
                    </div>
                </div>

                <div class="home-sci">
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener"><i class='bx bxl-instagram'></i></a>
                </div>
            </div>

        </div>

        <span class="home-imgHover"></span>
    </section>

    <!-- ── Contact Form Section ── -->
    <section class="contact-form-section">
        <h2>Send us a Message.</h2>

        <div id="formMsg" class="form-msg" style="display:none;"></div>

        <form class="contact-form" id="contactForm">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your name" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter email address" required maxlength="150">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Number" maxlength="20">
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="What is this about?" required maxlength="150">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6" placeholder="Tell us more…" required maxlength="2000"></textarea>
            </div>

            <button type="submit" class="submit-btn" id="sendBtn">
                <i class='bx bxs-send'></i> Send Message
            </button>
        </form>
    </section>

    <footer class="site-footer">
        <p>&copy; 2026 COFFEE PALDO. All rights reserved.</p>
    </footer>

    <button id="scrollToTopBtn" class="scroll-top-btn" title="Go to top" aria-label="Scroll to top">
        <i class='bx bx-up-arrow-alt'></i>
    </button>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function () {
            document.querySelector('.navbar').classList.toggle('open');
        });

        // Scroll to top
        const scrollBtn = document.getElementById('scrollToTopBtn');
        window.addEventListener('scroll', function () {
            scrollBtn.style.display = window.scrollY > 300 ? 'flex' : 'none';
        });
        scrollBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // AJAX form submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form    = this;
            const btn     = document.getElementById('sendBtn');
            const msgBox  = document.getElementById('formMsg');
            const data    = new FormData(form);

            btn.disabled = true;
            btn.innerHTML = '<i class=\'bx bx-loader-alt bx-spin\'></i> Sending…';
            msgBox.style.display = 'none';
            msgBox.className = 'form-msg';

            fetch('send_message.php', { method: 'POST', body: data })
                .then(r => r.json())
                .then(res => {
                    msgBox.style.display = 'block';
                    if (res.success) {
                        msgBox.classList.add('form-msg-success');
                        msgBox.textContent = res.message;
                        form.reset();
                    } else {
                        msgBox.classList.add('form-msg-error');
                        msgBox.textContent = res.message || 'Something went wrong.';
                    }
                })
                .catch(() => {
                    msgBox.style.display = 'block';
                    msgBox.classList.add('form-msg-error');
                    msgBox.textContent = 'Network error. Please try again.';
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class=\'bx bxs-send\'></i> Send Message';
                });
        });
    </script>
</body>
</html>
