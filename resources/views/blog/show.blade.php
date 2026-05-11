@extends('layouts.app')
@section('title', $post->title)
@section('content')
<section class="section-padding">
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <div>{!! $post->body !!}</div>
    </div>
</section>
@endsection
