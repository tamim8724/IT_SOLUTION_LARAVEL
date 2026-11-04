{{-- 3D homepage (scroll-driven). The previous Bootstrap homepage is kept in pages/home.blade.php but no longer routed. --}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@php
    $fullTitle = 'Web Design & Development Company in Dhaka & Sydney | e-Trust';
    $metaDescription = 'e-Trust is a web design and development company in Dhaka, Bangladesh, also serving Sydney, Australia. Business websites, e-commerce, Laravel web apps, SEO and web security.';
@endphp
<title>{{ $fullTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="e-Trust, web design company in Dhaka, web development company in Bangladesh, website design Bangladesh, IT company in Dhaka, Laravel developer Bangladesh, e-commerce website Bangladesh, SEO services Dhaka, web design Sydney, web developer Sydney, small business website Sydney, website security">
<meta name="robots" content="index, follow">
<meta name="geo.region" content="BD-13">
<meta name="geo.placename" content="Dhaka">
<link rel="canonical" href="{{ url('/') }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="e-Trust">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ url('/') }}">
<meta property="og:image" content="{{ asset('img/carousel-1.jpg') }}">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary_large_image">
<meta name="theme-color" content="#050608">
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
@include('partials.seo-schema')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;600&display=swap" rel="stylesheet">
@verbatim
<style>
:root {
  /* Layout idea: one pinned 3D logo on a soft studio-grey stage; text panels scroll over it and drive its pose, like a product reveal. */
  --stage: #e6e7ea;
  --ink: #0c0e13;
  --muted: #8b909a;
  --g: #2bcf8f;
  --b: #0d43b0;
  --navy: #0b1f5c;
  --night: #050608;
  --display: "Anton", "Oswald", Impact, "Arial Narrow", sans-serif;
  --body: "Archivo", "Helvetica Neue", Arial, sans-serif;
  color-scheme: light;
}
* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body { margin: 0; background: var(--stage); color: var(--ink); font-family: var(--body); -webkit-font-smoothing: antialiased; }
a { color: inherit; }
#gl { position: fixed; inset: 0; width: 100%; height: 100%; z-index: 0; display: block; }
main, footer { position: relative; z-index: 1; }

/* top-right brand badge, like the video's logo chip */
.badge { display: flex; align-items: center; gap: 10px; padding: 8px 14px 8px 10px; background: var(--night); color: #fff; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 15px; letter-spacing: .01em; }
.badge svg { width: 26px; height: 26px; }
.badge b { color: var(--g); font-weight: 600; }

section { position: relative; padding: 0 clamp(16px, 5vw, 72px); }
.story { min-height: 100svh; display: flex; flex-direction: column; }
.wrap { width: 100%; max-width: 1180px; margin: 0 auto; }

/* stripe accent: green / blue / navy, slanted like the M stripes */
.stripe { height: 7px; width: min(520px, 70%); background: linear-gradient(90deg, var(--g) 0 33%, var(--b) 33% 66%, var(--navy) 66%); transform: skewX(-30deg); transform-origin: left; }
.label { display: flex; flex-direction: column; gap: 10px; font-size: 15px; font-weight: 500; max-width: 420px; }
.label::before { content: ""; height: 2px; background: currentColor; }

.display { font-family: var(--display); font-weight: 400; text-transform: uppercase; line-height: .92; letter-spacing: -.005em; margin: 0; text-wrap: balance; }

.pill { display: inline-flex; align-items: center; gap: 18px; padding: 8px 8px 8px 22px; border-radius: 999px; background: var(--ink); color: #fff; text-decoration: none; font-size: 16px; font-weight: 500; transition: transform .25s ease, background .25s ease; }
.pill span { width: 38px; height: 38px; border-radius: 50%; background: #fff; color: var(--ink); display: grid; place-items: center; font-size: 19px; transition: transform .25s ease; }
.pill:hover { transform: translateY(-2px); }
.pill:hover span { transform: translateX(3px); }
.pill:focus-visible, .badge:focus-visible, .footer a:focus-visible { outline: 3px solid var(--g); outline-offset: 3px; }
.dark .pill { background: #f2f3f5; color: var(--ink); }
.dark .pill span { background: var(--ink); color: #fff; }

/* 1 hero */
.hero { padding-top: clamp(90px, 14vh, 150px); padding-bottom: 28px; }
.hero h1 { font-size: clamp(54px, 9.4vw, 140px); max-width: 9.5em; }
.hero .pill { margin-top: 28px; align-self: flex-start; }
.signoff { margin-top: auto; display: flex; flex-direction: column; gap: 12px; }
.roundel { width: 58px; height: 58px; border-radius: 50%; background: #fff; display: grid; place-items: center; box-shadow: 0 0 0 4px var(--ink); }
.roundel svg { width: 34px; height: 34px; }
.signoff p { margin: 0; font-family: var(--display); text-transform: uppercase; font-size: 17px; line-height: 1.05; letter-spacing: .02em; }

/* 2 intro */
.intro { justify-content: flex-end; padding-bottom: 12vh; }
.lead { font-size: clamp(22px, 2.6vw, 34px); line-height: 1.22; font-weight: 500; max-width: 26ch; margin: 28px 0 0; text-wrap: pretty; }

/* 3 work */
.work { padding-top: 12vh; padding-bottom: 12vh; }
.work-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 28px; }
.work-grid figure { margin: 0; }
.work-grid img { width: 100%; height: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; border-radius: 4px; }
.work-grid figcaption { font-size: 14px; color: var(--muted); margin-top: 8px; }
.work-note { margin-top: 28px; font-size: clamp(20px, 2.2vw, 28px); line-height: 1.25; font-weight: 500; max-width: 30ch; }
.work-note a { text-decoration-thickness: 2px; text-underline-offset: 4px; }

/* 4 services, styled like the model-year list */
.services { padding-top: 10vh; padding-bottom: 16vh; }
.svc { list-style: none; margin: 34px 0 0; padding: 0; display: grid; gap: 30px; max-width: 560px; }
.svc li { display: grid; grid-template-columns: auto 1fr; column-gap: 18px; align-items: baseline; }
.svc .n { font-family: var(--display); font-size: clamp(40px, 5vw, 62px); line-height: 1; font-variant-numeric: tabular-nums; }
.svc h3 { margin: 0; font-size: clamp(24px, 2.6vw, 32px); font-weight: 500; }
.svc p { grid-column: 2; margin: 6px 0 0; color: var(--muted); font-size: 15px; line-height: 1.45; max-width: 44ch; }

/* 5 stats */
.stats { padding-top: 14vh; }
.stat-row { display: flex; flex-wrap: wrap; gap: 28px 44px; }
.stat { border-left: 2px solid var(--ink); padding-left: 12px; }
.stat strong { font-size: clamp(48px, 6vw, 80px); font-weight: 500; line-height: 1; letter-spacing: -.02em; font-variant-numeric: tabular-nums; }
.stat strong small { font-size: .38em; font-weight: 600; margin-left: 2px; }
.stat span { display: block; font-size: 15px; margin-top: 4px; }

/* 6 close-up */
.close { align-items: flex-end; padding-top: 14vh; }
.close .box { max-width: 420px; border-left: 2px solid var(--ink); padding-left: 16px; font-size: clamp(19px, 1.8vw, 23px); line-height: 1.3; font-weight: 500; }

/* 7 mission (opaque black, covers the stage) */
.dark { background: var(--night); color: #f2f3f5; }
.mission { padding-top: 12vh; padding-bottom: 14vh; }
.mission .lead { max-width: 28ch; margin: 18vh 0 34px; }

/* 8 promise */
.promise { padding-top: 12vh; padding-bottom: 14vh; }
.promise h2 { font-size: clamp(22px, 2.4vw, 30px); font-weight: 500; color: #a9adb5; margin: 26px 0 40px; }
.quote-mark { font-family: var(--display); font-size: 120px; line-height: .6; color: #c9ccd2; }
.promise blockquote { margin: 18px 0 0; font-size: clamp(22px, 2.6vw, 34px); line-height: 1.25; font-weight: 500; max-width: 30ch; }
.promise cite { display: block; font-style: normal; color: var(--muted); font-size: 15px; margin-top: 18px; }
.who { display: flex; align-items: center; gap: 14px; margin-top: 24px; font-size: 15px; }
.who i { width: 54px; height: 54px; border-radius: 50%; background: linear-gradient(180deg, var(--g) 50%, var(--b) 50%); display: block; }

/* 9 closing */
.cta { padding-top: clamp(90px, 14vh, 150px); padding-bottom: 28px; }
.cta h2 { font-size: clamp(54px, 9.4vw, 140px); max-width: 8em; }
.cta .pill { margin-top: 28px; align-self: flex-start; }
.cta small { display: block; margin-top: 12px; color: var(--muted); font-size: 14px; }

/* footer */
.footer { padding: 40px clamp(16px, 5vw, 72px) 34px; }
.footer .label { color: #fff; max-width: 100%; }
.footer h2 { font-size: clamp(36px, 4.6vw, 58px); font-weight: 500; line-height: 1.02; margin: 28px 0 22px; letter-spacing: -.01em; }
.foot-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 32px; }
.foot-grid a, .foot-grid p { display: block; margin: 0 0 8px; font-size: clamp(19px, 1.8vw, 23px); text-decoration: none; }
.foot-grid .sub { font-size: 16px; color: #b9bcc3; }
.footer .fine { margin-top: 44px; font-size: 12px; color: #80848d; max-width: 60ch; }

.no-gl .fallback { display: block; }
.fallback { display: none; position: fixed; right: 6vw; bottom: 14vh; width: min(38vw, 360px); z-index: 0; opacity: .95; }

@media (max-width: 760px) {
  .badge { font-size: 13px; }
  .hero h1, .cta h2 { font-size: clamp(46px, 13.5vw, 72px); }
  .work-grid { grid-template-columns: 1fr; }
  .stat-row { gap: 22px 28px; }
  .close { align-items: flex-start; }
  .foot-grid { grid-template-columns: 1fr; gap: 18px; }
  .mission .lead { margin-top: 10vh; }
  .fallback { right: 50%; transform: translateX(50%); width: 64vw; bottom: 8vh; }
}
@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  .pill, .pill span { transition: none; }
}
/* top-right controls: menu button + brand badge */
.topbar { position: fixed; top: 16px; right: 16px; z-index: 6; display: flex; gap: 6px; }
.badge { position: static; }
.menu-btn { display: inline-flex; align-items: center; gap: 8px; padding: 0 14px; height: 42px; border: 0; border-radius: 6px; background: var(--night); color: #fff; font: 600 15px var(--body); cursor: pointer; }
.menu-btn i { width: 16px; height: 2px; background: currentColor; position: relative; display: block; }
.menu-btn i::before, .menu-btn i::after { content: ""; position: absolute; left: 0; width: 16px; height: 2px; background: currentColor; }
.menu-btn i::before { top: -5px; } .menu-btn i::after { top: 5px; }
.menu-btn:focus-visible, .menu a:focus-visible { outline: 3px solid var(--g); outline-offset: 3px; }
.menu { position: fixed; top: 66px; right: 16px; z-index: 6; background: var(--night); color: #fff; border-radius: 8px; padding: 18px 22px; min-width: 220px; display: grid; gap: 4px; box-shadow: 0 18px 50px rgba(0,0,0,.25); }
.menu[hidden] { display: none; }
.menu a { text-decoration: none; font-size: 22px; padding: 4px 0; }
.menu a:hover { color: var(--g); }
.eyebrow { font-size: 15px; font-weight: 600; letter-spacing: .02em; margin: 0 0 16px; color: var(--b); }
.badge { height: 42px; }
@media (max-width: 760px) { .topbar { top: 12px; right: 12px; } .menu { top: 60px; right: 12px; } .menu-btn span { display: none; } }
</style>
@endverbatim
<script type="importmap">
{ "imports": {
  "three": "{{ asset('js/vendor/three/three.module.min.js') }}",
  "three/addons/": "{{ asset('js/vendor/three/addons') }}/"
} }
</script>
</head>
<body>

<div class="topbar">
  <button class="menu-btn" type="button" id="menu-btn" aria-expanded="false" aria-controls="site-menu"><i aria-hidden="true"></i><span>Menu</span></button>
  <a class="badge" href="#top" aria-label="e-trust.online, back to top"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="var(--g)" d="M46.4 33.4 L45.2 33.2 L29.3 42.7 L27.6 44.2 L26.8 45.9 L26.8 59.5 L27.6 60.3 L29.0 60.5 L46.7 49.3 L47.0 34.1Z"/><path fill="var(--g)" d="M44.7 3.3 L11.2 23.3 L8.1 26.2 L7.3 28.9 L7.3 67.9 L8.3 71.0 L10.3 72.9 L42.1 91.1 L45.2 92.1 L46.3 91.1 L46.0 76.9 L24.4 63.8 L23.1 61.7 L23.4 34.3 L26.1 31.6 L45.6 19.5 L46.3 18.0 L46.3 4.2 L45.5 3.3Z"/><path fill="var(--b)" d="M51.2 4.4 L50.9 88.5 L51.8 91.0 L52.9 92.3 L59.4 96.2 L62.8 96.7 L65.3 95.9 L91.4 80.4 L92.6 77.7 L92.7 64.6 L91.6 64.9 L69.2 78.4 L68.4 77.7 L68.4 50.5 L69.5 49.7 L81.8 49.7 L83.9 48.6 L85.4 46.1 L85.4 35.1 L84.6 34.0 L69.6 34.0 L68.7 33.4 L68.3 32.6 L68.2 17.2 L67.8 15.5Z"/></svg><span>e-trust<b>.</b>online</span></a>
</div>
<nav class="menu" id="site-menu" aria-label="Main" hidden>
  <a href="{{ url('/') }}">Home</a>
  <a href="{{ url('/about') }}">About</a>
  <a href="{{ url('/services') }}">Services</a>
  <a href="{{ url('/projects') }}">Projects</a>
  <a href="{{ url('/team') }}">Team</a>
  <a href="{{ url('/contact') }}">Contact</a>
</nav>
<canvas id="gl" aria-hidden="true"></canvas>
<div class="fallback" aria-hidden="true"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="var(--g)" d="M46.4 33.4 L45.2 33.2 L29.3 42.7 L27.6 44.2 L26.8 45.9 L26.8 59.5 L27.6 60.3 L29.0 60.5 L46.7 49.3 L47.0 34.1Z"/><path fill="var(--g)" d="M44.7 3.3 L11.2 23.3 L8.1 26.2 L7.3 28.9 L7.3 67.9 L8.3 71.0 L10.3 72.9 L42.1 91.1 L45.2 92.1 L46.3 91.1 L46.0 76.9 L24.4 63.8 L23.1 61.7 L23.4 34.3 L26.1 31.6 L45.6 19.5 L46.3 18.0 L46.3 4.2 L45.5 3.3Z"/><path fill="var(--b)" d="M51.2 4.4 L50.9 88.5 L51.8 91.0 L52.9 92.3 L59.4 96.2 L62.8 96.7 L65.3 95.9 L91.4 80.4 L92.6 77.7 L92.7 64.6 L91.6 64.9 L69.2 78.4 L68.4 77.7 L68.4 50.5 L69.5 49.7 L81.8 49.7 L83.9 48.6 L85.4 46.1 L85.4 35.1 L84.6 34.0 L69.6 34.0 L68.7 33.4 L68.3 32.6 L68.2 17.2 L67.8 15.5Z"/></svg></div>

<main id="top">
  <section class="story hero" data-k="hero">
    <div class="wrap" style="display:flex;flex-direction:column;flex:1">
      <p class="eyebrow">Web design &amp; development &middot; Dhaka &amp; Sydney</p>
      <h1 class="display">We build websites you can trust.</h1>
      <a class="pill" href="#intro">Learn More <span>&rarr;</span></a>
      <div class="signoff">
        <div class="roundel"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="var(--g)" d="M46.4 33.4 L45.2 33.2 L29.3 42.7 L27.6 44.2 L26.8 45.9 L26.8 59.5 L27.6 60.3 L29.0 60.5 L46.7 49.3 L47.0 34.1Z"/><path fill="var(--g)" d="M44.7 3.3 L11.2 23.3 L8.1 26.2 L7.3 28.9 L7.3 67.9 L8.3 71.0 L10.3 72.9 L42.1 91.1 L45.2 92.1 L46.3 91.1 L46.0 76.9 L24.4 63.8 L23.1 61.7 L23.4 34.3 L26.1 31.6 L45.6 19.5 L46.3 18.0 L46.3 4.2 L45.5 3.3Z"/><path fill="var(--b)" d="M51.2 4.4 L50.9 88.5 L51.8 91.0 L52.9 92.3 L59.4 96.2 L62.8 96.7 L65.3 95.9 L91.4 80.4 L92.6 77.7 L92.7 64.6 L91.6 64.9 L69.2 78.4 L68.4 77.7 L68.4 50.5 L69.5 49.7 L81.8 49.7 L83.9 48.6 L85.4 46.1 L85.4 35.1 L84.6 34.0 L69.6 34.0 L68.7 33.4 L68.3 32.6 L68.2 17.2 L67.8 15.5Z"/></svg></div>
        <p>e-Trust IT solutions.<br>Dhaka &middot; Sydney.</p>
      </div>
    </div>
  </section>

  <section class="story intro" id="intro" data-k="intro">
    <div class="wrap">
      <div class="stripe"></div>
      <div class="label" style="margin-top:22px">Introduction</div>
      <p class="lead">e-Trust is an IT solutions firm from Dhaka, founded by Md Muktadir Anik and Tamim Ahmed. We design and build websites, web apps and digital projects that are fast, safe and easy to use, for businesses in Bangladesh and Sydney.</p>
    </div>
  </section>

  <section class="work" data-k="work">
    <div class="wrap">
      <div class="label">Selected Work</div>
      <div class="work-grid">
        <figure><img src="{{ asset('img/project-1.jpg') }}" loading="lazy" width="550" height="450" alt="Website design project on a laptop"><figcaption>Web design</figcaption></figure>
        <figure><img src="{{ asset('img/project-4.jpg') }}" loading="lazy" width="550" height="450" alt="Web development project"><figcaption>Web development</figcaption></figure>
      </div>
      <p class="work-note">Our Sydney client <a href="https://securityandcabling.com.au/" target="_blank" rel="noopener noreferrer">Security &amp; Cabling</a> trusted us to redesign their website, and we still develop it today.</p>
    </div>
  </section>

  <section class="services" data-k="services">
    <div class="wrap">
      <div class="label">What We Do</div>
      <ol class="svc">
        <li><span class="n">01</span><h3>Web Design</h3><p>Clean, modern, mobile-first designs that make a strong first impression.</p></li>
        <li><span class="n">02</span><h3>Web Development</h3><p>Fast, reliable websites and web apps built with Laravel and modern tools.</p></li>
        <li><span class="n">03</span><h3>UI/UX Design</h3><p>Interfaces built around how real people think, so visitors find things easily.</p></li>
        <li><span class="n">04</span><h3>Web Security</h3><p>SSL, secure code, updates and vulnerability checks, from day one.</p></li>
        <li><span class="n">05</span><h3>SEO &amp; Digital Marketing</h3><p>Get found on Google in Dhaka and Sydney, and turn visits into customers.</p></li>
        <li><span class="n">06</span><h3>Programming</h3><p>Custom software, scripts and automation for the problems ready-made tools can't solve.</p></li>
      </ol>
    </div>
  </section>

  <section class="story stats" data-k="stats">
    <div class="wrap">
      <div class="stat-row">
        <div class="stat"><strong>6<small>services</small></strong><span>One team, end to end</span></div>
        <div class="stat"><strong>7<small>clients</small></strong><span>And growing</span></div>
        <div class="stat"><strong>2<small>cities</small></strong><span>Dhaka &amp; Sydney</span></div>
      </div>
    </div>
  </section>

  <section class="story close" data-k="close">
    <div class="box">Security is built in from day one. Every site we ship gets SSL, secure code and regular updates, so your business and your customers stay protected.</div>
  </section>

  <section class="dark mission" data-k="mission">
    <div class="wrap">
      <div class="stripe"></div>
      <div class="label" style="margin-top:22px">Our Mission</div>
      <p class="lead">To give every business, from a family shop in Dhaka to a growing company in Sydney, secure websites and software it can truly trust, with honest pricing and clear communication.</p>
      <a class="pill" href="{{ url('/contact') }}">Start a project <span>&rarr;</span></a>
    </div>
  </section>

  <section class="promise" data-k="promise">
    <div class="wrap">
      <div class="label">Our Vision</div>
      <h2>Where we are heading.</h2>
      <div class="quote-mark" aria-hidden="true">&ldquo;</div>
      <blockquote>To become a security-first technology partner, born in Bangladesh and trusted on both sides of the world, that businesses turn to first when they need to grow online.</blockquote>
      <div class="who"><i aria-hidden="true"></i><span>Md Muktadir Anik &amp; Tamim Ahmed<br><span style="color:var(--muted)">Founders, e-Trust</span></span></div>
    </div>
  </section>

  <section class="story cta" id="start" data-k="cta">
    <div class="wrap" style="display:flex;flex-direction:column;flex:1">
      <h2 class="display">Let's build something great.</h2>
      <a class="pill" href="{{ url('/contact') }}">Start a project <span>&rarr;</span></a>
      <small><a href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a> &middot; <a href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a></small>
      <div class="signoff">
        <div class="roundel"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="var(--g)" d="M46.4 33.4 L45.2 33.2 L29.3 42.7 L27.6 44.2 L26.8 45.9 L26.8 59.5 L27.6 60.3 L29.0 60.5 L46.7 49.3 L47.0 34.1Z"/><path fill="var(--g)" d="M44.7 3.3 L11.2 23.3 L8.1 26.2 L7.3 28.9 L7.3 67.9 L8.3 71.0 L10.3 72.9 L42.1 91.1 L45.2 92.1 L46.3 91.1 L46.0 76.9 L24.4 63.8 L23.1 61.7 L23.4 34.3 L26.1 31.6 L45.6 19.5 L46.3 18.0 L46.3 4.2 L45.5 3.3Z"/><path fill="var(--b)" d="M51.2 4.4 L50.9 88.5 L51.8 91.0 L52.9 92.3 L59.4 96.2 L62.8 96.7 L65.3 95.9 L91.4 80.4 L92.6 77.7 L92.7 64.6 L91.6 64.9 L69.2 78.4 L68.4 77.7 L68.4 50.5 L69.5 49.7 L81.8 49.7 L83.9 48.6 L85.4 46.1 L85.4 35.1 L84.6 34.0 L69.6 34.0 L68.7 33.4 L68.3 32.6 L68.2 17.2 L67.8 15.5Z"/></svg></div>
        <p>e-Trust IT solutions.<br>Dhaka &middot; Sydney.</p>
      </div>
    </div>
  </section>
</main>

<footer class="dark footer" data-k="footer">
  <div class="label">&nbsp;</div>
  <h2>e-Trust<br>IT Solutions</h2>
  <div class="foot-grid">
    <div>
      <a href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a>
      <a class="sub" href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer">{{ config('etrust.address') }}</a>
      <a class="sub" href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a>
    </div>
    <div>
      <a href="{{ url('/') }}">Home</a>
      <a href="{{ url('/about') }}">About</a>
      <a href="{{ url('/services') }}">Services</a>
      <a href="{{ url('/projects') }}">Projects</a>
      <a href="{{ url('/team') }}">Team</a>
      <a href="{{ url('/contact') }}">Contact</a>
    </div>
    <div>
      <a href="{{ config('etrust.facebook') }}" target="_blank" rel="noopener noreferrer">Facebook</a>
    </div>
  </div>
  <p class="fine">&copy; {{ date('Y') }} e-trust.online. All rights reserved. Developed by Md Muktadir Anik &amp; Tamim Ahmed.</p>
</footer>

@verbatim
<script>
  window.ET_SHAPES = {"green":[[[-0.036,0.1661],[-0.0477,0.1678],[-0.2067,0.0732],[-0.2243,0.0582],[-0.2318,0.0406],[-0.2318,-0.095],[-0.2243,-0.1033],[-0.21,-0.105],[-0.0326,0.0071],[-0.0301,0.1594]],[[-0.0527,0.4665],[-0.3883,0.2674],[-0.4192,0.2381],[-0.4268,0.2113],[-0.4268,-0.1787],[-0.4167,-0.2096],[-0.3967,-0.2289],[-0.0787,-0.4113],[-0.0477,-0.4213],[-0.0368,-0.4113],[-0.0402,-0.269],[-0.2561,-0.1377],[-0.2686,-0.1167],[-0.2661,0.1569],[-0.2393,0.1837],[-0.0435,0.305],[-0.0368,0.3201],[-0.0368,0.4582],[-0.0452,0.4665]]],"blue":[[[0.0117,0.4556],[0.0092,-0.3845],[0.0176,-0.4096],[0.0293,-0.423],[0.0937,-0.4623],[0.128,-0.4665],[0.1531,-0.459],[0.4142,-0.3042],[0.4259,-0.2766],[0.4268,-0.146],[0.4159,-0.1485],[0.1925,-0.2841],[0.1841,-0.2774],[0.1841,-0.0054],[0.195,0.0029],[0.318,0.0029],[0.3389,0.0138],[0.354,0.0389],[0.354,0.1494],[0.3456,0.1603],[0.1958,0.1603],[0.1874,0.1661],[0.1833,0.1745],[0.1824,0.3276],[0.1782,0.3452]]]};
</script>
<script type="module">
import * as THREE from 'three';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';

const canvas = document.getElementById('gl');
let renderer;
try {
  renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true, powerPreference: 'high-performance' });
} catch (e) {
  document.documentElement.classList.add('no-gl');
  throw e;
}
const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
renderer.outputColorSpace = THREE.SRGBColorSpace;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 1.05;

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(30, 1, 0.1, 100);
camera.position.set(0, 0.4, 11);
camera.lookAt(0, 0, 0);

const pmrem = new THREE.PMREMGenerator(renderer);
scene.environment = pmrem.fromScene(new RoomEnvironment(), 0.04).texture;
scene.add(new THREE.HemisphereLight(0xffffff, 0xb9bcc4, 0.6));
const key = new THREE.DirectionalLight(0xffffff, 1.6);
key.position.set(4, 6, 6);
scene.add(key);
const rim = new THREE.DirectionalLight(0xbfd4ff, 1.1);
rim.position.set(-6, 2, -4);
scene.add(rim);

/* ---- the 3D mark, extruded from the traced logo outline ---- */
const stage = new THREE.Group();   // follows position, holds shadow + stripes
const logo = new THREE.Group();    // rotates
stage.add(logo);
scene.add(stage);

const brand = { g: new THREE.Color('#2bcf8f'), b: new THREE.Color('#0d43b0') };
const silver = { g: new THREE.Color('#f3f3f0'), b: new THREE.Color('#d9dbe0') };
const navy = { g: new THREE.Color('#1d2c4f'), b: new THREE.Color('#0e1834') };
const mats = {
  g: new THREE.MeshPhysicalMaterial({ color: brand.g, metalness: 0.2, roughness: 0.26, clearcoat: 1, clearcoatRoughness: 0.12 }),
  b: new THREE.MeshPhysicalMaterial({ color: brand.b, metalness: 0.2, roughness: 0.26, clearcoat: 1, clearcoatRoughness: 0.12 }),
};
const depth = 0.2;
const extrude = { depth, bevelEnabled: true, bevelThickness: 0.035, bevelSize: 0.022, bevelSegments: 5, curveSegments: 1 };
for (const part of ['g', 'b']) {
  for (const poly of window.ET_SHAPES[part === 'g' ? 'green' : 'blue']) {
    const shape = new THREE.Shape(poly.map(([x, y]) => new THREE.Vector2(x * 2.2, y * 2.2)));
    const geo = new THREE.ExtrudeGeometry(shape, extrude);
    geo.translate(0, 0, -depth / 2);
    logo.add(new THREE.Mesh(geo, mats[part]));
  }
}

/* soft contact shadow */
const sh = document.createElement('canvas'); sh.width = sh.height = 256;
const sx = sh.getContext('2d');
const grad = sx.createRadialGradient(128, 128, 0, 128, 128, 128);
grad.addColorStop(0, 'rgba(0,0,0,0.38)'); grad.addColorStop(1, 'rgba(0,0,0,0)');
sx.fillStyle = grad; sx.fillRect(0, 0, 256, 256);
const shadowMat = new THREE.MeshBasicMaterial({ map: new THREE.CanvasTexture(sh), transparent: true, depthWrite: false });
const shadow = new THREE.Mesh(new THREE.PlaneGeometry(3.2, 1.6), shadowMat);
shadow.rotation.x = -Math.PI / 2; shadow.position.y = -1.3;
stage.add(shadow);

/* brand stripes running along the floor behind the mark */
const stripes = new THREE.Group();
['#2bcf8f', '#0d43b0', '#0b1f5c'].forEach((c, i) => {
  const m = new THREE.Mesh(new THREE.PlaneGeometry(26, 0.16), new THREE.MeshBasicMaterial({ color: c, transparent: true, depthWrite: false }));
  m.rotation.x = -Math.PI / 2;
  m.position.set(-6, -1.32, -0.55 - i * 0.2);
  stripes.add(m);
});
stripes.rotation.y = 0.42;
stage.add(stripes);

/* ---- scroll choreography: one pose per section ---- */
// [x, y, z, rotX, rotY, rotZ, scale, colour(0 brand / 1 silver / 2 navy), stripes]
const POSES = {
  hero:     [ 2.05, -0.55, 0,   0.10, -0.62, 0,    1.15, 0, 1],
  intro:    [ 0.15,  1.05, 0,   0.06,  0.10, 0,    1.05, 0, 0],
  work:     [ 0.40,  5.20, -1,  0.40,  1.10, 0,    0.90, 0, 0],
  services: [ 3.10,  0.10, -1,  0.15, -1.00, 0.04, 1.00, 1, 0],
  stats:    [ 0.70, -0.75, 0,   0.08, -1.12, 0,    1.30, 1, 1],
  close:    [-1.55, -0.35, 4.2, 0.02, -1.30, 0.03, 1.55, 2, 0],
  mission:  [-1.55, -0.35, 4.2, 0.02, -1.30, 0.03, 1.55, 2, 0],
  promise:  [ 3.30,  1.55, -2,  0.30,  0.70, 0,    0.75, 0, 0],
  cta:      [ 2.05, -0.55, 0,   0.10, -0.62 + Math.PI * 2, 0, 1.15, 0, 1],
  footer:   [ 2.05, -0.55, 0,   0.10, -0.62 + Math.PI * 2, 0, 1.15, 0, 1],
};
const POSES_MOBILE = {
  hero:     [ -0.20, -0.95, 0,   0.10, -0.62, 0,    0.78, 0, 1],
  intro:    [ 0.00,  1.45, 0,   0.06,  0.10, 0,    0.90, 0, 0],
  services: [ 1.90,  0.10, -1,  0.15, -1.00, 0.04, 0.80, 1, 0],
  stats:    [ 0.15, -1.15, 0,   0.08, -1.12, 0,    1.05, 1, 1],
  close:    [-0.95, -0.95, 4.0, 0.02, -1.30, 0.03, 1.25, 2, 0],
  mission:  [-0.95, -0.95, 4.0, 0.02, -1.30, 0.03, 1.25, 2, 0],
  promise:  [ 1.45,  2.75, -2,  0.30,  0.70, 0,    0.55, 0, 0],
  cta:      [ -0.20, -0.95, 0,   0.10, -0.62 + Math.PI * 2, 0, 0.78, 0, 1],
  footer:   [ -0.20, -0.95, 0,   0.10, -0.62 + Math.PI * 2, 0, 0.78, 0, 1],
};

const sections = [...document.querySelectorAll('[data-k]')];
let anchors = [];
let mobile = false;
function layout() {
  const w = innerWidth, h = innerHeight;
  renderer.setSize(w, h, false);
  camera.aspect = w / h;
  camera.updateProjectionMatrix();
  mobile = w / h < 0.85;
  anchors = sections.map(el => {
    const r = el.getBoundingClientRect();
    return { k: el.dataset.k, at: r.top + scrollY + Math.min(r.height, h) * 0.5 };
  });
}
addEventListener('resize', layout);

const pose = k => (mobile && POSES_MOBILE[k]) || POSES[k];
const smooth = t => t * t * (3 - 2 * t);
function target() {
  const s = scrollY + innerHeight * 0.5;
  if (s <= anchors[0].at) return pose(anchors[0].k).slice();
  for (let i = 0; i < anchors.length - 1; i++) {
    const a = anchors[i], b = anchors[i + 1];
    if (s < b.at) {
      const t = smooth((s - a.at) / (b.at - a.at));
      const pa = pose(a.k), pb = pose(b.k);
      return pa.map((v, j) => v + (pb[j] - v) * t);
    }
  }
  return pose(anchors[anchors.length - 1].k).slice();
}

const cur = pose('hero').slice();
const pointer = { x: 0, y: 0 };
addEventListener('pointermove', e => {
  pointer.x = e.clientX / innerWidth - 0.5;
  pointer.y = e.clientY / innerHeight - 0.5;
});

function mix3(c, t, out) {
  const a = t <= 1 ? brand : silver, b = t <= 1 ? silver : navy, u = t <= 1 ? t : t - 1;
  mats.g.color.copy(a.g).lerp(b.g, u);
  mats.b.color.copy(a.b).lerp(b.b, u);
}

layout();
let last = performance.now();
function frame(now) {
  const dt = Math.min((now - last) / 1000, 0.05); last = now;
  const tgt = target();
  const k = reduce ? 1 : 1 - Math.exp(-dt * 5);
  for (let i = 0; i < cur.length; i++) cur[i] += (tgt[i] - cur[i]) * k;
  const [x, y, z, rx, ry, rz, sc, col, st] = cur;
  const t = now / 1000;
  const idle = reduce ? 0 : 1;
  stage.position.set(x, y + Math.sin(t * 0.9) * 0.05 * idle, z);
  stage.scale.setScalar(sc);
  logo.rotation.set(rx + pointer.y * 0.12 * idle, ry + Math.sin(t * 0.5) * 0.06 * idle + pointer.x * 0.25 * idle, rz);
  mix3(null, col);
  stripes.children.forEach(m => (m.material.opacity = st));
  stripes.position.x = (1 - st) * -4;
  shadowMat.opacity = 0.35 + st * 0.65;
  renderer.render(scene, camera);
  requestAnimationFrame(frame);
}
requestAnimationFrame(frame);
// fonts and images change section heights once loaded
document.fonts && document.fonts.ready.then(layout);
addEventListener('load', layout);
</script>
<script>
  (function () {
    var btn = document.getElementById('menu-btn'), menu = document.getElementById('site-menu');
    function set(open) { menu.hidden = !open; btn.setAttribute('aria-expanded', open ? 'true' : 'false'); }
    btn.addEventListener('click', function () { set(menu.hidden); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') set(false); });
    document.addEventListener('click', function (e) { if (!menu.hidden && !menu.contains(e.target) && !btn.contains(e.target)) set(false); });
  })();
</script>
@endverbatim
</body>
</html>
