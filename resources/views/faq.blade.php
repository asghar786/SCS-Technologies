@extends('layouts.app')
@section('title', 'FAQ')
@section('content')
@include('partials.page-hero', ['title' => 'FAQ', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'FAQ','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
