@extends('layouts.app')
@section('title', $service->title)
@section('content')
<section class="section-padding">
    <div class="container">
        <h2>{{ $service->title }}</h2>
        <p>{{ $service->full_desc }}</p>
    </div>
</section>
@endsection
