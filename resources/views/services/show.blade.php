@extends('layouts.app')
@section('title', $service->title)
@section('content')
@include('partials.page-hero', ['title' => $service->title, 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Services','url'=>route('services.index')],['label'=>$service->title,'url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>{{ $service->title }}</h2>
        <p>{{ $service->full_desc }}</p>
    </div>
</section>
@endsection
