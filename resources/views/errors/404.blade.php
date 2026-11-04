@php
    $scene = [
        'type' => 'logo',
        'poses' => [
            'hero'   => [2.05, -0.55, 0, 0.6, -2.4, 0.5, 1.0, 2, 1],
            'footer' => [2.05, -0.55, 0, 0.6, -2.4, 0.5, 1.0, 2, 1],
        ],
        'mobile' => [
            'hero'   => [0, -1.2, 0, 0.6, -2.4, 0.5, 0.75, 2, 1],
            'footer' => [0, -1.2, 0, 0.6, -2.4, 0.5, 0.75, 2, 1],
        ],
    ];
@endphp
@extends('layouts.three')

@section('title', 'Page Not Found')
@section('robots', 'noindex')
@section('theme', 'home')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">Error 404</p>
        <h1 class="display big" style="max-width:8em">This page took a wrong turn.</h1>
        <p class="lead" style="max-width:24ch">The page you are looking for doesn't exist or has moved.</p>
        <div class="actions">
            <a class="pill" href="{{ url('/') }}">Back to home <span>&rarr;</span></a>
            <a class="ghost" href="{{ url('/contact') }}">Contact us</a>
        </div>
    </div>
</section>
@endsection
