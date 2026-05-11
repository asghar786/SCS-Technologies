@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<section class="section-padding">
    <div class="container">
        <h2>Contact Us</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required>
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
            </div>
            <div class="mb-3">
                <select name="service" class="form-control">
                    <option value="">Select a Service (optional)</option>
                    @foreach($services as $service)
                        <option value="{{ $service->title }}" {{ old('service') == $service->title ? 'selected' : '' }}>
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required>{{ old('message') }}</textarea>
                @error('message')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="theme-btn">Send Message <i class="fa-solid fa-arrow-right-long"></i></button>
        </form>
    </div>
</section>
@endsection
