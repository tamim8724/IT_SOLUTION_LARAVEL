@extends('layouts.site')
@section('title', 'About e-Trust | Web Design Studio in Dhaka, Serving Sydney')
@section('description', 'Meet e-Trust, a small, hands-on web design and development team in Dhaka, Bangladesh, building trusted websites and software for clients in Sydney and worldwide.')
@section('page', 'about')
@section('page_css', 'about')
@section('body_class', 'has3d')
@section('content')
<canvas id="gl" aria-hidden="true"></canvas>
<section class="ab-hero" data-k="hero"><div class="wrap grid">
  <div>
    <p class="eyebrow">About e-Trust · Dhaka &amp; Sydney</p>
    <h1>Small team. <em>Big standards.</em></h1>
    <p class="sub">An IT solutions firm with one simple belief: every business deserves technology it can trust.</p>
    <div class="ab-facts"><span>📍 Office in Dhaka</span><span>🌏 Clients worldwide</span><span>🛠 Built in-house</span></div>
  </div>
  <div class="hero-space"></div>
</div></section>

<section class="s" data-k="story"><div class="wrap">
  <div class="story">
    <div><div class="label">Our story</div><h2>Built on one simple word: trust.</h2></div>
    <div class="txt">
      <p class="lede">We started e-Trust in Moghbazar, Dhaka, to build websites and software that small businesses could actually rely on.</p>
      <div class="pillars">
        <div><b>Who we are</b><span>Founded by Md Muktadir Anik and Tamim Ahmed, e-Trust designs and develops websites, web applications and digital projects that are fast, safe and easy to use.</span></div>
        <div><b>We listen first</b><span>Every client is different. Every project starts by learning your goals and your business — before we design or write a single line of code.</span></div>
        <div><b>Safe from day one</b><span>SSL, backups and safe logins are built in from the start, not bolted on later.</span></div>
        <div><b>Honest about price</b><span>A clear scope and a fixed quote before we begin. No hidden extras, no surprise invoices.</span></div>
      </div>
    </div>
  </div>
</div></section>

<section class="s proc-bg" data-k="reach"><div class="wrap">
  <div class="head"><div><div class="label">Where we work</div><h2>One team, two cities.</h2></div><p>Same quality and honest pricing, wherever your business is.</p></div>
  <div class="cities">
    <div class="city"><span class="flag">🇧🇩 Bangladesh · Dhaka</span>
      <ul class="ck2"><li>Website design &amp; development</li><li>Laravel &amp; PHP web apps</li><li>SEO for Bangladeshi businesses</li></ul></div>
    <div class="city"><span class="flag">🇦🇺 Australia · Sydney</span>
      <ul class="ck2"><li>Small business websites</li><li>Redesign &amp; ongoing development</li><li>Local SEO &amp; web security</li></ul></div>
  </div>
</div></section>

<section class="s" data-k="sydney"><div class="wrap">
  <div class="sydney">
    <div class="sy-shot"><div class="dev-d"><div class="dbar"><i></i><i></i><i></i><span>securityandcabling.com.au</span></div><img src="{{ asset('img/sc-desktop.webp') }}" alt="Security & Cabling website"></div></div>
    <div class="sy-copy">
      <div class="label">Trusted in Sydney</div>
      <h2 class="sy-h">Security &amp; Cabling, a Sydney security installation company, trusted us with their website.</h2>
      <p class="sy-p">We redesigned it with quote forms and service-area landing pages, and we still develop and maintain it today. That is the kind of long-term relationship we want with every client.</p>
      <a class="btn btn-pri" href="https://securityandcabling.com.au/">Visit the site <i>→</i></a>
    </div>
  </div>
</div></section>

<section class="s proc-bg" data-k="mission"><div class="wrap">
  <div class="mv">
    <div class="mvc m"><div class="label">Our mission</div>
      <p>To give every business, big or small, technology that works as hard as they do.</p>
      <ul class="mvl">
        <li><b>Build it right.</b> Fast, secure websites and custom software, with safety built in from the first line of code.</li>
        <li><b>Keep it simple.</b> Every step explained in plain language, with honest pricing and no surprises.</li>
        <li><b>Grow together.</b> Helping business owners understand and use digital tools, so they can grow with confidence.</li>
      </ul>
    </div>
    <div class="mvc v"><div class="label" style="color:#b9c8ee">Our vision</div>
      <p>To become a security-first technology partner, born in Bangladesh and trusted on both sides of the world.</p>
      <p class="mv-sub">We want to prove that world-class digital work can come from Dhaka, and to grow alongside every client we serve.</p>
      <ul class="mvl">
        <li><b>Worldwide reach.</b> Serving businesses wherever they are, from Dhaka and Sydney to the rest of the world.</li>
        <li><b>Our innovation.</b> Building our own products to put useful digital tools in the hands of businesses, coming soon.</li>
        <li><b>A home for talent.</b> Building a Dhaka team known everywhere for the quality of its work.</li>
      </ul>
    </div>
  
</div></section>

<section class="s" data-k="values"><div class="wrap">
  <div class="head"><div><div class="label">What we stand for</div><h2>Our name is our promise.</h2></div></div>
  <div class="vals">
    <div class="val"><span class="ic">01</span><h3>Trust first</h3><p>We keep our word on scope, price and deadlines.</p></div>
    <div class="val"><span class="ic">02</span><h3>Security by default</h3><p>Backed by cyber security training, we harden every site from day one.</p></div>
    <div class="val"><span class="ic">03</span><h3>Built to last</h3><p>Clean code, fast pages, and solutions that keep working as you grow.</p></div>
    <div class="val"><span class="ic">04</span><h3>Growing together</h3><p>We share what we know, from training entrepreneurs to explaining every decision.</p></div>
  </div>
  <div class="stats2" data-k="stats">
    <div><strong>3+ <small>years</small></strong><span>Building websites &amp; software</span></div>
    <div><strong>Worldwide</strong><span>Clients from Dhaka to Sydney and beyond</span></div>
  </div>
</div></section>

<section class="s final" data-k="cta"><div class="wrap">
  <div class="label">Your move</div>
  <h2 style="margin-top:18px">Let's grow <em class="grad">together.</em></h2>
  <div class="actions" style="margin-top:30px"><a class="btn btn-pri" href="{{ url('/contact') }}">Start a project <i>→</i></a><a class="btn btn-sec" href="{{ url('/team') }}">Meet the team</a></div>
</div></section>
@endsection
@push('scripts')
<script type="importmap">{"imports":{"three":"{{ asset('js/vendor/three/three.module.min.js') }}","three/addons/":"{{ asset('js/vendor/three/addons') }}/"}}</script>
<script>
(function(){function t(z){return new Intl.DateTimeFormat('en-US',{hour:'numeric',minute:'2-digit',timeZone:z}).format(new Date())}
function k(){var a=document.getElementById('cd2'),b=document.getElementById('cs2');if(a)a.firstChild.nodeValue=t('Asia/Dhaka');if(b)b.firstChild.nodeValue=t('Australia/Sydney')}k();setInterval(k,30000)})();
</script>
<script>window.SCENE={"type": "globe", "poses": {"hero": [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 0, 1], "story": [-2.45, -0.1, 0, 22, 90, -0.08, 1.1, 0.05, 1], "reach": [2.4, 0, 0, -4, 118, 0.1, 1.15, 0.6, 1.3], "sydney": [-2.4, -0.1, 0.3, -30, 150, -0.1, 1.2, 1, 1.3], "mission": [0, 0, -3, 0, 122, 0, 0.9, 1, 1], "vision": [2.7, 1.1, -2, -4, 125, 0.1, 0.75, 1, 1], "values": [0, -2.6, -2, 10, 100, 0, 1.25, 1, 1.2], "stats": [2.4, -0.3, 0, 0, 120, 0.1, 1.0, 1, 1], "cta": [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 1, 1], "footer": [2.35, -0.25, 0, 18, 92, 0.12, 1.05, 1, 1]}, "mobile": {"hero": [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 0, 1], "story": [0.4, 2.3, -1, 22, 90, -0.08, 0.6, 0.05, 1], "reach": [0.2, -1.9, 0, -4, 118, 0.1, 0.7, 0.6, 1.3], "sydney": [0.2, -1.9, 0, -30, 150, -0.1, 0.72, 1, 1.3], "mission": [0, 0, -3, 0, 122, 0, 0.7, 1, 1], "vision": [0.6, 2.5, -2, -4, 125, 0.1, 0.5, 1, 1], "values": [0, -3.2, -2, 10, 100, 0, 1.0, 1, 1.2], "stats": [0.2, -1.9, 0, 0, 120, 0.1, 0.7, 1, 1], "cta": [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 1, 1], "footer": [0.2, -1.75, 0, 18, 92, 0.12, 0.72, 1, 1]}, "assets": {"shapes": @json(asset('js/data/logo-shapes.json')), "dots": @json(asset('js/data/land-dots.json')), "img": @json(asset('img') . '/')}};</script>
<script type="module" src="{{ asset('js/three-site.js') }}?v={{ config('etrust.asset_version') }}"></script>
@endpush
