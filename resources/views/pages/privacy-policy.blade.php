@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')

@include('partials.page-hero', [
    'title'  => 'Privacy Policy',
    'crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Privacy Policy', 'url' => ''],
    ]
])

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                @if($content)
                    <div class="legal-content">
                        {!! $content !!}
                    </div>
                @else
                    <p class="text-muted text-center py-5">Privacy policy content coming soon.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
