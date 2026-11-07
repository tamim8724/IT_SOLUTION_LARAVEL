@php
    $T = 2 * M_PI;
    $scene = [
        'type' => 'logo',
        // [x, y, z, rotX, rotY, rotZ, scale, colour(0 brand / 1 silver / 2 navy), stripes]
        'poses' => [
            'hero'     => [2.05, -0.55, 0, 0.10, -0.62, 0, 1.15, 0, 1],
            'intro'    => [0.15, 1.05, 0, 0.06, 0.10, 0, 1.05, 0, 0],
            'work'     => [0.40, 5.20, -1, 0.40, 1.10, 0, 0.90, 0, 0],
            'services' => [3.10, 0.10, -1, 0.15, -1.00, 0.04, 1.00, 1, 0],
            'stats'    => [0.70, -0.75, 0, 0.08, -1.12, 0, 1.30, 1, 1],
            'close'    => [-1.55, -0.35, 4.2, 0.02, -1.30, 0.03, 1.55, 2, 0],
            'mission'  => [-1.55, -0.35, 4.2, 0.02, -1.30, 0.03, 1.55, 2, 0],
            'promise'  => [3.30, 1.55, -2, 0.30, 0.70, 0, 0.75, 0, 0],
            'dorkari'  => [-3.20, 1.45, -2, 0.30, 2.10, 0, 0.75, 0, 0],
            'ai'       => [3.30, 1.55, -2, 0.30, 3.50, 0, 0.75, 0, 0],
            'cta'      => [2.05, -0.55, 0, 0.10, -0.62 + $T, 0, 1.15, 0, 1],
            'footer'   => [2.05, -0.55, 0, 0.10, -0.62 + $T, 0, 1.15, 0, 1],
        ],
        'mobile' => [
            'hero'     => [-0.20, -0.95, 0, 0.10, -0.62, 0, 0.78, 0, 1],
            'intro'    => [0.00, 1.45, 0, 0.06, 0.10, 0, 0.90, 0, 0],
            'work'     => [0.40, 5.20, -1, 0.40, 1.10, 0, 0.90, 0, 0],
            'services' => [1.90, 0.10, -1, 0.15, -1.00, 0.04, 0.80, 1, 0],
            'stats'    => [0.15, -1.15, 0, 0.08, -1.12, 0, 1.05, 1, 1],
            'close'    => [-0.95, -0.95, 4.0, 0.02, -1.30, 0.03, 1.25, 2, 0],
            'mission'  => [-0.95, -0.95, 4.0, 0.02, -1.30, 0.03, 1.25, 2, 0],
            'promise'  => [1.45, 2.75, -2, 0.30, 0.70, 0, 0.55, 0, 0],
            'dorkari'  => [-1.45, 2.75, -2, 0.30, 2.10, 0, 0.55, 0, 0],
            'ai'       => [1.45, 2.75, -2, 0.30, 3.50, 0, 0.55, 0, 0],
            'cta'      => [-0.20, -0.95, 0, 0.10, -0.62 + $T, 0, 0.78, 0, 1],
            'footer'   => [-0.20, -0.95, 0, 0.10, -0.62 + $T, 0, 0.78, 0, 1],
        ],
    ];
@endphp
@extends('layouts.three')

@section('title', 'Web Design & Development Company in Dhaka & Sydney')
@section('description', 'e-Trust is a web design and development company in Dhaka, Bangladesh, also serving Sydney, Australia. Business websites, e-commerce, Laravel web apps, SEO and web security.')
@section('theme', 'home')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">Web design &amp; development &middot; Dhaka &amp; Sydney</p>
        <h1 class="display big">We build websites you can trust.</h1>
        <div class="actions">
            <a class="pill" href="#intro">Learn More <span>&rarr;</span></a>
        </div>
        <div class="signoff">
            <div class="roundel">@include('partials3d.mark')</div>
            <p>e-Trust IT solutions.<br>Dhaka &middot; Sydney.</p>
        </div>
    </div>
</section>

<section class="story bottom" id="intro" data-k="intro">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">Introduction</div>
        <p class="lead">e-Trust is an IT solutions firm from Dhaka, founded by Md Muktadir Anik and Tamim Ahmed. We design and build websites, web apps and digital projects that are fast, safe and easy to use, for businesses in Bangladesh and Sydney.</p>
    </div>
</section>

<section class="pad" data-k="work">
    <div class="wrap">
        <div class="label">Selected Work</div>
        <div class="grid2" style="margin-top:28px">
            <figure style="margin:0"><img src="{{ asset('img/project-1.jpg') }}" alt="Website design project on a laptop" width="550" height="450" loading="lazy" style="width:100%;height:auto;border-radius:4px;display:block"><figcaption class="muted" style="font-size:14px;margin-top:8px">Web design</figcaption></figure>
            <figure style="margin:0"><img src="{{ asset('img/project-4.jpg') }}" alt="Web development project" width="550" height="450" loading="lazy" style="width:100%;height:auto;border-radius:4px;display:block"><figcaption class="muted" style="font-size:14px;margin-top:8px">Web development</figcaption></figure>
        </div>
        <p class="lead" style="max-width:30ch">Our Sydney client <a href="https://securityandcabling.com.au/" target="_blank" rel="noopener noreferrer">Security &amp; Cabling</a> trusted us to redesign their website, and we still develop it today.</p>
        <div class="actions"><a class="pill" href="{{ url('/projects') }}">See all projects <span>&rarr;</span></a></div>
    </div>
</section>

<section class="pad" data-k="services" style="padding-bottom:16vh">
    <div class="wrap">
        <div class="label">What We Do</div>
        <ol class="svc">
            @foreach (config('etrust.services') as $i => $s)
                <li><span class="n">{{ sprintf('%02d', $i + 1) }}</span><h3><a href="{{ url('/services') }}#s{{ $i }}">{{ $s['title'] }}</a></h3><p>{{ $s['short'] }}</p></li>
            @endforeach
        </ol>
    </div>
</section>

<section class="story" data-k="stats" style="padding-top:calc(var(--nav-h) + 8vh)">
    <div class="wrap">
        <div class="stat-row">
            <div class="stat"><strong>6<small>services</small></strong><span>One team, end to end</span></div>
            <div class="stat"><strong>7<small>clients</small></strong><span>And growing</span></div>
            <div class="stat"><strong>2<small>cities</small></strong><span>Dhaka &amp; Sydney</span></div>
        </div>
    </div>
</section>

<section class="story" data-k="close" style="padding-top:calc(var(--nav-h) + 8vh); align-items:flex-end">
    <div class="box">Security is built in from day one. Every site we ship gets SSL, secure code and regular updates, so your business and your customers stay protected.</div>
</section>

<section class="panel pad" data-k="mission">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">Our Mission</div>
        <p class="lead" style="margin:16vh 0 34px;max-width:28ch">To give every business, from a family shop in Dhaka to a growing company in Sydney, secure websites and software it can truly trust, with honest pricing and clear communication.</p>
        <a class="pill" href="{{ url('/about') }}">About e-Trust <span>&rarr;</span></a>
    </div>
</section>

<section class="pad" data-k="promise">
    <div class="wrap">
        <div class="label">Our Vision</div>
        <p class="lead muted" style="margin:26px 0 40px">Where we are heading.</p>
        <div class="quote-mark" aria-hidden="true">&ldquo;</div>
        <blockquote>To become a security-first technology partner, born in Bangladesh and trusted on both sides of the world, that businesses turn to first when they need to grow online.</blockquote>
        <p class="muted" style="margin-top:24px">Md Muktadir Anik &amp; Tamim Ahmed, Founders</p>
    </div>
</section>

<section class="pad right" data-k="dorkari">
    <div class="wrap">
        <div class="col">
            <div class="label">Our Product</div>
            <h2 class="display mid" style="margin-top:22px">DORKARI <span lang="bn" class="dk-bn">দরকারি</span></h2>
            <p class="lead">{{ config('etrust.dorkari.tagline') }}</p>
            <p class="body">{{ config('etrust.dorkari.text') }}</p>
            <div class="dk-grid" style="grid-template-columns:repeat(4,minmax(0,1fr));gap:8px">
                @foreach (config('etrust.dorkari.products') as $p)
                    <a href="{{ url('/dorkari') }}" style="padding:10px"><i style="background:{{ $p['color'] }}"></i><b style="font-size:14px">{{ $p['name'] }}</b><span lang="bn" style="font-size:13px">{{ $p['bn'] }}</span></a>
                @endforeach
            </div>
            <div class="actions"><a class="pill" href="{{ url('/dorkari') }}">Explore DORKARI <span>&rarr;</span></a></div>
        </div>
    </div>
</section>

<section class="pad" data-k="ai">
    <div class="wrap">
        <div class="col">
            <div class="label">Free AI Assistant</div>
            <h2 class="display mid" style="margin-top:22px">Ask anything. <span lang="bn" class="h-bn">যেকোনো প্রশ্ন করুন।</span></h2>
            <p class="body" style="color:inherit">Our free AI assistant answers in Bangla or English: study, business, writing, coding and staying safe online.</p>
            <div class="actions">
                <a class="pill" href="{{ url('/assistant') }}">Open AI Assistant <span>&rarr;</span></a>
                <button type="button" class="ghost" style="background:none;color:inherit;font:inherit;cursor:pointer" onclick="document.querySelector('[data-chat-open]')?.click()">Chat here</button>
            </div>
        </div>
    </div>
</section>

<section class="story hero" id="start" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Let's build something great.</h2>
        <div class="actions"><a class="pill" href="{{ url('/contact') }}#message">Start a project <span>&rarr;</span></a></div>
        <p class="muted small" style="margin-top:12px"><a href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a> &middot; <a href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a></p>
        <div class="signoff">
            <div class="roundel">@include('partials3d.mark')</div>
            <p>e-Trust IT solutions.<br>Dhaka &middot; Sydney.</p>
        </div>
    </div>
</section>
@endsection
