@extends('layouts.app')
@section('title', $project->title)
@section('content')
@include('partials.page-hero', ['title' => $project->title, 'crumbs' => [['label'=>'Home','url'=>route('home')],['label'=>'Projects','url'=>route('projects.index')],['label'=>$project->title,'url'=>'']]])
<section class="section-padding">
    <div class="container">
        <h2>{{ $project->title }}</h2>
        <p>{{ $project->description }}</p>
    </div>
</section>
@endsection
