@extends('layouts.app')
@section('title', 'Our Services')

@section('content')
@include('partials.page-hero', ['title' => 'Our Services', 'crumbs' => [
    ['label' => 'Home',     'url' => route('home')],
    ['label' => 'Services', 'url' => ''],
]])

<!-- Service Section Start -->
<section class="service-section fix section-padding">
    <div class="container">
        <div class="section-title title-area mx-auto mb-20">
            <div class="subtitle d-flex justify-content-center">
                <img src="{{ asset('assets/img/icon/arrowLeft.svg') }}" alt="icon">
                <span>OUR SERVICES</span>
                <img src="{{ asset('assets/img/icon/arrowRight.svg') }}" alt="icon">
            </div>
            <h2 class="title text-center">We Solve IT &amp; Infrastructure<br>Problems With Technology</h2>
        </div>
        <div class="service-wrapper mb-0">
            <div class="row">
                @foreach($services as $i => $service)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ ($i % 4) * 0.2 + 0.3 }}s">
                    <div class="service-box-items box-shadow">
                        <div class="icon">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                            @else
                                <i class="{{ $service->icon ?? 'fa-solid fa-cogs' }} fa-2x" style="color:var(--theme);"></i>
                            @endif
                        </div>
                        <div class="content">
                            <h4>
                                <a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a>
                            </h4>
                            <p>{{ Str::limit($service->short_desc, 80) }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="theme-btn-2 mt-3">
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
<!-- Service Section End -->
@endsection
