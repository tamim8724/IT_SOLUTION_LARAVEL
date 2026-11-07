@php
    $scene = [
        'type' => 'globe',
        // [x, y, z, focusLat, focusLon, tiltZ, scale, arc 0..1 (Dhaka -> Sydney), glow]
        'poses' => [
            'hero'    => [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 0, 1],
            'story'   => [-2.45, -0.1, 0, 22, 90, -0.08, 1.1, 0.05, 1],
            'reach'   => [2.4, 0, 0, -4, 118, 0.1, 1.15, 0.6, 1.3],
            'sydney'  => [-2.4, -0.1, 0.3, -30, 150, -0.1, 1.2, 1, 1.3],
            'mission' => [0, 0, -3, 0, 122, 0, 0.9, 1, 1],
            'vision'  => [2.7, 1.1, -2, -4, 125, 0.1, 0.75, 1, 1],
            'values'  => [0, -2.6, -2, 10, 100, 0, 1.25, 1, 1.2],
            'stats'   => [2.4, -0.3, 0, 0, 120, 0.1, 1.0, 1, 1],
            'cta'     => [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 1, 1],
            'footer'  => [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 1, 1],
        ],
        'mobile' => [
            'hero'    => [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 0, 1],
            'story'   => [0.4, 2.3, -1, 22, 90, -0.08, 0.6, 0.05, 1],
            'reach'   => [0.2, -1.9, 0, -4, 118, 0.1, 0.7, 0.6, 1.3],
            'sydney'  => [0.2, -1.9, 0, -30, 150, -0.1, 0.72, 1, 1.3],
            'mission' => [0, 0, -3, 0, 122, 0, 0.7, 1, 1],
            'vision'  => [0.6, 2.5, -2, -4, 125, 0.1, 0.5, 1, 1],
            'values'  => [0, -3.2, -2, 10, 100, 0, 1.0, 1, 1.2],
            'stats'   => [0.2, -1.9, 0, 0, 120, 0.1, 0.7, 1, 1],
            'cta'     => [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 1, 1],
            'footer'  => [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 1, 1],
        ],
    ];
@endphp
@extends('layouts.three')

@section('title', 'About e-Trust | IT Company in Dhaka, Bangladesh')
@section('description', 'Learn about e-Trust, an IT solutions company in Dhaka founded by Md Muktadir Anik and Tamim Ahmed, serving businesses in Bangladesh and Sydney. Our story, mission, vision and values.')
@section('theme', 'about')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">About e-Trust</p>
        <h1 class="display big" style="max-width:8.5em">Born in Dhaka. Trusted in Sydney.</h1>
        <p class="lead" style="max-width:24ch">An IT solutions firm with one simple belief: every business deserves technology it can trust.</p>
        <p class="scroll-hint" style="margin-top:auto;padding-top:30px">Scroll to follow our story &darr;</p>
    </div>
</section>

<section class="story right" data-k="story" style="justify-content:center">
    <div class="wrap">
        <div class="col">
            <div class="label">Our Story</div>
            <p class="lead">We started e-Trust in Moghbazar, Dhaka, to build websites and software that small businesses could actually rely on.</p>
            <p class="body">Founded by Md Muktadir Anik and Tamim Ahmed, e-Trust designs and develops websites, web applications and digital projects that are fast, safe and intuitive. Every project starts with listening: we learn your goals and your business first, because every client is different. Security is built in from day one, not added later, and we are honest about price.</p>
        </div>
    </div>
</section>

<section class="story" data-k="reach" style="justify-content:center">
    <div class="wrap">
        <div class="col">
            <div class="label">Where We Work</div>
            <p class="lead">One team, two cities. Same quality and honest pricing, wherever your business is.</p>
            <div class="grid2" style="margin-top:26px">
                <div>
                    <h3 style="margin:0">Bangladesh &middot; Dhaka</h3>
                    <ul class="checks">
                        <li>Website design &amp; development</li>
                        <li>Laravel &amp; PHP web apps</li>
                        <li>SEO for Bangladeshi businesses</li>
                    </ul>
                </div>
                <div>
                    <h3 style="margin:0">Australia &middot; Sydney</h3>
                    <ul class="checks">
                        <li>Small business websites</li>
                        <li>Redesign &amp; ongoing development</li>
                        <li>Local SEO &amp; web security</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="story right" data-k="sydney" style="justify-content:center">
    <div class="wrap">
        <div class="col">
            <div class="label">Trusted in Sydney</div>
            <p class="lead">Security &amp; Cabling, a Sydney security installation company, trusted us with their website.</p>
            <p class="body">We redesigned it with quote forms and service-area landing pages, and we still develop and maintain it today. That is the kind of long-term relationship we want with every client.</p>
            <div class="actions"><a class="pill" href="https://securityandcabling.com.au/" target="_blank" rel="noopener noreferrer">Visit the site <span>&rarr;</span></a></div>
        </div>
    </div>
</section>

<section class="panel pad" data-k="mission">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">Our Mission</div>
        <p class="lead" style="max-width:32ch;margin-top:12vh">Our mission is to give every business, from a family shop in Dhaka to a growing company in Sydney, technology it can truly trust.</p>
        <p class="body" style="max-width:60ch">We build fast, secure websites and custom business software, put security in from the first line of code, and explain every step in plain language, with honest pricing and no surprises. Along the way, we help business owners understand and use digital tools, so they can grow with confidence.</p>
    </div>
</section>

<section class="pad" data-k="vision">
    <div class="wrap">
        <div class="label">Our Vision</div>
        <div class="quote-mark" aria-hidden="true" style="margin-top:30px">&ldquo;</div>
        <blockquote>To become a security-first technology partner, born in Bangladesh and trusted on both sides of the world: the team businesses in Bangladesh and Australia turn to first.</blockquote>
        <p class="body">We want to prove that world-class digital work can come from Dhaka, and to grow alongside every client we serve.</p>
    </div>
</section>

<section class="pad" data-k="values" style="padding-bottom:40vh">
    <div class="wrap">
        <div class="label">What We Stand For</div>
        <h2 class="display mid" style="margin-top:24px">Our name is our promise.</h2>
        <div class="values">
            <div><h3>Trust first</h3><p class="muted">We keep our word on scope, price and deadlines.</p></div>
            <div><h3>Security by default</h3><p class="muted">Backed by cyber security training, we harden every site from day one.</p></div>
            <div><h3>Built to last</h3><p class="muted">Clean code, fast pages, and solutions that keep working as you grow.</p></div>
            <div><h3>Growing together</h3><p class="muted">We share what we know, from training entrepreneurs to explaining every decision.</p></div>
        </div>
    </div>
</section>

<section class="story" data-k="stats" style="justify-content:center">
    <div class="wrap">
        <div class="stat-row">
            <div class="stat"><strong>3<small>+ yrs</small></strong><span>Building websites &amp; software</span></div>
            <div class="stat"><strong>4<small>people</small></strong><span><a href="{{ url('/team') }}">Meet the team</a></span></div>
            <div class="stat"><strong>2<small>cities</small></strong><span>Dhaka &amp; Sydney</span></div>
        </div>
    </div>
</section>

<section class="story hero" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Let's grow together.</h2>
        <div class="actions">
            <a class="pill" href="{{ url('/contact') }}#message">Start a project <span>&rarr;</span></a>
            <a class="ghost" href="{{ url('/team') }}">Meet the team</a>
        </div>
    </div>
</section>
@endsection
