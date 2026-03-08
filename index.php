<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philip Gilbert - Personal Portfolio</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Header/Navigation -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <div class="logo-icon">
                    <img src="mr-design-logo.png" alt="MR Design logo">
                </div>
                <span class="logo-text">MR DESIGN</span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">HOME</a></li>
                <li><a href="#about">ABOUT</a></li>
                <li><a href="#services">SERVICES</a></li>
                <li><a href="#portfolio">PORTFOLIO</a></li>

                <li><a href="#contact">CONTACT</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>



    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">

                <div class="hero-text">
                    <p class="section-subtitle">THIS IS ME</p>

                    <h1 class="hero-title" style="color: black;">
                        Transforming Ideas Into Powerful Digital Solutions
                    </h1>

                    <p class="hero-description" style="color: black;">
                        You will begin to realize why this exercise is called the Modern Pattern with
                        reference to the ghost showing Scrooge some different futures.
                    </p>

                    <div class="hero-actions" style="background: none;">
                        <button class="btn btn-primary">DISCOVER NOW</button>
                        <a class="btn btn-ghost" href="#portfolio">VIEW WORK</a>
                    </div>


                </div>

                <div class="hero-image">
                    <div class="image-frame">
                        <img src="hero-img.png" alt="Philip Gilbert" />
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- About Me Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="about-me-img.png" alt="Philip Gilbert">
                </div>
                <div class="about-text">
                    <h3 class="section-subtitle">ABOUT ME</h3>
                    <h2 class="section-title">PERSONAL DETAILS</h2>
                    <p class="about-description">IHi, I’m Marwan — a senior graphic designer and full-stack developer
                        who believes that great design and clean code should work together.
                        Currently pursuing my HND in IT at SLIIT, I spend my time designing modern visuals, developing
                        web applications, and sharpening my skills to match real industry workflows.

                        I love turning ideas into impactful digital experiences and I’m always eager to learn, build,
                        and grow as a professional in the tech and design industry..</p>
                    <p class="skills-text">
                        <strong>Skills:</strong>
                        Graphic Design • UI/UX Design • Branding • HTML • CSS • JavaScript • PHP • MySQL • Responsive
                        Web Design • Problem Solving
                    </p>

                    <button class="btn btn-secondary" onclick="toggleSkills()">
                        View Full Details
                    </button>

                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">My Offered Services</h2>
                <p class="section-description">It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <i class="fas fa-clock service-icon"></i>
                    <h3>Web Design</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-desktop service-icon"></i>
                    <h3>Web Development</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout.</p>
                </div>


                <div class="service-card">
                    <i class="fas fa-rocket service-icon"></i>
                    <h3>Graphic Design</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page
                        when looking at its layout.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h2 class="stat-number" data-target="2">0</h2>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-item">
                    <h2 class="stat-number" data-target="3">0</h2>
                    <p>Happy Clients</p>
                </div>
                <div class="stat-item">
                    <h2 class="stat-number" data-target="1">0</h2>
                    <p>Years experience</p>
                </div>

            </div>
        </div>
    </section>

    <!-- portfolio section -->

    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Our Latest Featured Projects</h2>
                <p class="section-description">
                    It is a long established fact that a reader will be distracted by the readable content.
                </p>
            </div>

            <!-- Filter Tabs -->
            <div class="portfolio-filters" role="tablist" aria-label="Portfolio filters">
                <button class="filter-btn active" data-filter="all" type="button">ALL</button>
                <?php
                $categories = getCategories();
                if ($categories && $categories->num_rows > 0) {
                    while ($category = $categories->fetch_assoc()) {
                        $category_name = htmlspecialchars($category['name']);
                        $category_slug = htmlspecialchars($category['slug']);
                        echo "<button class=\"filter-btn\" data-filter=\"" . $category_slug . "\" type=\"button\">" . strtoupper($category_name) . "</button>";
                    }
                }
                ?>
            </div>

            <!-- Grid -->
            <div class="portfolio-grid" id="portfolioGrid">
                <?php
                $portfolio_items = getPortfolioItems();
                if ($portfolio_items && $portfolio_items->num_rows > 0) {
                    while ($item = $portfolio_items->fetch_assoc()) {
                        $image_path = htmlspecialchars($item['image_path']);
                        $title = htmlspecialchars($item['title']);
                        $category = htmlspecialchars($item['category']);
                        echo "
                        <article class=\"portfolio-item\" data-category=\"" . $category . "\">
                            <div class=\"portfolio-image\">
                                <img src=\"assets/" . $image_path . "\" alt=\"" . $title . "\" loading=\"lazy\">
                            </div>
                            <div class=\"portfolio-info\">
                                <h3>" . $title . "</h3>
                                <p>" . ucfirst($category) . "</p>
                            </div>
                        </article>
                        ";
                    }
                } else {
                    echo '<p style="text-align: center; padding: 40px; color: #666;">No portfolio items yet. <a href="admin/index.php">Go to admin panel</a> to add images.</p>';
                }
                ?>
            </div>
        </div>




    </section>

    <!-- Image Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-overlay"></div>

        <div class="lightbox-content" role="dialog" aria-modal="true">
            <button class="lightbox-close" aria-label="Close">&times;</button>

            <button class="lightbox-nav prev" aria-label="Previous image">&#10094;</button>

            <img id="lightboxImage" src="" alt="Full view">

            <button class="lightbox-nav next" aria-label="Next image">&#10095;</button>

            <div class="lightbox-counter" id="lightboxCounter">1 / 6</div>
        </div>
    </div>


    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Client's Feedback About Me</h2>
                <p class="section-description">It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout.</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p class="testimonial-text">"It is a long established fact that a reader will be distracted by
                            the readable content of a page when looking at its layout."</p>
                        <div class="testimonial-author">
                            <img src="CL.jpg" alt="Carolyn Craig">
                            <div>
                                <h4>Carolyn Craig</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p class="testimonial-text">"It is a long established fact that a reader will be distracted by
                            the readable content of a page when looking at its layout."</p>
                        <div class="testimonial-author">
                            <img src="CLII.jpg" alt="Harriet Maxwell">
                            <div>
                                <h4>Harriet Maxwell</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Blog Section -->
    <section id="blog" class="blog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Latest Posts From Our Blog</h2>
                <p class="section-description">It is a long established fact that a reader will be distracted by the
                    readable content of a page when looking at its layout.</p>
            </div>
            <div class="blog-grid">
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/1a1a2e/FFFFFF?text=Cityscape" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-user"></i> Mark Ware</span>
                            <span><i class="far fa-calendar"></i> Jan 2020</span>
                            <span><i class="far fa-comment"></i> 10</span>
                            <span><i class="far fa-heart"></i> 12</span>
                        </div>
                        <h3>BREAK THROUGH SELF DOUBT AND FEAR</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout.</p>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/16213e/FFFFFF?text=Fashion" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-user"></i> Mark Ware</span>
                            <span><i class="far fa-calendar"></i> Jan 2020</span>
                            <span><i class="far fa-comment"></i> 10</span>
                            <span><i class="far fa-heart"></i> 12</span>
                        </div>
                        <h3>PORTABLE FASHION FOR YOUNG WOMEN</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout.</p>
                    </div>
                </div>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/0f3460/FFFFFF?text=Coastal" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-user"></i> Mark Ware</span>
                            <span><i class="far fa-calendar"></i> Jan 2020</span>
                            <span><i class="far fa-comment"></i> 10</span>
                            <span><i class="far fa-heart"></i> 12</span>
                        </div>
                        <h3>DO DREAMS SERVE AS A PREMONITION</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands">
        <div class="container">
            <div class="brands-grid">
                <div class="brand-logo">CREATIVE</div>
                <div class="brand-logo">PREMIUM LABELS</div>
                <div class="brand-logo">PREMIUM</div>
                <div class="brand-logo">DESIGN</div>
                <div class="brand-logo">STUDIO</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <!-- Contact Hero -->
        <div class="contact-hero">
            <div class="container">
                <h1 class="contact-hero-title">Get in touch</h1>
                <nav class="breadcrumb">
                    <a href="#home">Home</a>
                    <span class="breadcrumb-separator">→</span>
                    <span class="breadcrumb-current">Contact Us</span>
                </nav>
            </div>
        </div>



        <!-- Contact Content -->
        <div class="contact-content">
            <div class="container">
                <div class="contact-wrapper">
                    <!-- Contact Information -->
                    <div class="contact-info">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Location</h3>
                                <p>Srilanka, Ampare</p>
                                <p>627a,orabibhasha road sainthemaruthu - 02</p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Phone</h3>
                                <p>94 787 916 014</p>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <p>muhammedmarwan@gmail.com</p>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-wrapper">
                        <form class="contact-form" id="contactForm" method="post"
                            action="https://formspree.io/f/xvzzgdnb">
                            <div class="form-group">
                                <input type="text" id="name" name="name" placeholder="Enter your name" required
                                    class="form-input">
                                <span class="form-error" id="nameError"></span>
                            </div>

                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Enter email address" required
                                    class="form-input">
                                <span class="form-error" id="emailError"></span>
                            </div>

                            <div class="form-group">
                                <input type="text" id="subject" name="subject" placeholder="Enter subject" required
                                    class="form-input">
                                <span class="form-error" id="subjectError"></span>
                            </div>

                            <div class="form-group">
                                <textarea id="message" name="message" rows="5" placeholder="Enter Message" required
                                    class="form-input form-textarea"></textarea>
                                <span class="form-error" id="messageError"></span>
                            </div>

                            <button type="submit" class="btn btn-contact-submit">
                                <span>SEND MESSAGE</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>

                            <div class="form-success" id="formSuccess" style="display: none;">
                                <i class="fas fa-check-circle"></i>
                                <p>Thank you! Your message has been sent successfully.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-column">
                        <h4>About Me</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Newsletter</h4>
                        <p>Subscribe to our newsletter</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Enter email address">
                            <button type="submit"><i class="fas fa-arrow-right"></i></button>
                        </form>
                    </div>
                    <div class="footer-column">
                        <h4>Follow Me</h4>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>Copyright © 2020 All rights reserved | This template is made with by Colorlib</p>
                    <ul class="footer-nav">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>