@php
    $dk = config('etrust.dorkari');
    $products = $dk['products'];
    $n = count($products);
    // [x, y, z, rotX, ringYaw, rotZ, scale, active product, floor]
    $poses = ['hero' => [2.7, -0.3, -2.2, 0.3, 0, 0, 0.72, 0, 1]];
    $mobile = ['hero' => [0, -2.3, -1.5, 0.3, 0, 0, 0.42, 0, 0.6]];
    foreach ($products as $i => $p) {
        $left = $i % 2 === 0;
        $poses['d' . $i] = [$left ? 3.0 : -3.0, -0.2, -1.2, 0.1, 0, 0, 0.72, $i, 0.12];
        $mobile['d' . $i] = [0, -3.0, -1, 0.12, 0, 0, 0.4, $i, 0];
    }
    $poses += [
        'audience' => [0, 0.2, -6, 0.5, 0, 0, 0.9, $n - 0.5, 1],
        'all'      => [0, 9, -7, 0.5, 0, 0, 0.8, $n, 0],
        'cta'      => [2.7, -0.3, -2.2, 0.3, 0, 0, 0.72, $n, 1],
        'footer'   => [2.7, -0.3, -2.2, 0.3, 0, 0, 0.72, $n, 1],
    ];
    $mobile += [
        'audience' => [0, 0.2, -6, 0.5, 0, 0, 0.7, $n - 0.5, 1],
        'all'      => [0, 9, -7, 0.5, 0, 0, 0.6, $n, 0],
        'cta'      => [0, -2.3, -1.5, 0.3, 0, 0, 0.42, $n, 0.6],
        'footer'   => [0, -2.3, -1.5, 0.3, 0, 0, 0.42, $n, 0.6],
    ];
    $scene = ['type' => 'dorkari', 'poses' => $poses, 'mobile' => $mobile,
        'products' => array_map(fn ($p) => ['name' => $p['name'], 'bn' => $p['bn'], 'color' => $p['color']], $products)];
@endphp
@extends('layouts.three')

@section('title', 'DORKARI: everyday tools in one account')
@section('description', 'DORKARI by e-Trust: Khata, Dorji, WebShilpo, Bikikini, Karigor, BariKhata, Nothi and TakaHisab. Everyday business and life tools for Bangladesh in one account.')
@section('theme', 'dorkari')

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@' . 'context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => 'DORKARI',
    'alternateName' => 'দরকারি',
    'applicationCategory' => 'BusinessApplication',
    'operatingSystem' => 'Web',
    'url' => $dk['url'],
    'description' => $dk['text'],
    'publisher' => ['@type' => 'Organization', 'name' => 'e-Trust', 'url' => url('/')],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow" style="color:var(--accent)">Our product</p>
        <h1 class="display big" style="max-width:8em">DORKARI <span class="h-bn" lang="bn" style="color:var(--accent)">দরকারি</span></h1>
        <p class="lead" style="max-width:26ch">{{ $dk['tagline'] }}</p>
        <p class="body" style="max-width:46ch">{{ $dk['text'] }}</p>
        <div class="actions" style="align-items:center">
            <a class="pill" href="{{ $dk['url'] }}" target="_blank" rel="noopener noreferrer">Visit DORKARI <span>&rarr;</span></a>
            <span class="dk-status">{{ $dk['status'] }}</span>
        </div>
    </div>
</section>

@foreach ($products as $i => $p)
    <section class="story {{ $i % 2 ? 'right' : '' }}" data-k="d{{ $i }}" style="justify-content:center;min-height:80svh">
        <div class="wrap">
            <div class="col">
                <div class="dk-swatch" style="background:{{ $p['color'] }}" aria-hidden="true">{{ mb_substr($p['bn'], 0, 1) }}</div>
                <span class="tag" style="color:{{ $p['color'] }}">{{ sprintf('%02d', $i + 1) }} / {{ sprintf('%02d', $n) }}</span>
                <h2 class="display mid" style="margin-top:10px">{{ $p['name'] }} <span class="dk-bn" lang="bn" style="color:{{ $p['color'] }}">{{ $p['bn'] }}</span></h2>
                <p class="body" style="color:inherit">{{ $p['text'] }}</p>
            </div>
        </div>
    </section>
@endforeach

<section class="panel pad" data-k="audience">
    <div class="wrap">
        <div class="label">Who DORKARI is for</div>
        <h2 class="display mid" style="margin-top:22px">Built for everyday Bangladesh.</h2>
        <div class="values" style="grid-template-columns:repeat(3,minmax(0,1fr))">
            @foreach ($dk['audience'] as $a)
                <div><h3>{{ $a['title'] }}</h3><p class="muted">{{ $a['text'] }}</p></div>
            @endforeach
        </div>
    </div>
</section>

<section class="pad" data-k="all">
    <div class="wrap">
        <div class="label">All eight tools</div>
        <h2 class="display mid" style="margin-top:22px">One account. Eight tools.</h2>
        <div class="dk-grid">
            @foreach ($products as $p)
                <a href="{{ $dk['url'] }}" target="_blank" rel="noopener noreferrer"><i style="background:{{ $p['color'] }}"></i><b>{{ $p['name'] }}</b><span lang="bn">{{ $p['bn'] }}</span></a>
            @endforeach
        </div>
    </div>
</section>

<section class="story hero" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Be first to try DORKARI.</h2>
        <div class="actions">
            <a class="pill" href="{{ $dk['url'] }}" target="_blank" rel="noopener noreferrer">dorkari.e-trust.online <span>&rarr;</span></a>
            <a class="ghost" href="{{ url('/contact') }}?service=DORKARI#message">Get launch updates</a>
        </div>
    </div>
</section>
@endsection
