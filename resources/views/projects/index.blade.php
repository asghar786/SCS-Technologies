@extends('layouts.app')
@section('title', 'Projects')
@section('content')
@include('partials.page-hero', ['title' => 'Our Projects', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Projects','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Our Projects</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
