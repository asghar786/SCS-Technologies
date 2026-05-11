@extends('layouts.app')
@section('title', 'Services')
@section('content')
@include('partials.page-hero', ['title' => 'Our Services', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Services','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Our Services</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
