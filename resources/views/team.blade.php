@extends('layouts.app')
@section('title', 'Our Team')
@section('content')
@include('partials.page-hero', ['title' => 'Our Team', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Our Team','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Our Team</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
