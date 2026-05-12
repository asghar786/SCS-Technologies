@extends('layouts.app')
@section('title', 'Insights')
@section('content')
@include('partials.page-hero', ['title' => 'Insights', 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Insights','url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>Insights</h2>
        <p>Page coming soon.</p>
    </div>
</section>
@endsection
