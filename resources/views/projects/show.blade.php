@extends('layouts.app')
@section('title', $project->title)
@section('content')
<section class="section-padding">
    <div class="container">
        <h2>{{ $project->title }}</h2>
        <p>{{ $project->description }}</p>
    </div>
</section>
@endsection
