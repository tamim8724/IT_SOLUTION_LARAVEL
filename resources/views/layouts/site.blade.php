<!DOCTYPE html>
<html lang="en" class="js">
<head>
@php
    $pageTitle = html_entity_decode(trim($__env->yieldContent('title')), ENT_QUOTES);
    $fullTitle = $pageTitle ?: 'Web Design & Development Company in Dhaka & Sydney | e-Trust';
    $metaDescription = html_entity_decode(trim($__env->yieldContent('description')), ENT_QUOTES) ?: 'e-Trust builds custom websites, web apps, AI assistants and secure hosting for businesses in Bangladesh and Sydney, Australia.';
    $canonical = rtrim(config('app.url'), '/') . (request()->path() === '/' ? '/' : '/' . request()->path());
    $pageKey = trim($__env->yieldContent('page'));
    $shareImage = asset('img/share.jpg');
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large')">
<meta name="theme-color" content="#0b1b3a">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="e-Trust">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $shareImage }}">
<meta property="og:image:width" content="1200"><meta property="og:image:height" content="630">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ $shareImage }}">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
<link rel="preload" href="{{ asset('fonts/poppins-400.woff') }}" as="font" type="font/woff" crossorigin>
<link rel="preload" href="{{ asset('fonts/poppins-700.woff') }}" as="font" type="font/woff" crossorigin>
@hasSection('page_css')<link rel="stylesheet" href="{{ asset('css/pages/' . trim($__env->yieldContent('page_css')) . '.css') }}?v={{ config('etrust.asset_version') }}">@endif
<link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ config('etrust.asset_version') }}">
@stack('head')
@include('partials.seo-schema')
</head>
<body class="@yield('body_class')">
@unless (trim($__env->yieldContent('no_nav')))
@include('site.partials.nav', ['page' => $pageKey])
@endunless
@yield('header')
<main id="main">
@yield('content')
</main>
@include('site.partials.footer')
@unless (trim($__env->yieldContent('no_chat')))
<a class="fab" href="{{ url('/assistant') }}" data-open-chat><i aria-hidden="true">💬</i><span>Ask e-Trust AI</span></a>
@endunless
<script src="{{ asset('js/site.js') }}?v={{ config('etrust.asset_version') }}" defer></script>
<script>window.ETRUST_ASSISTANT_URL = @json(url('/assistant'));</script>
<script src="{{ asset('js/chat.js') }}?v={{ config('etrust.asset_version') }}" defer></script>
@stack('scripts')
</body>
</html>
