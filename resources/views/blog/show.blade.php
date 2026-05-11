@extends('layouts.app')
@section('title', $post->title)
@section('content')
@include('partials.page-hero', ['title' => $post->title, 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Blog','url'=>route('blog.index')],['label'=>$post->title,'url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <div>{!! $post->body !!}</div>
    </div>
</section>
@endsection
