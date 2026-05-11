@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
@foreach($heroSlides as $i => $slide)
@media (max-width: 767px) {
    .swiper-slide:nth-child({{ $i + 1 }}) .hero-bg-desktop {
        background-image: url('{{ $slide->mobileImageUrl() }}') !important;
        background-position: center center;
    }
}
@endforeach
</style>
@endpush

@section('content')

    <!-- Hero Section Start -->
    <section class="hero-section fix hero-3">
        <div class="bottom-shape">
            <img src="{{ asset('assets/img/hero/bottom-shape.png') }}" alt="shape-img">
        </div>
        <div class="array-button">
            <button class="array-prev"><i class="fal fa-arrow-right"></i></button>
            <button class="array-next"><i class="fal fa-arrow-left"></i></button>
        </div>
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">

                @foreach($heroSlides as $slide)
                <div class="swiper-slide">
                    <div class="slider-image bg-cover hero-bg-desktop" style="background-image: url('{{ $slide->desktopImageUrl() }}');">
                        <div class="mask-shape" data-animation="slideInDown" data-duration="3s" data-delay="2s">
                            <img src="{{ asset('assets/img/hero/mask-shape-2.png') }}" alt="shape-img">
                        </div>
                        <div class="border-shape" data-animation="slideInRight" data-duration="3s" data-delay="2.2s">
                            <img src="{{ asset('assets/img/hero/border-shape.png') }}" alt="shape-img">
                        </div>
                        <div class="circle-shape" data-animation="slideInRight" data-duration="3s" data-delay="2.1s">
                            <img src="{{ asset('assets/img/choose/circle.png') }}" alt="shape-img">
                        </div>
                        <div class="frame" data-animation="slideInLeft" data-duration="3s" data-delay="2.2s">
                            <img src="{{ asset('assets/img/frame.png') }}" alt="shape-img">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-8">
                                <div class="hero-content">
                                    @if($slide->badge)
                                    <h5 data-animation="slideInRight" data-duration="2s" data-delay=".3s">{{ $slide->badge }}</h5>
                                    @endif
                                    <h1 data-animation="slideInRight" data-duration="2s" data-delay=".5s">
                                        {!! nl2br(e($slide->title)) !!}
                                    </h1>
                                    @if($slide->subtitle)
                                    <p data-animation="slideInRight" data-duration="2s" data-delay=".9s">
                                        {{ $slide->subtitle }}
                                    </p>
                                    @endif
                                    <div class="hero-button">
                                        @if($slide->btn1_text)
                                        <a href="{{ $slide->btn1_url ?? '#' }}" data-animation="slideInRight" data-duration="2s"
                                            data-delay=".9s" class="theme-btn hover-white">
                                            {{ $slide->btn1_text }}
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                        @endif
                                        @if($slide->btn2_text)
                                            @if($slide->btn2_url === '#callback')
                                            <button type="button" data-animation="slideInRight" data-duration="2s"
                                                data-delay=".9s" class="theme-btn border-white"
                                                data-bs-toggle="modal" data-bs-target="#callbackModal">
                                                {{ $slide->btn2_text }}
                                                <i class="fa-solid fa-phone-volume"></i>
                                            </button>
                                            @else
                                            <a href="{{ $slide->btn2_url ?? '#' }}" data-animation="slideInRight" data-duration="2s"
                                                data-delay=".9s" class="theme-btn border-white">
                                                {{ $slide->btn2_text }}
                                                <i class="fa-solid fa-phone-volume"></i>
                                            </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section class="about-section section-padding fix bg-cover">
        <div class="container">
            <div class="about-wrapper-2">
                <div class="row">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".4s">
                        <div class="about-image">
                            <div class="shape-image">
                                <img src="{{ asset('assets/img/about/shape.png') }}" alt="shape-img">
                            </div>
                            <div class="circle-shape">
                                <img src="{{ asset('assets/img/about/circle.png') }}" alt="shape-img">
                            </div>
                            <img src="{{ asset('assets/img/about/05.png') }}" alt="SCS Technologies Team">
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="about-content">
                            <div class="section-title mb-3 mxw-650">
                                <div class="subtitle">
                                    <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                                    <span>ABOUT SCS TECHNOLOGIES</span>
                                    <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                                </div>
                                <h2 class="title">A Team of Dedicated Professionals to Meet Your Needs</h2>
                            </div>
                            <p class="wow fadeInUp" data-wow-delay=".5s">
                                SCS Technologies is a privately owned business dedicated to giving you the very best to meet and exceed your telecommunications and infrastructure needs. Consistently ranked among the top integrators in Florida.
                            </p>
                            <div class="icon-area wow fadeInUp" data-wow-delay=".7s">
                                <ul class="list">
                                    <li><i class="fa-solid fa-check"></i> OEM-Certified Multi-State Technicians</li>
                                    <li><i class="fa-solid fa-check"></i> MBE-Certified Minority Business Enterprise</li>
                                    <li><i class="fa-solid fa-check"></i> On Budget & On Time — Every Project</li>
                                </ul>
                                <div class="icon-items">
                                    <div class="icon">
                                        <i class="fa-solid fa-award fa-2x" style="color: var(--theme);"></i>
                                    </div>
                                    <div class="content">
                                        <h2><span class="counter-number">500</span>+</h2>
                                        <span>Completed Projects</span>
                                    </div>
                                </div>
                            </div>
                            <div class="about-author">
                                <div class="about-button wow fadeInUp" data-wow-delay=".8s">
                                    <a href="{{ route('about') }}" class="theme-btn">
                                        Learn More
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                                <div class="author-icon wow fadeInUp" data-wow-delay=".9s">
                                    <div class="icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="content">
                                        <span>Call Us Now</span>
                                        <h5><a href="{{ $sitePhoneTel }}">{{ $sitePhone }}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Service Section Start -->
    <section class="service-section-3 pb-0 fix section-padding bg-cover"
        style="background-image: url('{{ asset('assets/img/service/service-bg-3.jpg') }}');">
        <div class="container">
            <div class="row d-flex align-items-end justify-content-between mb-20">
                <div class="col-xl-7">
                    <div class="section-title mxw-650">
                        <div class="subtitle">
                            <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                            <span>What We Do</span>
                            <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                        </div>
                        <h2 class="title">We Solve IT &amp; Infrastructure Problems with Technology</h2>
                    </div>
                </div>
                <div class="col-xl-5 d-flex align-items-end justify-content-end">
                    <div class="btn-wrapper" data-wow-delay=".9s">
                        <a href="{{ route('services.index') }}" class="theme-btn">
                            See All Services <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="service-card-items">
                        <div class="service-image">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('assets/img/service/02.jpg') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                        <div class="icon-2">
                            <i class="{{ $service->icon }} fa-2x"></i>
                        </div>
                        <div class="service-content">
                            <div class="icon">
                                <i class="{{ $service->icon }} fa-2x"></i>
                            </div>
                            <h4>
                                <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                            </h4>
                            <p>{{ Str::limit($service->short_desc, 90) }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="theme-btn-2 mt-3">
                                Read More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Banner inside service section -->
        <div class="cta-banner-2 section-padding">
            <div class="container">
                <div class="cta-wrapper-2 border-radius">
                    <h3>Stay Connected With<br>Cutting-Edge IT Solutions</h3>
                    <div class="author-icon">
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="content">
                            <span>Call Us Now</span>
                            <h4><a href="{{ $sitePhoneTel }}">{{ $sitePhone }}</a></h4>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="theme-btn bg-white">
                        Get a Quote <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Work Process Section Start -->
    <section class="work-process-section fix section-padding pt-0">
        <div class="container">
            <div class="section-title title-area mx-auto mb-25">
                <div class="subtitle d-flex justify-content-center">
                    <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                    <span>How It Works</span>
                    <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                </div>
                <h2 class="title text-center">Our Proven Project Process</h2>
            </div>
            <div class="process-work-wrapper">
                <div class="line-shape">
                    <img src="{{ asset('assets/img/process/linepng.png') }}" alt="">
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="work-process-items text-center">
                            <div class="icon">
                                <img src="{{ asset('assets/img/process/01.svg') }}" alt="img">
                                <h6 class="number">1</h6>
                            </div>
                            <div class="content">
                                <h4>Choose a Service</h4>
                                <p>Select from our range of telecom, infrastructure, and software services tailored to your industry.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="work-process-items text-center">
                            <div class="content style-2">
                                <h4>Define Requirements</h4>
                                <p>Our engineers work with you to scope the project, assess the site, and define deliverables.</p>
                            </div>
                            <div class="icon">
                                <img src="{{ asset('assets/img/process/02.svg') }}" alt="img">
                                <h6 class="number">2</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="work-process-items text-center">
                            <div class="icon">
                                <img src="{{ asset('assets/img/process/03.svg') }}" alt="img">
                                <h6 class="number">3</h6>
                            </div>
                            <div class="content">
                                <h4>Request a Meeting</h4>
                                <p>Schedule a consultation with our team to review your needs and receive a detailed proposal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="work-process-items text-center">
                            <div class="content style-2">
                                <h4>Project Delivery</h4>
                                <p>We execute with precision — certified technicians, real-time updates, on budget and on time.</p>
                            </div>
                            <div class="icon">
                                <img src="{{ asset('assets/img/process/04.svg') }}" alt="img">
                                <h6 class="number">4</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Work Process Section End -->

    <!-- Achievement / Stats Section Start -->
    <section class="achievement-section-3 fix section-bg-2">
        <div class="shape-image">
            <img src="{{ asset('assets/img/achiv-shape.png') }}" alt="shape-img">
        </div>
        <div class="container">
            <div class="achievement-wrapper style-2">
                <div class="section-title mxw-560">
                    <div class="subtitle text-white wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                        <span class="text-white">Our Achievements</span>
                        <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                    </div>
                    <h2 class="title text-white wow fadeInUp" data-wow-delay=".6s">
                        25+ Years of Business Success
                    </h2>
                </div>
                <div class="counter-area">
                    <div class="counter-items wow fadeInUp" data-wow-delay=".3s">
                        <div class="icon">
                            <img src="{{ asset('assets/img/achievement-icon/01.svg') }}" alt="icon-img">
                        </div>
                        <div class="content">
                            <h2><span class="counter-number">25</span>+</h2>
                            <p>Years in Business</p>
                        </div>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".5s">
                        <div class="icon">
                            <img src="{{ asset('assets/img/achievement-icon/02.svg') }}" alt="icon-img">
                        </div>
                        <div class="content">
                            <h2><span class="counter-number">500</span>+</h2>
                            <p>Completed Projects</p>
                        </div>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".7s">
                        <div class="icon">
                            <img src="{{ asset('assets/img/achievement-icon/03.svg') }}" alt="icon-img">
                        </div>
                        <div class="content">
                            <h2><span class="counter-number">100</span>+</h2>
                            <p>Skilled Professionals</p>
                        </div>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".9s">
                        <div class="icon">
                            <img src="{{ asset('assets/img/achievement-icon/04.svg') }}" alt="icon-img">
                        </div>
                        <div class="content">
                            <h2><span class="counter-number">4</span></h2>
                            <p>States Served</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Achievement Section End -->

    <!-- Marquee Section Start -->
    <div class="marque-section section-padding">
        <div class="container-fluid">
            <div class="marquee-wrapper style-2 text-slider">
                <div class="marquee-inner to-left">
                    <ul class="marqee-list d-flex">
                        <li class="marquee-item style-2">
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Structured Cabling</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Wi-Fi Networks</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Access Controls</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Surveillance</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Audio Visual</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">IT Consulting</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Web Development</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">MBE Certified</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Structured Cabling</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Wi-Fi Networks</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Access Controls</span>
                            <span class="text-slider"><img src="{{ asset('assets/img/asterisk.svg') }}" alt="img"></span><span class="text-slider text-style">Surveillance</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Marquee Section End -->

    <!-- Testimonials Section Start -->
    <section class="tesimonial-section-3 section-padding section-bg-2 bg-cover">
        <div class="line-shape">
            <img src="{{ asset('assets/img/team/line-shape.png') }}" alt="shape-img">
        </div>
        <div class="mask-shape">
            <img src="{{ asset('assets/img/team/mask-shape.png') }}" alt="shape-img">
        </div>
        <div class="array-button">
            <button class="array-prev"><i class="fal fa-arrow-left"></i></button>
            <button class="array-next"><i class="fal fa-arrow-right"></i></button>
        </div>
        <div class="container">
            <div class="section-title title-area mx-auto mb-20">
                <div class="subtitle d-flex justify-content-center">
                    <img src="{{ asset('assets/img/icon/arrowLeftWhite.svg') }}" alt="icon">
                    <span class="text-white">Testimonials</span>
                    <img src="{{ asset('assets/img/icon/arrowRightWhite.svg') }}" alt="icon">
                </div>
                <h2 class="title text-center text-white">What Our Clients Say</h2>
            </div>
            <div class="swiper testimonial-slider-2">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="testimonial-box-items">
                            <div class="icon">
                                <img src="{{ asset('assets/img/testimonial/icon.png') }}" alt="icon-img">
                            </div>
                            <div class="client-items">
                                <div class="client-image style-2 bg-cover"
                                    style="background-image: url('{{ $testimonial->photo ? asset('assets/img/testimonial/' . $testimonial->photo) : asset('assets/img/testimonial/02.jpg') }}');"></div>
                                <div class="client-content">
                                    <h4>{{ $testimonial->client_name }}</h4>
                                    <p>{{ $testimonial->position }}, {{ $testimonial->company }}</p>
                                    <div class="star">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i > $testimonial->rating ? ' color-text' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p>{{ $testimonial->quote }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <div class="testimonial-box-items">
                            <p class="text-white text-center">Testimonials coming soon.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section End -->

    <!-- Blog / News Section Start -->
    @if($latestPosts->isNotEmpty())
    <section class="news-section-3 fix section-padding">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-between mb-20">
                <div class="col-xl-7">
                    <div class="section-title-area">
                        <div class="section-title mxw-650">
                            <div class="subtitle">
                                <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                                <span>Latest Blog</span>
                                <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
                            </div>
                            <h2 class="title">Checkout Our Latest News &amp; Articles</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 d-flex justify-content-end">
                    <div class="btn-wrapper" data-wow-delay=".9s">
                        <a href="{{ route('blog.index') }}" class="theme-btn">
                            All Posts <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper news-slider">
                <div class="swiper-wrapper">
                    @foreach($latestPosts as $post)
                    <div class="swiper-slide">
                        <div class="news-card-items style-2">
                            <div class="news-image">
                                <img src="{{ $post->featured_image ? asset('assets/img/news/' . $post->featured_image) : asset('assets/img/news/04.jpg') }}"
                                    alt="{{ $post->title }}">
                                <div class="post-date">
                                    <h3>
                                        {{ $post->published_at->format('d') }}<br>
                                        <span>{{ $post->published_at->format('M') }}</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="news-content">
                                <ul>
                                    <li>
                                        <i class="fa-regular fa-user"></i>
                                        {{ $post->author ?? 'SCS Technologies' }}
                                    </li>
                                    @if($post->category)
                                    <li>
                                        <i class="fa-regular fa-folder"></i>
                                        {{ $post->category }}
                                    </li>
                                    @endif
                                </ul>
                                <h4><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h4>
                                @if($post->excerpt)
                                <p>{{ Str::limit($post->excerpt, 100) }}</p>
                                @endif
                                <a href="{{ route('blog.show', $post->slug) }}" class="theme-btn-2 mt-3">
                                    Read More <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Blog Section End -->

@endsection
