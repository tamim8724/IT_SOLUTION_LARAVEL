@extends('layouts.site')
@section('title', 'Projects & Case Studies | e-Trust Web Design')
@section('description', 'See e-Trust projects: the Security & Cabling website for a Sydney installer, plus concept builds for restaurants, retail and trades. Your project could be next.')
@section('page', 'projects')
@section('page_css', 'projects')
@section('body_class', 'navy prj has3d')
@section('content')
<canvas id="gl" aria-hidden="true"></canvas>
<section class="ph-hero" data-k="hero"><div class="wrap"><div><p class="ey">Our projects</p><h1>Work we're proud of.</h1><p>Client websites, our own innovation and concept builds that show what we can make for you — all designed and coded in-house.</p><div class="acts"><a class="btn btn-pri" href="#p1">View the case study <i>→</i></a><a class="btn btn-sec" href="{{ url('/audit') }}">Book a free website audit</a></div></div></div></section>
<section class="pj" data-k="p0"><div class="wrap"><div class="col"><div class="mshot drawn" style="background:repeating-linear-gradient(135deg,#102349 0 14px,#14294F 14px 28px);border:2px dashed rgba(43,207,143,.45);color:#2BCF8F">OUR INNOVATION<br><small style="font-size:14px;color:#F5F6F8">Coming soon</small></div>
<span class="tag" style="color:#2BCF8F">01 · Our innovation <span class="soonb">Coming soon</span></span><h2>Our Innovation</h2>
<p class="d">Alongside client work, our team is building a few innovative products of our own, designed around real problems that businesses in Bangladesh and around the world face every day. We're planning and testing them now, and we'll reveal them one by one when they're ready.</p>
<form class="actions lu-form" action="{{ url('/api/launch-updates') }}" method="post" novalidate><label class="hp" for="lu-web2">Website</label><input class="hp" id="lu-web2" name="website" tabindex="-1" autocomplete="off"><label class="hp" for="lu-email2">Email</label><input id="lu-email2" type="email" name="email" placeholder="Your email for launch updates" autocomplete="email" required><button class="btn btn-pri" type="submit">Get launch updates <i>→</i></button><p class="lu-msg" role="status" aria-live="polite">Be the first to know when we launch.</p></form></div></div></section>
<section class="pj right" id="p1" data-k="p1"><div class="wrap"><div class="col"><div class="mshot"><img src="{{ asset('img/img-sc.webp') }}" alt="Security & Cabling website"></div>
<span class="tag" style="color:#5BC0EB">02 · Client website · Sydney</span><h2>Security &amp; Cabling</h2>
<p class="d">A complete redesign for a Sydney security, CCTV and cabling installer — and a long-term partnership that continues today.</p>
<div class="glass"><dl class="cs">
<div><dt>The client</dt><dd>A Sydney installer of CCTV, alarms, access control and TV antennas.</dd></div>
<div><dt>The challenge</dt><dd>The old site didn't show their services clearly, and customers had no easy way to ask for a quote.</dd></div>
<div><dt>What we did</dt><dd>Full redesign, quote forms, service-area pages and local SEO, plus ongoing development.</dd></div>
<div><dt>The result</dt><dd>A professional site that makes it easy to request a quote — and a client who keeps working with us.</dd></div>
</dl></div>
<div class="glass q">“e-Trust rebuilt our website from the ground up and made it far easier for customers to request a quote. They reply quickly, explain everything in plain English, and we're still working with them today.”<b>Saad Habib · Security &amp; Cabling, Sydney</b></div>
<div class="acts"><a class="btn btn-pri" href="https://securityandcabling.com.au/">Visit the site <i>→</i></a></div>
</div></div></section>
<section class="pj" data-k="p2"><div class="wrap"><div class="col"><div class="mshot"><img src="{{ asset('img/img-simple.webp') }}" alt="Brightline Electrical concept website"></div>
<span class="tag" style="color:#ffc21a">03 · Simple demo <span class="conb">Concept project</span></span><h2>Brightline Electrical</h2>
<p class="d">A clean, fast website for a Sydney electrician. Built to do one job well: turn local searches into phone calls and quote requests.</p>
<div class="chips"><span>One-page site</span><span>Click-to-call</span><span>Quote form</span><span>Local SEO</span></div>
<p class="d" style="margin-top:14px;font-size:14.5px;color:#9a9ca3">Perfect for: tradies, clinics, local shops and service businesses.</p>
<div class="acts"><a class="btn btn-pri" href="{{ url('/demos') }}/simple.html">Open the demo <i>→</i></a></div></div></div></section>
<section class="pj right" data-k="p3"><div class="wrap"><div class="col"><div class="mshot"><img src="{{ asset('img/img-3d.webp') }}" alt="Ember & Stack 3D concept website"></div>
<span class="tag" style="color:#ff7a1a">04 · 3D demo <span class="conb">Concept project</span></span><h2>Ember &amp; Stack</h2>
<p class="d">An interactive 3D website for a Dhaka burger restaurant. As you scroll, the burger builds itself layer by layer — then you can see the menu and book a table.</p>
<div class="chips"><span>3D scroll story</span><span>Menu</span><span>Table booking</span><span>Mobile-ready</span></div>
<p class="d" style="margin-top:14px;font-size:14.5px;color:#9a9ca3">Perfect for: restaurants, cafés and brands that want to stand out.</p>
<div class="acts"><a class="btn btn-pri" href="{{ url('/demos') }}/3d.html">Open the demo <i>→</i></a></div></div></div></section>
<section class="pj" data-k="p4"><div class="wrap"><div class="col"><div class="mshot"><img src="{{ asset('img/img-pro.webp') }}" alt="Noksha House concept website"></div>
<span class="tag" style="color:#e2b866">05 · Professional demo <span class="conb">Concept project</span></span><h2>Noksha House</h2>
<p class="d">A premium online store for a Bangladeshi clothing brand. Elegant typography, an arched window that opens as you scroll, and collections that feel like a magazine.</p>
<div class="chips"><span>Premium brand</span><span>Scroll animation</span><span>Collections</span><span>Store locator</span></div>
<p class="d" style="margin-top:14px;font-size:14.5px;color:#9a9ca3">Perfect for: fashion, jewellery, real estate and luxury brands.</p>
<div class="acts"><a class="btn btn-pri" href="{{ url('/demos') }}/professional.html">Open the demo <i>→</i></a></div></div></div></section>
<section class="pj right" data-k="p5"><div class="wrap"><div class="col"><div class="mshot drawn" style="background:repeating-linear-gradient(135deg,#102349 0 14px,#14294F 14px 28px);border:2px dashed rgba(241,241,239,.3);color:#2bcf8f">YOUR PROJECT<br><small style="font-size:14px;color:#f1f1ef">Reserved for you</small></div>
<span class="tag" style="color:#2bcf8f">06 · Reserved</span><h2>Your project is next.</h2>
<p class="d">This spot is waiting for your business. Simple, 3D or premium — tell us what you need and we'll show you what it could look like.</p>
<div class="acts"><a class="btn btn-pri" href="{{ url('/contact') }}">Claim this spot <i>→</i></a><a class="btn btn-sec" href="{{ url('/audit') }}">Book a free website audit</a></div></div></div></section>
<section class="app" data-k="approach"><div class="wrap"><p class="ey" style="color:#c27a00">Every project</p><h2>What every client gets.</h2><div class="grid">
<div><h3>Mobile-first</h3><p>Looks right and works fast on every phone.</p></div>
<div><h3>Fast &amp; safe</h3><p>SSL, clean code and regular updates from day one.</p></div>
<div><h3>SEO-ready</h3><p>Titles, structure and sitemap so Google can find you.</p></div>
<div><h3>Long-term care</h3><p>We stay on after launch to keep it growing.</p></div></div></div></section>
<section class="pcta" data-k="cta"><div class="wrap"><div><h2>Your project could be next.</h2><p>Free audit, fixed quote, and a team that stays with you after launch.</p><div class="acts"><a class="btn btn-pri" href="{{ url('/audit') }}">Book a free website audit <i>→</i></a><a class="btn btn-sec" href="https://wa.me/61422757090">Chat on WhatsApp</a></div></div></div></section>
@endsection
@push('scripts')
<script type="importmap">{"imports":{"three":"{{ asset('js/vendor/three/three.module.min.js') }}","three/addons/":"{{ asset('js/vendor/three/addons') }}/"}}</script>
<script>window.SCENE={"type": "laptop", "poses": {"hero": [2.1, -0.75, 0, 0.42, -0.55, 0, 0.85, 0.12, 0], "p0": [2.75, -0.6, -0.6, 0.16, -0.38, 0, 0.78, 1, 0], "p1": [-2.75, -0.6, -0.6, 0.16, 0.38, 0, 0.78, 1, 1], "p2": [2.75, -0.6, -0.6, 0.16, -0.38, 0, 0.78, 1, 2], "p3": [-2.75, -0.6, -0.6, 0.16, 0.38, 0, 0.78, 1, 3], "p4": [2.75, -0.6, -0.6, 0.16, -0.38, 0, 0.78, 1, 4], "approach": [0, -0.2, -3, 0.12, 0, 0, 1.0, 1, 5], "cta": [2.1, -0.75, 0, 0.42, 5.733185307179586, 0, 0.85, 0.45, 0], "footer": [2.1, -0.75, 0, 0.42, 5.733185307179586, 0, 0.85, 0.45, 0], "p5": [-2.75, -0.6, -0.6, 0.16, 0.38, 0, 0.78, 1, 5]}, "mobile": {}, "projects": [{"title": "Our Innovation", "type": "Coming soon", "accent": "#2BCF8F", "tags": ["Our own product", "Coming soon"], "url": "e-trust.online"}, "img-sc.webp", "img-simple.webp", "img-3d.webp", "img-pro.webp", {"title": "Your project could be here", "type": "Reserved for you", "accent": "#2bcf8f", "tags": ["Website", "Web app", "AI"], "url": "your-business.com"}], "assets": {"shapes": @json(asset('js/data/logo-shapes.json')), "dots": @json(asset('js/data/land-dots.json')), "img": @json(asset('img') . '/')}, "floor": false};</script>
<script type="module" src="{{ asset('js/three-site.js') }}?v={{ config('etrust.asset_version') }}"></script>
@endpush
