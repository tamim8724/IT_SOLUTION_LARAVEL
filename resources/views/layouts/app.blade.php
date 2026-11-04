<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $fullTitle = !$pageTitle ? 'e-Trust | Web Design & Development Company in Dhaka & Sydney'
            : (str_contains($pageTitle, 'e-Trust') ? $pageTitle : $pageTitle . ' | e-Trust');
        $metaDescription = trim($__env->yieldContent('description')) ?: 'e-Trust is a Dhaka-based IT solutions firm offering web design, web development, UI/UX design, web security, digital marketing and custom programming for businesses of every size.';
    @endphp
    <title>{{ $fullTitle }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="e-Trust, web design company in Dhaka, web development company in Bangladesh, website design Bangladesh, IT company in Dhaka, Laravel developer Bangladesh, e-commerce website Bangladesh, SEO services Dhaka, web design Sydney, web developer Sydney, small business website Sydney, website security">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="BD-13">
    <meta name="geo.placename" content="Dhaka">
    <meta name="author" content="e-Trust">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph (link previews on Facebook, Messenger, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="e-Trust">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/carousel-1.jpg') }}">
    <meta property="og:locale" content="en_US">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="theme-color" content="#1842b6">

    @include('partials.seo-schema')

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
@include('partials.spinner')
@include('partials.topbar')
@include('partials.navbar')

<main>
    @yield('content')
</main>

@include('partials.footer')

<!-- Back to Top -->
<a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top" aria-label="Back to top"><i class="fa fa-arrow-up text-white"></i></a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
