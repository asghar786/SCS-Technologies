@extends('layouts.app')
@section('title', 'Blog')
@section('content')
@include('partials.page-hero', ['title' => 'Blog', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Blog','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Blog</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
