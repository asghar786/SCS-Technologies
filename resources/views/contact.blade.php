@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
@include('partials.page-hero', ['title' => 'Contact Us', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Contact Us','url'=>'']]])

    <!-- Contact Section Start -->
    <section class="contact-section fix section-padding">
        <div class="container">
            <div class="contact-wrapper-2">
                <div class="row g-4 align-items-center">

                    <!-- Left: Contact Info + Map Image -->
                    <div class="col-lg-6">
                        <div class="contact-left-items">
                            <div class="contact-info-area-2">

                                <div class="contact-info-items mb-4">
                                    <div class="icon">
                                        <i class="fa-solid fa-phone fa-lg" style="color:#fff;"></i>
                                    </div>
                                    <div class="content">
                                        <p>Call Us 7/24</p>
                                        <h3><a href="tel:+13059065182">+1 (305) 906-5182</a></h3>
                                    </div>
                                </div>

                                <div class="contact-info-items mb-4">
                                    <div class="icon">
                                        <i class="fa-solid fa-envelope fa-lg" style="color:#fff;"></i>
                                    </div>
                                    <div class="content">
                                        <p>Send Us an Email</p>
                                        <h3><a href="mailto:syeds@scs-technologies.com">syeds@scs-technologies.com</a></h3>
                                    </div>
                                </div>

                                <div class="contact-info-items border-none">
                                    <div class="icon">
                                        <i class="fa-solid fa-location-dot fa-lg" style="color:#fff;"></i>
                                    </div>
                                    <div class="content">
                                        <p>Our Location</p>
                                        <h3>10125 NW 116th Way, Medley, Florida 33178</h3>
                                    </div>
                                </div>

                            </div>

                            <div class="video-image mt-4">
                                <img src="{{ asset('assets/img/video.jpg') }}" alt="SCS Technologies Office">
                                <div class="video-box">
                                    <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I"
                                        class="video-btn ripple popup-video">
                                        <i class="fa-solid fa-play"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Contact Form -->
                    <div class="col-lg-6">
                        <div class="contact-content">

                            @if(session('success'))
                                <div class="alert alert-success mb-4 p-3 rounded" style="background:#d1fae5;color:#065f46;border:1px solid #6ee7b7;">
                                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                                </div>
                            @endif

                            <h2>Ready to Get Started?</h2>
                            <p>Tell us about your project and we'll get back to you within one business day.</p>

                            <form method="POST" action="{{ route('contact.store') }}" class="contact-form-items">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                        <div class="form-clt">
                                            <span>Your Name *</span>
                                            <input type="text" name="name" placeholder="Your Name"
                                                value="{{ old('name') }}" required>
                                            @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".4s">
                                        <div class="form-clt">
                                            <span>Your Email *</span>
                                            <input type="email" name="email" placeholder="Your Email"
                                                value="{{ old('email') }}" required>
                                            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="form-clt">
                                            <span>Phone Number</span>
                                            <input type="text" name="phone" placeholder="Phone Number"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay=".6s">
                                        <div class="form-clt">
                                            <span>Service of Interest</span>
                                            <select name="service" class="nice-select wide">
                                                <option value="">Select a Service</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->title }}"
                                                        {{ old('service') == $service->title ? 'selected' : '' }}>
                                                        {{ $service->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 wow fadeInUp" data-wow-delay=".7s">
                                        <div class="form-clt">
                                            <span>Write Message *</span>
                                            <textarea name="message" placeholder="Tell us about your project..." required>{{ old('message') }}</textarea>
                                            @error('message')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-7 wow fadeInUp" data-wow-delay=".9s">
                                        <button type="submit" class="theme-btn">
                                            Send Message <i class="fa-solid fa-arrow-right-long"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Google Map Section -->
    <div class="map-section">
        <div class="map-items">
            <div class="googpemap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3590.7!2d-80.3697!3d25.8731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b8f3f3f3f3f3%3A0x0!2s10125+NW+116th+Way%2C+Medley%2C+FL+33178!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <!-- Map Section End -->

@endsection
