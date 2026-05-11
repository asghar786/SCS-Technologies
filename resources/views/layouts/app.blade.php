<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('seo_description', 'SCS Technologies â€” Telecom, IT Infrastructure & Software Solutions. MBE-Certified. Est. 1999.'))">
    <meta name="keywords" content="{{ \App\Models\Setting::get('seo_keywords', '') }}">
    <title>@yield('title', \App\Models\Setting::get('site_name', 'SCS Technologies')) | @yield('meta_title', \App\Models\Setting::get('seo_title', 'Telecom & IT Solutions'))</title>
    @php
        $favicon      = \App\Models\Setting::get('favicon');
        $siteLogo     = \App\Models\Setting::get('logo');
        $logoUrl      = $siteLogo ? asset('storage/' . $siteLogo) : asset('assets/img/logo.svg');
        $siteName     = \App\Models\Setting::get('site_name', 'SCS Technologies');
        $sitePhone    = \App\Models\Setting::get('phone', '+1 (305) 906-5182');
        $sitePhoneTel = preg_replace('/[^\d+]/', '', $sitePhone);
        $siteEmail    = \App\Models\Setting::get('email', 'syeds@scs-technologies.com');
        $siteAddress  = \App\Models\Setting::get('address_miami', '10125 NW 116th Way, Medley, Florida 33178');
        $footerAbout  = \App\Models\Setting::get('footer_about', 'SCS Technologies provides comprehensive telecom, IT infrastructure, security, and software solutions across the United States. MBE-Certified Â· Est. 1999.');
        $fbUrl        = \App\Models\Setting::get('facebook', '#');
        $twUrl        = \App\Models\Setting::get('twitter', '#');
        $ytUrl        = \App\Models\Setting::get('youtube', '#');
        $liUrl        = \App\Models\Setting::get('linkedin', '#');
        $igUrl        = \App\Models\Setting::get('instagram', '#');
    @endphp
    <link rel="shortcut icon" href="{{ $favicon ? asset('storage/' . $favicon) : asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @stack('styles')

    {{-- Google Analytics --}}
    @php $gaId = \App\Models\Setting::get('google_analytics_id'); @endphp
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $gaId }}');
    </script>
    @endif

    {{-- Microsoft Clarity --}}
    @php $clarityId = \App\Models\Setting::get('clarity_id'); @endphp
    @if($clarityId)
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "{{ $clarityId }}");
    </script>
    @endif
</head>
<body>

    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                @foreach(['S','C','S'] as $letter)
                <span data-text-preloader="{{ $letter }}" class="letters-loading">{{ $letter }}</span>
                @endforeach
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-3 loader-section section-left"><div class="bg"></div></div>
                <div class="col-3 loader-section section-right"><div class="bg"></div></div>
                <div class="col-3 loader-section section-right"><div class="bg"></div></div>
            </div>
        </div>
    </div>

    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Offcanvas -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon"><i class="fal fa-map-marker-alt"></i></div>
                                <div class="offcanvas__contact-text">{{ $siteAddress }}</div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15"><i class="fal fa-envelope"></i></div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15"><i class="far fa-phone"></i></div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:{{ $sitePhoneTel }}">{{ $sitePhone }}</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4">
                            <button type="button" class="theme-btn text-center w-100" data-bs-toggle="modal" data-bs-target="#callbackModal">
                                <span>Request for Call <i class="fa-solid fa-phone-volume"></i></span>
                            </button>
                        </div>
                        <div class="social-icon d-flex align-items-center">
                            <a href="{{ $fbUrl }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $twUrl }}"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $ytUrl }}"><i class="fab fa-youtube"></i></a>
                            <a href="{{ $liUrl }}"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header -->
    <header>
        <div class="header-top-section top-style-3">
            <div class="container">
                <div class="header-top-wrapper">
                    <ul class="contact-list">
                        <li>
                            <i class="far fa-envelope"></i>
                            <a href="mailto:{{ $siteEmail }}" class="link">{{ $siteEmail }}</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone-volume"></i>
                            <a href="tel:{{ $sitePhoneTel }}">{{ $sitePhone }}</a>
                        </li>
                    </ul>
                    <div class="top-right">
                        <div class="social-icon d-flex align-items-center">
                            <span>Follow Us:</span>
                            <a href="{{ $fbUrl }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $twUrl }}"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $liUrl }}"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="{{ $ytUrl }}"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-sticky" class="header-3">
            <div class="container">
                <div class="mega-menu-wrapper">
                    <div class="header-main">
                        <div class="header-left">
                            <div class="logo">
                                <a href="{{ route('home') }}" class="header-logo">
                                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                                </a>
                            </div>
                        </div>
                        <div class="header-right d-flex justify-content-end align-items-center">
                            <div class="mean__menu-wrapper">
                                <div class="main-menu">
                                    <nav id="mobile-menu">
                                        <ul>
                                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                                <a href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                                <a href="{{ route('about') }}">About</a>
                                            </li>
                                            <li class="has-dropdown {{ request()->routeIs('services*') ? 'active' : '' }}">
                                                <a href="{{ route('services.index') }}">
                                                    Services <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    @foreach($navServices as $svc)
                                                    <li><a href="{{ route('services.show', $svc->slug) }}">{{ $svc->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="has-dropdown {{ request()->routeIs('projects*') ? 'active' : '' }}">
                                                <a href="{{ route('projects.index') }}">
                                                    Projects <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('projects.index') }}">All Projects</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown {{ request()->routeIs('blog*') ? 'active' : '' }}">
                                                <a href="{{ route('blog.index') }}">
                                                    Blog <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                                </ul>
                                            </li>
                                            <li class="has-dropdown">
                                                <a href="#">Pages <i class="fas fa-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('team') }}">Our Team</a></li>
                                                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                                                </ul>
                                            </li>
                                            <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                                <a href="{{ route('contact') }}">Contact</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <a href="#0" class="search-trigger search-icon"><i class="fal fa-search"></i></a>
                            <div class="header-button">
                                <button type="button" class="theme-btn bg-white" data-bs-toggle="modal" data-bs-target="#callbackModal">
                                    <span>Request for Call <i class="fa-solid fa-phone-volume"></i></span>
                                </button>
                            </div>
                            <div class="header__hamburger d-lg-none my-auto">
                                <div class="sidebar__toggle">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Search -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fas fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get" action="{{ route('blog.index') }}">
                    <div class="search-field-holder">
                        <input type="search" name="q" class="main-search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer-section pt-100 footer-bg">
        <div class="cta-banner-2 footer-cta-banner">
            <div class="container">
                <div class="cta-wrapper-2 border-radius wow fadeInUp" data-wow-delay=".3s">
                    <div class="author-icon">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="content">
                            <span>Our Location</span>
                            <h4>{{ $siteAddress }}</h4>
                        </div>
                    </div>
                    <div class="author-icon">
                        <div class="icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="content">
                            <span>Send Email</span>
                            <h4><a href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a></h4>
                        </div>
                    </div>
                    <div class="author-icon">
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="content">
                            <span>Call Us</span>
                            <h4><a href="{{ $sitePhoneTel }}">{{ $sitePhone }}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-area style1 footer-bg pb-80">
            <div class="container">
                <div class="footer-layout style1">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="widget footer-widget wow fadeInUp" data-wow-delay=".6s">
                                <div class="gt-widget-about">
                                    <div class="about-logo">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}">
                                        </a>
                                    </div>
                                    <p class="about-text">{{ $footerAbout }}</p>
                                    <div class="gt-social style2">
                                        <a href="{{ $fbUrl }}"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{ $twUrl }}"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ $ytUrl }}"><i class="fab fa-youtube"></i></a>
                                        <a href="{{ $liUrl }}"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1s">
                                <h3 class="widget_title">Quick Links</h3>
                                <div class="menu-all-pages-container">
                                    <ul class="menu">
                                        <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevrons-right"></i> About Us</a></li>
                                        <li><a href="{{ route('services.index') }}"><i class="fa-solid fa-chevrons-right"></i> Our Services</a></li>
                                        <li><a href="{{ route('projects.index') }}"><i class="fa-solid fa-chevrons-right"></i> Projects</a></li>
                                        <li><a href="{{ route('blog.index') }}"><i class="fa-solid fa-chevrons-right"></i> Blog</a></li>
                                        <li><a href="{{ route('faq') }}"><i class="fa-solid fa-chevrons-right"></i> FAQ</a></li>
                                        <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevrons-right"></i> Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1.3s">
                                <h3 class="widget_title">Our Services</h3>
                                <div class="menu-all-pages-container">
                                    <ul class="menu">
                                        <li><a href="{{ route('services.show', 'structured-cabling') }}"><i class="fa-solid fa-chevrons-right"></i> Structured Cabling</a></li>
                                        <li><a href="{{ route('services.show', 'wifi-networks') }}"><i class="fa-solid fa-chevrons-right"></i> Wi-Fi Networks</a></li>
                                        <li><a href="{{ route('services.show', 'surveillance-systems') }}"><i class="fa-solid fa-chevrons-right"></i> Surveillance Systems</a></li>
                                        <li><a href="{{ route('services.show', 'access-controls') }}"><i class="fa-solid fa-chevrons-right"></i> Access Controls</a></li>
                                        <li><a href="{{ route('services.show', 'audio-visual-installation') }}"><i class="fa-solid fa-chevrons-right"></i> Audio Visual</a></li>
                                        <li><a href="{{ route('services.show', 'web-development-software') }}"><i class="fa-solid fa-chevrons-right"></i> Web & Software</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1.6s">
                                <h3 class="widget_title">Contact Us</h3>
                                <div class="checklist style2">
                                    <ul class="ps-0">
                                        <li class="text-white"><i class="fa-solid fa-envelope"></i></li>
                                        <li class="text-white"><a href="mailto:{{ $siteEmail }}" class="text-white">{{ $siteEmail }}</a></li>
                                    </ul>
                                    <ul class="ps-0">
                                        <li class="text-white"><i class="fa-solid fa-phone"></i></li>
                                        <li class="text-white"><a href="tel:{{ $sitePhoneTel }}" class="text-white">{{ $sitePhone }}</a></li>
                                    </ul>
                                    <ul class="ps-0 mt-2">
                                        <li class="text-white"><i class="fa-solid fa-location-dot"></i></li>
                                        <li class="text-white">{{ $siteAddress }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap bg-theme">
            <div class="container">
                <div class="copyright-layout">
                    <div class="layout-text wow fadeInUp" data-wow-delay=".3s">
                        <p class="copyright">
                            <i class="fal fa-copyright"></i> {{ date('Y') }} <a href="{{ route('home') }}">SCS Technologies</a>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="layout-link wow fadeInUp" data-wow-delay=".6s">
                        <div class="link-wrapper">
                            <a href="{{ route('contact') }}">Privacy Policy</a>
                            <a href="{{ route('contact') }}">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')

    <!-- Request for Call Modal -->
    <div class="modal fade" id="callbackModal" tabindex="-1" aria-labelledby="callbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px; overflow:hidden; border:none;">
                <div class="modal-header" style="background:#5A95CF; border:none; padding:20px 24px;">
                    <h5 class="modal-title text-white fw-bold" id="callbackModalLabel">
                        <i class="fa-solid fa-phone-volume me-2"></i> Request for Call
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-4">Leave your details and our team will call you back as soon as possible.</p>
                    <div id="callbackSuccess" class="alert alert-success d-none mb-3">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        <span id="callbackSuccessMsg">Thank you! We will call you shortly.</span>
                    </div>
                    <form id="callbackForm" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="callback_name" id="callbackName" class="form-control form-control-lg"
                                   placeholder="Enter your full name" required>
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                            <input type="tel" name="callback_phone" id="callbackPhone" class="form-control form-control-lg"
                                   placeholder="+1 (305) 000-0000" required>
                            <div class="invalid-feedback">Please enter a valid phone number.</div>
                        </div>
                        <button type="submit" class="theme-btn w-100" id="callbackSubmit">
                            Send Request <i class="fa-solid fa-paper-plane ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        var form = document.getElementById('callbackForm');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            var btn = document.getElementById('callbackSubmit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Sending...';

            fetch('{{ route('callback.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    callback_name:  document.getElementById('callbackName').value,
                    callback_phone: document.getElementById('callbackPhone').value,
                }),
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                document.getElementById('callbackSuccessMsg').textContent = data.message || 'Thank you! We will call you shortly.';
                document.getElementById('callbackSuccess').classList.remove('d-none');
                form.classList.add('d-none');
            })
            .catch(function () {
                btn.disabled = false;
                btn.innerHTML = 'Send Request <i class="fa-solid fa-paper-plane ms-1"></i>';
                alert('Something went wrong. Please try again.');
            });
        });

        document.getElementById('callbackModal').addEventListener('hidden.bs.modal', function () {
            form.reset();
            form.classList.remove('was-validated', 'd-none');
            document.getElementById('callbackSuccess').classList.add('d-none');
            var btn = document.getElementById('callbackSubmit');
            btn.disabled = false;
            btn.innerHTML = 'Send Request <i class="fa-solid fa-paper-plane ms-1"></i>';
        });
    })();
    </script>
</body>
</html>
