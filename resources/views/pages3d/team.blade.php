@php
    $team = config('etrust.team');
    // [x, y, z, rotX, ringYaw, rotZ, scale, active member, lines/floor]
    $poses = ['hero' => [2.1, -0.2, -1.4, 0.3, 0, 0, 0.82, 0, 1]];
    $mobile = ['hero' => [0, -1.8, -1, 0.3, 0, 0, 0.52, 0, 1]];
    foreach ($team as $i => $m) {
        $left = $i % 2 === 0;
        $poses['m' . $i] = [$left ? 3.0 : -3.0, -0.15, -1.2, 0.08, 0, 0, 0.8, $i, 0.3];
        $mobile['m' . $i] = [0, -2.6, -1, 0.1, 0, 0, 0.45, $i, 0];
    }
    $n = count($team);
    $poses += [
        'culture' => [0, 0.4, -5, 0.45, 0, 0, 0.95, $n - 0.5, 1],
        'cta'     => [2.1, -0.2, -1.4, 0.3, 0, 0, 0.82, $n, 1],
        'footer'  => [2.1, -0.2, -1.4, 0.3, 0, 0, 0.82, $n, 1],
    ];
    $mobile += [
        'culture' => [0, 0.4, -5, 0.45, 0, 0, 0.7, $n - 0.5, 1],
        'cta'     => [0, -1.8, -1, 0.3, 0, 0, 0.52, $n, 1],
        'footer'  => [0, -1.8, -1, 0.3, 0, 0, 0.52, $n, 1],
    ];
    $scene = ['type' => 'team', 'poses' => $poses, 'mobile' => $mobile, 'team' => array_column($team, 'img')];
    $labels = ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'twitter' => 'X'];
@endphp
@extends('layouts.three')

@section('title', 'Our Team | Web Developers & Designers in Dhaka')
@section('description', 'Meet the e-Trust team of web developers, designers and IT specialists in Dhaka who design, build and secure your website.')
@section('theme', 'team')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">Our Team</p>
        <h1 class="display big" style="max-width:8em">The people behind e-Trust.</h1>
        <p class="lead" style="max-width:24ch">A small, connected team in Dhaka and Sydney. Scroll to meet everyone.</p>
    </div>
</section>

@foreach ($team as $i => $m)
    <section class="story {{ $i % 2 ? 'right' : '' }}" data-k="m{{ $i }}" style="justify-content:center">
        <div class="wrap">
            <div class="col">
                <span class="tag">{{ $m['role'] }}</span>
                <h2 class="display mid" style="margin-top:12px">{{ $m['name'] }}</h2>
                <p class="body" style="color:inherit;font-size:19px">{{ $m['bio'] }}</p>
                <div class="socials">
                    @if ($m['profile'])
                        <a href="{{ $m['profile'] }}" target="_blank" rel="noopener noreferrer">Portfolio</a>
                    @endif
                    @foreach ($m['social'] as $net => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $m['name'] }} on {{ $labels[$net] ?? ucfirst($net) }}">{{ $labels[$net] ?? ucfirst($net) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endforeach

<section class="panel pad" data-k="culture">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">How We Work Together</div>
        <h2 class="display mid" style="margin-top:22px">Small team. Big trust.</h2>
        <div class="values">
            <div><h3>Trust first</h3><p class="muted">We keep our word to clients and to each other.</p></div>
            <div><h3>Security by default</h3><p class="muted">Everyone thinks about security, not just one person.</p></div>
            <div><h3>Built to last</h3><p class="muted">We review each other's work so it stays solid.</p></div>
            <div><h3>Growing together</h3><p class="muted">We share what we learn, inside the team and with clients.</p></div>
        </div>
    </div>
</section>

<section class="story hero" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Work with us.</h2>
        <div class="actions"><a class="pill" href="{{ url('/contact') }}#message">Get in touch <span>&rarr;</span></a></div>
    </div>
</section>
@endsection
