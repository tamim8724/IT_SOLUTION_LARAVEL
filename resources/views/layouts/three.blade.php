<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $pageTitle = html_entity_decode(trim($__env->yieldContent('title')), ENT_QUOTES);
    $fullTitle = !$pageTitle ? 'e-Trust | Web Design & Development Company in Dhaka & Sydney'
        : (str_contains($pageTitle, 'e-Trust') ? $pageTitle : $pageTitle . ' | e-Trust');
    $metaDescription = html_entity_decode(trim($__env->yieldContent('description')), ENT_QUOTES) ?: 'e-Trust is a Dhaka-based IT solutions firm offering web design, web development, UI/UX design, web security, digital marketing and custom programming for businesses in Bangladesh and Sydney.';
    $theme = trim($__env->yieldContent('theme')) ?: 'home';
@endphp
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="e-Trust, web design company in Dhaka, web development company in Bangladesh, website design Bangladesh, IT company in Dhaka, Laravel developer Bangladesh, e-commerce website Bangladesh, SEO services Dhaka, web design Sydney, web developer Sydney, small business website Sydney, website security">
<meta name="robots" content="@yield('robots', 'index, follow')">
<meta name="geo.region" content="BD-13">
<meta name="geo.placename" content="Dhaka">
@unless (str_contains($__env->yieldContent('robots'), 'noindex'))
<link rel="canonical" href="{{ url()->current() }}">
@endunless
<meta property="og:type" content="website">
<meta property="og:site_name" content="e-Trust">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('img/carousel-1.jpg') }}">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
@include('partials.seo-schema')
@stack('head')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/three-site.css') }}?v=5" rel="stylesheet">
<script type="importmap">
{ "imports": {
  "three": "{{ asset('js/vendor/three/three.module.min.js') }}",
  "three/addons/": "{{ asset('js/vendor/three/addons') }}/"
} }
</script>
</head>
<body data-theme="{{ $theme }}">
@include('partials3d.icons')
<a class="skip" href="#main">Skip to content</a>
@include('partials3d.nav')

<canvas id="gl" aria-hidden="true"></canvas>

<main id="main">
    @yield('content')
</main>

@include('partials3d.footer')

@unless (trim($__env->yieldContent('hide_widget')))
    @include('partials3d.chat-widget')
@endunless

<script>
  window.SCENE = @json($scene ?? ['type' => 'logo', 'poses' => [], 'mobile' => []]);
  window.SCENE.assets = {
    shapes: @json(asset('js/data/logo-shapes.json')),
    dots: @json(asset('js/data/land-dots.json')),
    img: @json(asset('img')) + '/'
  };
</script>
<script src="{{ asset('js/site-nav.js') }}?v=4" defer></script>
<script src="{{ asset('js/chat.js') }}?v=4" defer></script>
<script type="module" src="{{ asset('js/three-site.js') }}?v=5"></script>
</body>
</html>
