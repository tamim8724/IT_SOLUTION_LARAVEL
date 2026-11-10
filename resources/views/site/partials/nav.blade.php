{{-- Site header. $page = current page key for the active link --}}
@php
  $links = [['home','/','Home'],['about','/about','About'],['services','/services','Services'],['projects','/projects','Projects'],['team','/team','Team'],['assistant','/assistant','AI Assistant'],['contact','/contact','Contact']];
  $cur = $page ?? '';
@endphp
<a class="skip" href="#main">Skip to content</a>
<header class="nav"><div class="wrap">
  <a class="brand" href="{{ url('/') }}" aria-label="e-trust.online home">@include('site.partials.mark')<span>e-trust<b>.</b>online</span></a>
  <nav class="links" aria-label="Main">@foreach ($links as [$k,$href,$label])<a href="{{ url($href) }}" @if($cur === $k) class="on" aria-current="page" @endif>{{ $label }}</a>@endforeach</nav>
  <a class="cta" href="{{ url('/audit') }}">Free website audit</a>
  <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mnav"><span></span></button>
</div></header>
<div class="mnav" id="mnav" role="dialog" aria-modal="true" aria-label="Menu">
  <div class="top"><a class="brand" href="{{ url('/') }}">@include('site.partials.mark')<span>e-trust<b>.</b>online</span></a><button class="x" type="button" aria-label="Close menu">✕</button></div>
  <nav aria-label="Mobile">@foreach ($links as [$k,$href,$label])<a href="{{ url($href) }}" @if($cur === $k) aria-current="page" @endif>{{ $label }}</a>@endforeach</nav>
  <a class="mcta" href="{{ url('/audit') }}">Free website audit →</a>
  <p class="mfoot">info@e-trust.online · Dhaka &amp; Sydney</p>
</div>
