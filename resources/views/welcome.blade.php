<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1237d7;
            --accent-glow: rgba(18, 55, 215, 0.15);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* NAVBAR - Glassmorphism */
        .navbar {
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* HERO SECTION */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgb(2, 95, 111), rgba(46, 46, 46, 0.9)), 
                        url('storage/img/goldtown3.png') center center / cover no-repeat;
            color: white;
            padding: 100px 0;
            overflow: hidden;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        /* BUTTONS */
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s transform;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px var(--accent-glow);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        /* FEATURE CARDS */
        .feature-box {
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 20px;
            background: #fff;
        }

        .feature-box:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            border-color: var(--primary-color);
        }

        /* ABOUT SECTION */
        .about-section {
            padding: 100px 0;
            background: #f8fafc;
        }

        .section-tag {
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 2px;
            display: block;
            margin-bottom: 10px;
        }

        /* CTA SECTION */
        .cta {
            background: var(--primary-color);
            border-radius: 30px;
            margin: 60px 0;
            padding: 80px 40px;
            position: relative;
            z-index: 1;
        }

        /* DECORATIVE ELEMENTS */
        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--accent-glow);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <span style="color: var(--primary-color);">G</span>oldTown
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#about">About</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item"><a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom ms-lg-3">Dashboard</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-primary btn-custom ms-lg-3">Get Started</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                    <span class="badge bg-light text-primary mb-3 px-3 py-2">v3.0 Now Live</span>
                    <h1 class="hero-title fw-bold">Elevate Your Digital <br><span class="text-info">Experience.</span></h1>
                    <p class="lead mb-5 opacity-75">
                        The most sophisticated Laravel foundation for creators. <br>Minimalist design meets powerful performance.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#about" class="btn btn-primary btn-lg btn-custom">Explore Platform</a>
                        <a href="#" class="btn btn-outline-light btn-lg btn-custom">Watch Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5 mt-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-tag">Core Capabilities</span>
                <h2 class="fw-bold fs-1">Engineered for Excellence</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-5 h-100 feature-box">
                        <div class="mb-4 text-primary fs-1"><i class="bi bi-lightning-charge"></i></div>
                        <h4 class="fw-bold">Fast Execution</h4>
                        <p class="text-muted mb-0">Experience lightning-fast response times optimized for the modern web environment.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-5 h-100 feature-box">
                        <div class="mb-4 text-primary fs-1"><i class="bi bi-phone"></i></div>
                        <h4 class="fw-bold">Fluid Design</h4>
                        <p class="text-muted mb-0">Every pixel is accounted for, ensuring your project looks stunning on any device.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-5 h-100 feature-box">
                        <div class="mb-4 text-primary fs-1"><i class="bi bi-shield-check"></i></div>
                        <h4 class="fw-bold">Enterprise Security</h4>
                        <p class="text-muted mb-0">Built on Laravel's robust security architecture to keep your data safe and sound.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="pe-lg-5">
                        <span class="section-tag">Our Vision</span>
                        <h2 class="fw-bold mb-4 fs-1">Designed by developers, for the visionaries.</h2>
                        <p class="text-muted lead">We believe that technology should be invisible—so seamless that it becomes part of your workflow without friction.</p>
                        <p class="text-muted mb-4">Our platform provides the boilerplate you need to skip the setup and dive straight into what matters: your business logic.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2">✅ Integrated Authentication</li>
                            <li class="mb-2">✅ Dynamic Blade Components</li>
                            <li class="mb-2">✅ Scalable Cloud Architecture</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="zoom-in">
                    <div class="position-relative">
                        <div class="blob"></div>
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow-lg" alt="About us">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container" data-aos="zoom-out">
        <section class="cta text-white text-center">
            <h2 class="fw-bold fs-1">Ready to build your future?</h2>
            <p class="mt-3 opacity-75 mb-4">Join 5,000+ developers building amazing things today.</p>
            <a href="#" class="btn btn-light btn-lg btn-custom text-primary px-5">Get Started Free</a>
        </section>
    </div>

    <footer class="py-5 bg-white border-top">
        <div class="container text-center">
            <a class="navbar-brand fw-bold fs-4 d-block mb-3" href="#">
                <span style="color: var(--primary-color);">G</span>oldTown
            </a>
            <p class="text-muted mb-4">Crafting digital experiences since 2024.</p>
            <div class="d-flex justify-content-center gap-4 mb-4">
                <a href="#" class="text-muted text-decoration-none">Twitter</a>
                <a href="#" class="text-muted text-decoration-none">GitHub</a>
                <a href="#" class="text-muted text-decoration-none">LinkedIn</a>
            </div>
            <small class="text-muted">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Built with ❤️ for the community.
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize Animations
        AOS.init({
            once: true,
            duration: 800
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled', 'shadow-sm');
            } else {
                nav.classList.remove('scrolled', 'shadow-sm');
            }
        });
    </script>

</body>
</html>