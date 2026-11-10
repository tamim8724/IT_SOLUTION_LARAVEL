@extends('layouts.site')
@section('title', 'Free Website Audit | e-Trust')
@section('description', 'Get a free website audit from e-Trust: speed, Google visibility, mobile and safety checked by hand, with a plain-English report in 2 working days.')
@section('page', 'audit')
@section('page_css', 'audit')
@section('body_class', 'audit-body')
@section('no_nav', '1')
@section('content')
<div class="audit-page">
<header class="ahead"><div class="wrap">
  <a class="brand" href="{{ url('/') }}" aria-label="e-Trust home"><svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="var(--mark-g)" d="M46.4 33.4 L45.2 33.2 L29.3 42.7 L27.6 44.2 L26.8 45.9 L26.8 59.5 L27.6 60.3 L29.0 60.5 L46.7 49.3 L47.0 34.1Z"/><path fill="var(--mark-g)" d="M44.7 3.3 L11.2 23.3 L8.1 26.2 L7.3 28.9 L7.3 67.9 L8.3 71.0 L10.3 72.9 L42.1 91.1 L45.2 92.1 L46.3 91.1 L46.0 76.9 L24.4 63.8 L23.1 61.7 L23.4 34.3 L26.1 31.6 L45.6 19.5 L46.3 18.0 L46.3 4.2 L45.5 3.3Z"/><path fill="var(--mark-b)" d="M51.2 4.4 L50.9 88.5 L51.8 91.0 L52.9 92.3 L59.4 96.2 L62.8 96.7 L65.3 95.9 L91.4 80.4 L92.6 77.7 L92.7 64.6 L91.6 64.9 L69.2 78.4 L68.4 77.7 L68.4 50.5 L69.5 49.7 L81.8 49.7 L83.9 48.6 L85.4 46.1 L85.4 35.1 L84.6 34.0 L69.6 34.0 L68.7 33.4 L68.3 32.6 L68.2 17.2 L67.8 15.5Z"/></svg><span>e-trust<b>.</b>online</span></a>
  <a class="back" href="{{ url('/') }}">← Back to site</a>
</div></header>
<section class="top"><div class="wrap">
  <p class="eyebrow">Free website audit</p>
  <h2 style="font-size:clamp(36px,5vw,68px);font-weight:800;margin:14px 0 16px;max-width:16ch">Find out what your website is <em>costing you.</em></h2>
  <p>We check your site's speed, Google visibility and mobile experience by hand, then send you a short, plain-English report with the top fixes. Free, no strings attached.</p>
  <div class="pills"><span>⏱ Report in <b>2 working days</b></span><span>📧 Report <b>by email</b></span><span>💸 <b>100% free</b>, no obligation</span></div>
</div></section>

<div class="main">
  <div>
    <div class="h3">What we check</div>
    <div class="checks">
      <div class="ck"><span class="n">01</span><div><b>Speed</b><span>How fast your site loads on a phone, and what's slowing it down.</span></div></div>
      <div class="ck"><span class="n">02</span><div><b>Google &amp; SEO</b><span>Titles, descriptions, Google Business Profile and why you're not ranking higher.</span></div></div>
      <div class="ck"><span class="n">03</span><div><b>Mobile experience</b><span>Buttons, text and menus on real phone sizes, not just desktop.</span></div></div>
      <div class="ck"><span class="n">04</span><div><b>Enquiries &amp; trust</b><span>Can a visitor contact you in two taps? Do your forms actually arrive?</span></div></div>
      <div class="ck"><span class="n">05</span><div><b>Basic safety</b><span>SSL padlock, outdated plugins and broken links.</span></div></div>
    </div>
    <div class="report">
      <span class="tag">SAMPLE</span>
      <h4>What your report looks like</h4><small>your-business.com · 3 pages</small>
      <div class="scores">
        <div class="sc"><strong class="r">38</strong><span>Speed</span></div>
        <div class="sc"><strong class="a">61</strong><span>SEO</span></div>
        <div class="sc"><strong class="a">70</strong><span>Mobile</span></div>
        <div class="sc"><strong class="g">92</strong><span>Safety</span></div>
      </div>
      <ul class="fix"><li>Homepage images are 4 MB — compress to load 3× faster</li><li>No Google Business Profile — invisible in "near me" searches</li><li>Contact button hidden on mobile</li></ul>
    </div>
  </div>

  <form class="form" id="aform" method="POST" action="{{ route('audit.send') }}" novalidate>
    @csrf
    <h1 class="h3" style="font-size:28px;font-weight:800;margin:0">Get my free audit</h1>
    <p class="sub">Takes 30 seconds. Everything happens by email — no calls, no sales pitch.</p>
    @if (session('audit_success'))<p class="okmsg" role="status">{{ session('audit_success') }}</p>@endif
    @if ($errors->any())<p class="badmsg" role="alert">{{ $errors->first() }}</p>@endif
    <div class="hp" aria-hidden="true"><label>Leave empty<input type="text" name="company" tabindex="-1" autocomplete="off"></label></div>
    <div class="row2">
      <div class="f"><label for="a-name">Your name</label><input class="in" id="a-name" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name" placeholder="e.g. Sarah Khan"><span class="err"></span></div>
      <div class="f"><label for="a-email">Email</label><input class="in" id="a-email" name="email" type="email" value="{{ old('email') }}" required maxlength="150" autocomplete="email" placeholder="you@business.com"><span class="err"></span></div>
    </div>
    <div class="f"><label for="a-site">Website address</label><input class="in" id="a-site" name="website" value="{{ old('website') }}" maxlength="255" inputmode="url" autocomplete="url" placeholder="www.your-business.com"><span class="err"></span>
      <label class="cb"><input type="checkbox" name="no_website" value="1" id="a-nosite" {{ old('no_website') ? 'checked' : '' }}>I don't have a website yet — send me a free website plan instead</label></div>
    <fieldset class="f"><legend>Where is your business?</legend><div class="seg">
      @foreach (['Australia' => '🇦🇺 Australia', 'Bangladesh' => '🇧🇩 Bangladesh', 'Other' => 'Other'] as $v => $t)<label><input type="radio" name="country" value="{{ $v }}" {{ old('country', 'Australia') === $v ? 'checked' : '' }}><span>{{ $t }}</span></label>@endforeach
    </div></fieldset>
    <fieldset class="f"><legend>What matters most to you?</legend><div class="chips">
      @foreach (['More enquiries', 'Ranking on Google', 'Faster site', 'A fresh design'] as $g)<label><input type="radio" name="goal" value="{{ $g }}" {{ old('goal', 'More enquiries') === $g ? 'checked' : '' }}><span>{{ $g }}</span></label>@endforeach
    </div></fieldset>
    <button class="btn" type="submit">Get my free audit <i>→</i></button>
    <div class="fine"><span>No calls</span><span>No spam</span><span>No obligation</span><span>Report in 2 working days</span></div>
  </form>
</div>

<section class="steps"><div class="wrap">
  <div class="h3" style="margin:0">What happens next</div>
  <div class="grid">
    <div class="st"><span class="w">Today</span><b>You send the form</b><span>You get an instant confirmation email.</span></div>
    <div class="st"><span class="w">Within 1 day</span><b>We confirm by email</b><span>A real person replies and asks anything we need.</span></div>
    <div class="st"><span class="w">Within 2 days</span><b>Report in your inbox</b><span>A short PDF with scores and the top 3–5 fixes.</span></div>
    <div class="st"><span class="w">Anytime after</span><b>Questions? Just reply</b><span>Ask us anything by email. Fix it yourself, or ask us for a quote.</span></div>
  </div>
</div></section>
</div>
@endsection
@push('scripts')
<script>
(function(){var f=document.getElementById('aform');if(!f)return;var E=function(n){return f.elements[n]};
var site=E('website'),no=E('no_website');
function sync(){site.disabled=no.checked;if(no.checked){err(site,'')}}no.addEventListener('change',sync);sync();
function err(el,m){var e=el.parentNode.querySelector('.err');el.classList.toggle('bad',!!m);if(e)e.textContent=m||''}
['name','email','website'].forEach(function(n){E(n).addEventListener('input',function(){err(this,'')})});
f.addEventListener('submit',function(ev){var ok=true;
if(!E('name').value.trim()){err(E('name'),'Enter your name');ok=false}
if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(E('email').value.trim())){err(E('email'),'Enter a valid email address');ok=false}
if(!no.checked&&!/[a-z0-9-]+\.[a-z]{2,}/i.test(site.value.trim())){err(site,'Enter your website address, or tick the box below');ok=false}
if(!ok){ev.preventDefault();return}f.querySelector('button[type=submit]').disabled=true;});
})();
</script>
@endpush
