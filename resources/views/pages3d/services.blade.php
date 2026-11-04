@php
    $services = config('etrust.services');
    // [x, y, z, rotX, ringYaw, rotZ, scale, active service 0..5, floor/spread]
    $n = count($services);
    $poses = ['hero' => [3.7, -0.7, -3.6, 0.34, 0, 0, 0.62, 0, 1]];
    $mobile = ['hero' => [0, -3.1, -1.5, 0.34, 0, 0, 0.38, 0, 0]];
    foreach ($services as $i => $s) {
        $left = $i % 2 === 0; // text on the left -> objects on the right
        $poses['s' . $i] = [$left ? 3.3 : -3.3, -0.25, -1.8, 0.08, 0, 0, 0.66, $i, 0];
        $mobile['s' . $i] = [0, -3.05, -1, 0.1, 0, 0, 0.38, $i, 0];
    }
    $poses += [
        'process' => [0, 0.3, -6, 0.5, 0, 0, 0.9, $n - 0.4, 1],
        'faq'     => [0, 9, -7, 0.5, 0, 0, 0.8, $n + 0.4, 0],
        'cta'     => [3.7, -0.7, -3.6, 0.34, 0, 0, 0.62, $n, 1],
        'footer'  => [3.7, -0.7, -3.6, 0.34, 0, 0, 0.62, $n, 1],
    ];
    $mobile += [
        'process' => [0, 0.3, -6, 0.5, 0, 0, 0.7, $n - 0.4, 1],
        'faq'     => [0, 9, -7, 0.5, 0, 0, 0.6, $n + 0.4, 0],
        'cta'     => [0, -3.1, -1.5, 0.34, 0, 0, 0.38, $n, 0],
        'footer'  => [0, -3.1, -1.5, 0.34, 0, 0, 0.38, $n, 0],
    ];
    $scene = ['type' => 'services', 'poses' => $poses, 'mobile' => $mobile, 'shapes' => array_column($services, 'shape')];
    $faqs = config('etrust.faqs');
    $process = config('etrust.process');
@endphp
@extends('layouts.three')

@section('title', 'Web Design, Development, SEO & Security Services')
@section('description', 'Website design, web development, UI/UX, web security, SEO & digital marketing and custom programming for businesses in Dhaka, Bangladesh and Sydney, Australia.')
@section('theme', 'services')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $faqs),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">Our Services</p>
        <h1 class="display big" style="max-width:8em">Everything your business needs online.</h1>
        <p class="lead" style="max-width:24ch">Seven services, one trusted team in Dhaka, for clients in Bangladesh and Sydney.</p>
        <ol class="svc" style="gap:10px;margin-top:26px">
            @foreach ($services as $i => $s)
                <li style="align-items:center"><span class="n" style="font-size:22px">{{ sprintf('%02d', $i + 1) }}</span><h3 style="font-size:18px"><a href="#s{{ $i }}" style="text-decoration:none">{{ $s['title'] }}</a></h3></li>
            @endforeach
        </ol>
    </div>
</section>

@foreach ($services as $i => $s)
    <section class="story {{ $i % 2 ? 'right' : '' }}" id="s{{ $i }}" data-k="s{{ $i }}" style="justify-content:center">
        <div class="wrap">
            <div class="col">
                <div class="big-n" aria-hidden="true">{{ sprintf('%02d', $i + 1) }}</div>
                <h2 class="display mid" style="margin-top:14px">{{ $s['title'] }}</h2>
                <p class="lead" style="font-size:clamp(19px,1.8vw,24px);margin-top:14px">{{ $s['short'] }}</p>
                <p class="body" style="color:inherit;font-size:19px">{{ $s['text'] }}</p>
                <ul class="checks">
                    @foreach ($s['points'] as $pt)
                        <li>{{ $pt }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endforeach

<section class="panel pad" data-k="process">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">How We Work</div>
        <h2 class="display mid" style="margin-top:22px">Four clear steps.</h2>
        <div class="values">
            @foreach ($process as $i => $st)
                <div><h3>{{ sprintf('%02d', $i + 1) }} &middot; {{ $st['title'] }}</h3><p class="muted">{{ $st['text'] }}</p></div>
            @endforeach
        </div>
    </div>
</section>

<section class="pad" data-k="faq">
    <div class="wrap">
        <div class="label">FAQ</div>
        <h2 class="display mid" style="margin-top:22px">Questions we hear often.</h2>
        <div class="faq">
            @foreach ($faqs as $i => [$q, $a])
                <details @if ($i === 0) open @endif>
                    <summary>{{ $q }}</summary>
                    <p>{{ $a }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

<section class="story hero" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Which one do you need?</h2>
        <div class="actions"><a class="pill" href="{{ url('/contact') }}#message">Tell us about your project <span>&rarr;</span></a>
            <a class="ghost" href="{{ url('/assistant') }}">Ask our free AI</a></div>
    </div>
</section>
@endsection
