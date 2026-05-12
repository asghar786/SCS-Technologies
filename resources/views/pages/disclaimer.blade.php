@extends('layouts.app')
@section('title', 'Disclaimer')
@section('content')

@include('partials.page-hero', [
    'title'  => 'Disclaimer',
    'crumbs' => [
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Disclaimer', 'url' => ''],
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
                    <p class="text-muted text-center py-5">Disclaimer content coming soon.</p>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
