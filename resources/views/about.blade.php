@extends('layouts.app')
@section('title', 'About Us')
@section('content')
@include('partials.page-hero', ['title' => 'About Us', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'About Us','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>About SCS Technologies</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
