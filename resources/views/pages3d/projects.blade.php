@php
    $projects = config('etrust.projects');
    // [x, y, z, rotX, rotY, rotZ, scale, lid open 0..1, screen image index]
    $poses = ['hero' => [2.1, -0.75, 0, 0.42, -0.55, 0, 0.85, 0.12, 0]];
    $mobile = ['hero' => [0, -1.95, 0, 0.42, -0.55, 0, 0.55, 0.12, 0]];
    foreach ($projects as $i => $p) {
        $left = $i % 2 === 0;
        $poses['p' . $i] = [$left ? 2.75 : -2.75, -0.6, -0.6, 0.16, $left ? -0.38 : 0.38, 0, 0.78, 1, $i];
        $mobile['p' . $i] = [0, -2.0, 0, 0.18, 0, 0, 0.52, 1, $i];
    }
    $last = count($projects) - 1;
    $poses += [
        'approach' => [0, -0.2, -3, 0.12, 0, 0, 1.0, 1, $last],
        'cta'      => [2.1, -0.75, 0, 0.42, -0.55 + 2 * M_PI, 0, 0.85, 0.45, 0],
        'footer'   => [2.1, -0.75, 0, 0.42, -0.55 + 2 * M_PI, 0, 0.85, 0.45, 0],
    ];
    $mobile += [
        'approach' => [0, -0.2, -3, 0.12, 0, 0, 0.7, 1, $last],
        'cta'      => [0, -1.95, 0, 0.42, -0.55 + 2 * M_PI, 0, 0.55, 0.45, 0],
        'footer'   => [0, -1.95, 0, 0.42, -0.55 + 2 * M_PI, 0, 0.55, 0.45, 0],
    ];
    $scene = ['type' => 'laptop', 'poses' => $poses, 'mobile' => $mobile,
        'projects' => array_map(fn ($p) => ['title' => $p['title'], 'type' => $p['type'], 'accent' => $p['accent'], 'tags' => $p['tags'], 'url' => $p['url']], $projects)];
@endphp
@extends('layouts.three')

@section('title', 'Our Web Design & Development Projects')
@section('description', 'Recent website design, web development, cyber security and digital marketing projects by e-Trust for clients in Bangladesh and Sydney, Australia.')
@section('theme', 'projects')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow">Our Projects</p>
        <h1 class="display big" style="max-width:8em">Work we're proud of.</h1>
        <p class="lead" style="max-width:24ch">Our own product, client websites in Dhaka and Sydney, and free tools. Scroll to open the laptop.</p>
    </div>
</section>

@foreach ($projects as $i => $p)
    <section class="story {{ $i % 2 ? 'right' : '' }}" data-k="p{{ $i }}" style="justify-content:center">
        <div class="wrap">
            <div class="col">
                <span class="tag" style="color:{{ $p['accent'] }}">{{ sprintf('%02d', $i + 1) }} &middot; {{ $p['type'] }}</span>
                <h2 class="display mid" style="margin-top:12px">{{ $p['title'] }}</h2>
                <p class="body" style="color:inherit;font-size:19px">{{ $p['text'] }}</p>
                <div class="socials" style="margin-top:16px">
                    @foreach ($p['tags'] as $tg)
                        <span style="font-size:13px;font-weight:600;padding:7px 12px;border-radius:999px;border:1.5px solid var(--line)">{{ $tg }}</span>
                    @endforeach
                </div>
                @if ($p['url'])
                    @php $external = str_starts_with($p['url'], 'http'); @endphp
                    <div class="actions"><a class="pill" href="{{ $external ? $p['url'] : url($p['url']) }}" @if ($external) target="_blank" rel="noopener noreferrer" @endif>{{ $external ? 'Visit site' : 'Open' }} <span>&rarr;</span></a></div>
                @endif
            </div>
        </div>
    </section>
@endforeach

<section class="panel pad" data-k="approach">
    <div class="wrap">
        <div class="stripe"></div>
        <div class="label" style="margin-top:22px">Every Project</div>
        <h2 class="display mid" style="margin-top:22px">What every client gets.</h2>
        <div class="values">
            <div><h3>Mobile-first</h3><p class="muted">Looks right and works fast on every phone.</p></div>
            <div><h3>Secure</h3><p class="muted">SSL, secure code and updates from day one.</p></div>
            <div><h3>SEO-ready</h3><p class="muted">Titles, structure and sitemap so Google can find you.</p></div>
            <div><h3>Long-term care</h3><p class="muted">We stay on after launch to keep it growing.</p></div>
        </div>
    </div>
</section>

<section class="story hero" data-k="cta">
    <div class="wrap">
        <h2 class="display big" style="max-width:8em">Your project could be next.</h2>
        <div class="actions"><a class="pill" href="{{ url('/contact') }}#message">Start a project <span>&rarr;</span></a></div>
    </div>
</section>
@endsection
