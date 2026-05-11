@extends('layouts.app')
@section('title', $service->title)

@section('content')
@include('partials.page-hero', [
    'title'   => $service->title,
    'bgImage' => $service->banner_image ? asset('storage/' . $service->banner_image) : null,
    'crumbs'  => [
        ['label' => 'Home',          'url' => route('home')],
        ['label' => 'Services',      'url' => route('services.index')],
        ['label' => $service->title, 'url' => ''],
    ],
])

<!-- Service Details Section Start -->
<section class="service-details-section fix section-padding">
    <div class="container">
        <div class="service-details-wrapper">
            <div class="row g-4">

                {{-- ── Sidebar ── --}}
                <div class="col-12 col-lg-4 order-2 order-lg-1">
                    <div class="main-sidebar">

                        {{-- All Services list --}}
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>All Services</h3>
                            </div>
                            <div class="widget-categories">
                                <ul>
                                    @foreach($allServices as $s)
                                    <li class="{{ $s->slug === $service->slug ? 'active' : '' }}">
                                        <a href="{{ route('services.show', $s->slug) }}">
                                            {{ $s->title }}
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Opening Hours --}}
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Business Hours</h3>
                            </div>
                            <div class="opening-category">
                                <ul>
                                    <li><i class="fa-regular fa-clock"></i> Mon – Fri: 8:00 AM – 6:00 PM</li>
                                    <li><i class="fa-regular fa-clock"></i> Saturday: 9:00 AM – 2:00 PM</li>
                                    <li><i class="fa-regular fa-clock"></i> Sunday: Closed</li>
                                    <li><i class="fa-regular fa-clock"></i> Emergency: 24 / 7</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Call Us sidebar --}}
                        <div class="single-sidebar-image bg-cover"
                            style="background-image: url('{{ asset('assets/img/hero/breadcumb.jpg') }}');">
                            <div class="contact-text">
                                <div class="icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <h4>Need Help? Call Here</h4>
                                <h5><a href="{{ $sitePhoneTel }}">{{ $sitePhone }}</a></h5>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ── Main Content ── --}}
                <div class="col-12 col-lg-8 order-1 order-lg-2">
                    <div class="service-details-items">

                        {{-- Hero image --}}
                        @if($service->image)
                        <div class="details-image">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        </div>
                        @endif

                        <div class="details-content">
                            <h3>{{ $service->title }}</h3>

                            @if($service->full_desc)
                                <div class="mt-3">{!! nl2br(e($service->full_desc)) !!}</div>
                            @else
                                <p class="mt-3">{{ $service->short_desc }}</p>
                            @endif

                            {{-- Benefits block --}}
                            <div class="details-video-items mt-4">
                                <div class="content">
                                    <h4>Benefits With Our {{ $service->title }} Service</h4>
                                    <ul class="list mt-3">
                                        <li><i class="fa-regular fa-circle-check"></i> Industry-certified technicians with nationwide coverage</li>
                                        <li><i class="fa-regular fa-circle-check"></i> On-budget and on-time project delivery since 1999</li>
                                        <li><i class="fa-regular fa-circle-check"></i> MBE-Certified minority business enterprise</li>
                                        <li><i class="fa-regular fa-circle-check"></i> 24/7 emergency support available</li>
                                    </ul>
                                </div>
                            </div>

                            {{-- FAQ accordion for this service --}}
                            <h3 class="mt-5">Frequently Asked Questions</h3>
                            <div class="faq-content style-3 mt-3">
                                <div class="faq-accordion">
                                    <div class="accordion" id="serviceAccordion">
                                        @php $faqs = \App\Models\Faq::where('active', true)->orderBy('order')->limit(4)->get(); @endphp
                                        @forelse($faqs as $j => $faq)
                                        <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay="{{ $j * 0.2 + 0.3 }}s">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button {{ $j > 0 ? 'collapsed' : '' }}" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#sfaq{{ $j }}"
                                                    aria-expanded="{{ $j === 0 ? 'true' : 'false' }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </h5>
                                            <div id="sfaq{{ $j }}"
                                                class="accordion-collapse collapse {{ $j === 0 ? 'show' : '' }}"
                                                data-bs-parent="#serviceAccordion">
                                                <div class="accordion-body">{{ $faq->answer }}</div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="accordion-item mb-3">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq0">
                                                    What areas do you serve?
                                                </button>
                                            </h5>
                                            <div id="sfaq0" class="accordion-collapse show" data-bs-parent="#serviceAccordion">
                                                <div class="accordion-body">SCS Technologies provides services nationwide across the United States with offices in Miami, Orlando, San Antonio TX, and Florence SC.</div>
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Service Details Section End -->
@endsection
