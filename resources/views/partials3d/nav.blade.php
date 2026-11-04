@php
    $links = [
        ['/', 'Home'],
        ['/about', 'About'],
        ['/services', 'Services'],
        ['/projects', 'Projects'],
        ['/dorkari', 'DORKARI'],
        ['/team', 'Team'],
        ['/assistant', 'AI Assistant'],
        ['/contact', 'Contact'],
    ];
    $isActive = fn ($path) => $path === '/' ? Request::is('/') : Request::is(ltrim($path, '/'));
@endphp
<header class="nav" id="nav">
    <a class="brand" href="{{ url('/') }}" aria-label="e-trust.online home">
        @include('partials3d.mark')
        <span>e-trust<b>.</b>online</span>
    </a>
    <nav class="nav-links" aria-label="Main">
        @foreach ($links as [$path, $label])
            <a href="{{ url($path) }}" @class(['active' => $isActive($path)]) @if ($isActive($path)) aria-current="page" @endif>{{ $label }}</a>
        @endforeach
    </nav>
    <a class="nav-cta" href="{{ url('/contact') }}#message">Start a project</a>
    <button class="nav-toggle" id="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-sheet" aria-label="Open menu">
        <i></i><i></i>
    </button>
</header>
<div class="nav-sheet" id="nav-sheet" hidden>
    <nav aria-label="Mobile">
        @foreach ($links as $i => [$path, $label])
            <a href="{{ url($path) }}" @class(['active' => $isActive($path)])><small>{{ sprintf('%02d', $i + 1) }}</small>{{ $label }}</a>
        @endforeach
    </nav>
    <div class="sheet-foot">
        <a href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a>
        <a href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a>
    </div>
</div>
