@extends('layouts.site')
@section('title', 'Web Design & Development Company in Dhaka & Sydney | e-Trust')
@section('description', 'e-Trust builds fast, custom websites, web apps, AI assistants and secure hosting for businesses in Dhaka, Bangladesh and Sydney, Australia. Book a free website audit.')
@section('page', 'home')
@section('page_css', 'home')
@section('body_class', 'home3d has3d')
@section('content')
<canvas id="gl" aria-hidden="true"></canvas>
<section class="hero" data-k="hero">
  <div class="wrap grid">
    <div>
      <p class="eyebrow">Web design &amp; development · Dhaka &amp; Sydney</p>
      <h1>Your competitors won't like <em>your new website.</em></h1>
      <p class="sub">Custom websites, web apps and AI tools for ambitious businesses in Dhaka and Sydney.</p>
      <div class="actions">
        <a class="btn btn-pri" href="{{ url('/audit') }}">Book a free website audit <i>→</i></a>
        <a class="btn btn-sec" href="{{ url('/projects') }}">View our projects</a>
      </div>
      <div class="ticks"><span>Serving Dhaka &amp; Sydney</span><span>Custom-built, no templates</span><span>Reply within 1 working day</span></div>
    </div>
    <div class="hero-space" aria-hidden="true"></div>
  </div>
  
  <div class="clockbar"><div class="wrap">
    <div class="clock"><span class="dot"></span>Dhaka <b id="cd">--:--</b></div>
    <div class="clock"><span class="dot"></span>Sydney <b id="cs">--:--</b></div>
    <span class="note">Sydney clients: WhatsApp us 7 days · 10 am – 4 pm Sydney time</span>
  </div></div>
</section>


<section data-k="work" class="s"><div class="wrap">
  <div class="head">
    <div><div class="label">Selected projects</div><h2>Work our clients rely on.</h2></div>
    <a class="btn btn-sec" href="{{ url('/projects') }}">See all projects</a>
  </div>
  <div class="work2">
  <article class="case2">
    <div class="shots2">
      <div class="dev-d"><div class="dbar"><i></i><i></i><i></i><span>securityandcabling.com.au</span></div><img src="{{ asset('img/sc-desktop.webp') }}" alt="Security & Cabling website homepage on desktop, designed by e-Trust" loading="lazy"></div>
      <div class="dev-m"><img src="{{ asset('img/sc-mobile.webp') }}" alt="Security & Cabling website on mobile" loading="lazy"></div>
    </div>
    <div class="fbody">
      <span class="meta">FEATURED CASE STUDY · SYDNEY, AUSTRALIA</span>
      <h3>Security &amp; Cabling</h3>
      <p>A complete redesign for a Sydney security and cabling installer: faster pages, clear quote forms and service-area pages for local search. We still develop it today.</p>
      <div class="tags"><span>Redesign</span><span>Web development</span><span>Local SEO</span></div>
      <a class="more" href="{{ url('/projects') }}#p1">Read the case study →</a>
    </div>
  </article>
  <a class="nextmove" id="nextmove" href="{{ url('/contact') }}">
    <span class="nm-eyebrow">Welcome, your next move</span>
    <div class="nm-browser">
      <div class="nm-bar"><i></i><i></i><i></i><span>www.your-business.com</span></div>
      <div class="nm-screen">
        <div class="ys-nav"><b>● Your Business</b><span>Home</span><span>Shop</span><span>About</span><em>Order now</em></div>
        <div class="ys-hero">
          <div class="ys-txt"><small>NEW SEASON</small><strong>Your best-selling<br>product, front<br>and centre.</strong><span class="ys-btn">Shop now</span></div>
          <div class="ys-img"><i></i></div>
        </div>
        <div class="ys-cards"><i></i><i></i><i></i></div>
        <div class="nm-stamp">RESERVED<small>for your business</small></div>
        <svg class="nm-cursor" viewBox="0 0 24 24" width="30" height="30"><path d="M4 2l16 9-7 2-3 7z" fill="#0c0e13" stroke="#fff" stroke-width="1.5" stroke-linejoin="round"/></svg>
      </div>
    </div>
    <h3>This spot is still empty.<br><em>It's waiting for you.</em></h3>
    <p>Your website could sit right here, next to our Sydney client — looking sharp, loading fast and quietly stealing customers from the business down the road.</p>
    <p class="nm-small">No pressure. (Okay, a little pressure.)</p>
    <span class="nm-btn">Claim this spot <i>→</i></span>
  </a>
  </div>
</div></section>

<section data-k="services" class="s svc-dark"><div class="wrap">
  <div class="head">
    <div><div class="label">What we do</div><h2>Seven services. One accountable team.</h2></div>
    <p>Most clients start with a website or an app. We handle the design, SEO and hosting around it, so you have one team to call.</p>
  </div>
  <div class="prim">
    <div class="pc"><span class="n">01</span><h3>Website design &amp; development</h3><p>Fast, custom websites that turn visitors into customers.</p><ul><li>Custom design, no templates</li><li>Laravel, WordPress, modern JS</li><li>Speed &amp; SEO built in</li></ul></div>
    <div class="pc"><span class="n">02</span><h3>Custom software &amp; web apps</h3><p>Business software shaped around how you actually work.</p><ul><li>Dashboards, booking, POS</li><li>Progressive web apps</li><li>Payment &amp; API integration</li></ul></div>
    <div class="pc"><span class="n">03</span><h3>Cyber security</h3><p>Protect your website, data and customers.</p><ul><li>Security audit &amp; hardening</li><li>SSL, backups, safe logins</li><li>Malware clean-up</li></ul></div>
    <div class="pc"><span class="n">04</span><h3>AI &amp; automation</h3><p>Chat assistants and automation in Bangla and English.</p><ul><li>Website AI assistants</li><li>Document automation</li><li>Works with your tools</li></ul></div>
  </div>
  <div class="supp"><b>Also</b><a href="{{ url('/services') }}#design">UI/UX &amp; brand design</a><a href="{{ url('/services') }}#seo">Digital marketing &amp; SEO</a><a href="{{ url('/services') }}#hosting">Hosting, cloud &amp; maintenance</a></div>
</div></section>

<section data-k="why" class="s"><div class="wrap">
  <div class="head"><div><div class="label">Why e-Trust</div><h2>Why businesses choose us.</h2></div></div>
  <div class="why">
    <div><span class="ic">01</span><h3>Fast and safe by default</h3><p>Speed-optimised pages, SSL and regular backups come standard on every site we build.</p></div>
    <div><span class="ic">02</span><h3>Fixed, honest quotes</h3><p>A clear scope and a fixed price before we start. No surprise invoices.</p></div>
    <div><span class="ic">03</span><h3>Dhaka team, Sydney hours</h3><p>An in-house team in Dhaka, with WhatsApp support for Sydney clients 7 days a week, 10 am – 4 pm.</p></div>
    <div><span class="ic">04</span><h3>We stay after launch</h3><p>Updates, monitoring and support plans. We still develop our first Sydney client's site today.</p></div>
  </div>
</div></section>

<section data-k="process" class="s proc-bg"><div class="wrap">
  <div class="head">
    <div><div class="label">How we work</div><h2>From first call to launch in four steps.</h2></div>
    <p>A typical business website takes 2–4 weeks. You see progress on a live preview link every week.</p>
  </div>
  <div class="proc">
    <div class="st"><span class="n">01</span><span class="w">Days 1–3</span><h3>Discover</h3><p>A call to understand your business, customers and goals. You get a written scope and fixed quote.</p><p class="you"><b>You give:</b> 30 minutes &amp; examples you like</p></div>
    <div class="st"><span class="n">02</span><span class="w">Week 1</span><h3>Design</h3><p>Wireframes, then the visual design. Nothing is coded until you approve it.</p><p class="you"><b>You give:</b> feedback &amp; approval</p></div>
    <div class="st"><span class="n">03</span><span class="w">Weeks 2–3</span><h3>Build</h3><p>We develop in short steps with a live preview link you can open any time.</p><p class="you"><b>You give:</b> your content &amp; photos</p></div>
    <div class="st"><span class="n">04</span><span class="w">Week 4 +</span><h3>Launch &amp; care</h3><p>Testing, speed checks and launch, then updates and support as you grow.</p><p class="you"><b>You get:</b> a fast, secure site you can edit</p></div>
  </div>
</div></section>

<section data-k="reviews" class="s"><div class="wrap">
  <div class="head"><div><div class="label">Client words</div><h2>What our clients say.</h2></div></div>
  <div class="testi">
    <div class="quote">
      <span class="qm">“</span>
      <p class="qt2">e-Trust rebuilt our website from the ground up and made it far easier for customers to request a quote. They reply quickly, explain everything in plain English, and we're still working with them today.</p>
      <div class="who"><span class="av2">SH</span><div><b>Saad Habib</b><small>Security &amp; Cabling · Sydney</small></div></div>
    </div>
    <div class="invite">
      <span class="inv-tag">Next could be you</span>
      <h3>Good or bad,<br>we appreciate it.</h3>
      <p>Worked with us? Tell us how it went — the praise and the complaints. Honest feedback is how we get better, and the best ones end up right here.</p>
      <div class="inv-slot"><span class="av3">?</span><div><b>Your name here</b><small>Your business · Your city</small></div></div>
      <a class="btn btn-pri" href="{{ url('/contact') }}?subject=feedback">Share your feedback <i>→</i></a>
    </div>
  </div>
</div></section>

<section id="innovation" data-k="innovation" class="s dk"><div class="wrap">
  <div class="head">
    <div><div class="label">What's next</div><h2>Our Innovation</h2><div style="margin-top:18px"><span class="badge">Coming soon</span></div></div>
    <div class="in-copy">
      <p>We don't only build for our clients. Our team is also working on a few innovative ideas of our own: products designed around real problems that businesses in Bangladesh and around the world face every day.</p>
      <p>Right now we're planning, building and testing them carefully. We'll launch them one by one when they're ready, and share every detail here first.</p>
    </div>
  </div>
  <div class="dkg ing">
    <div><i style="background:#FFB547"></i><b>Idea 01</b><span>Planning and research</span><em>Revealing soon</em></div>
    <div><i style="background:#5BC0EB"></i><b>Idea 02</b><span>Design and early build</span><em>Revealing soon</em></div>
    <div><i style="background:#B794F6"></i><b>Idea 03</b><span>Testing with real users</span><em>Revealing soon</em></div>
  </div>
  <form class="actions lu-form" action="{{ url('/api/launch-updates') }}" method="post" novalidate><label class="hp" for="lu-web">Website</label><input class="hp" id="lu-web" name="website" tabindex="-1" autocomplete="off"><label class="hp" for="lu-email">Email</label><input id="lu-email" type="email" name="email" placeholder="Your email for launch updates" autocomplete="email" required><button class="btn btn-pri" type="submit">Get launch updates <i>→</i></button><p class="lu-msg" role="status" aria-live="polite">Be the first to know when we launch.</p></form>
</div></section>

<section data-k="ai" class="s"><div class="wrap ai">
  <div>
    <div class="label">Free AI assistant</div>
    <h2>Ask anything. <span style="font-family:'Noto Sans Bengali','Hind Siliguri'">যেকোনো প্রশ্ন করুন।</span></h2>
    <p>Our free assistant answers in Bangla, Banglish or English — study, business, writing, coding and staying safe online. The same technology we build for clients.</p>
    <div style="margin-top:28px;display:flex;gap:12px;flex-wrap:wrap"><a class="btn btn-pri" href="{{ url('/assistant') }}">Open AI Assistant <i>→</i></a></div>
  </div>
  <div class="chat">
    <div class="top"><i></i>e-Trust AI</div>
    <div class="msg u">আমার দোকানের জন্য website কেন দরকার?</div>
    <div class="msg a">ওয়েবসাইট থাকলে Google এ খুঁজলেই কাস্টমার আপনাকে পাবে, ২৪ ঘণ্টা অর্ডার নিতে পারবেন...</div>
    <div class="chips"><span>What services do you offer?</span><span>Write a Facebook post for my shop</span></div>
    <div class="inp">Ask in Bangla or English <b>↑</b></div>
  </div>
</div></section>

<section data-k="faq" class="s" style="padding-top:0"><div class="wrap faq-wrap">
  <div><div class="label">FAQ</div><h2>Questions clients ask first.</h2></div>
  <div class="faq">
    <details open><summary>How much does a website cost in Bangladesh or Australia?</summary><p>It depends on pages and features. Tell us about your project and we reply within one working day with next steps and a fixed quote.</p></details>
    <details><summary>Do you work with clients in Sydney?</summary><p>Yes. We already build and maintain websites for Sydney businesses, and you can WhatsApp us 7 days a week, 10 am – 4 pm Sydney time.</p></details>
    <details><summary>How long does a website take?</summary><p>Usually 2–4 weeks for a business website. Larger apps are planned in phases.</p></details>
    <details><summary>Can I update the website myself?</summary><p>Yes. We include an easy admin panel for text, images and products.</p></details>
  </div>
</div></section>

<section data-k="cta" class="s final"><div class="wrap grid">
  <div>
    <div class="label">Your move</div>
    <h2 style="margin-top:18px">Ready to make them <em class="grad">nervous?</em></h2>
    <p>Free consultation · Fixed quote · Reply within one working day.</p>
    <div class="actions"><a class="btn btn-pri" href="{{ url('/audit') }}">Book a free website audit <i>→</i></a><a class="btn btn-sec" href="https://wa.me/61422757090">Chat on WhatsApp</a></div>
    <p class="wa-note">WhatsApp: Dhaka Sat – Thu, 10 am – 7 pm · Sydney 7 days, 10 am – 4 pm</p>
  </div>
  <div class="offices">
    <div class="off"><h4>Dhaka office</h4><p>250/1, Nowatola, Moghbazar, Dhaka-1217</p><p><a class="tel" href="tel:+8801960013601">+880 1960 013601</a> · info@e-trust.online</p><small>Sat – Thu · 10 am – 7 pm (GMT+6)</small></div>
    <div class="off"><h4>Sydney · WhatsApp only</h4><p><a class="tel" href="https://wa.me/61422757090">+61 422 757 090</a> · info@e-trust.online</p><small>7 days · 10 am – 4 pm Sydney time</small></div>
  </div>
</div></section>
@endsection
@push('scripts')
<script type="importmap">{"imports":{"three":"{{ asset('js/vendor/three/three.module.min.js') }}","three/addons/":"{{ asset('js/vendor/three/addons') }}/"}}</script>
<script>window.SCENE={"type": "logo", "poses": {"hero": [2.75, -0.35, 0, 0.1, -0.45, 0, 1.2, 0, 1, 1], "work": [3.7, 1.1, -2, 0.25, 0.65, 0.08, 1.0, 0, 0, 0.32], "services": [-3.3, -0.7, -1, 0.1, -0.65, 0, 1.25, 2, 0, 0.95], "why": [3.1, 0.3, 1.2, 0.05, 0.4, 0, 1.3, 0, 0, 0.32], "process": [-3.4, 0.5, -1, 0.2, -0.55, 0.05, 1.1, 0, 0, 0.32], "reviews": [3.3, -0.2, 0, 0.1, 0.5, 0, 1.15, 0, 0, 0.32], "innovation": [0.2, 0.0, -4, 0.2, 0.15, 0, 1.9, 2, 0, 0.95], "ai": [-3.5, -0.7, 0, 0.1, -0.5, 0, 1.0, 0, 0, 0.32], "faq": [-3.3, -1.1, 0, 0.15, 0.55, 0, 1.0, 0, 0, 0.32], "cta": [2.75, -0.35, 0, 0.1, 5.833185307179586, 0, 1.2, 0, 1, 1], "footer": [2.75, -0.35, 0, 0.1, 5.833185307179586, 0, 1.2, 0, 1, 1]}, "mobile": {"hero": [0, 1.55, 0, 0.1, -0.45, 0, 0.5, 0, 0, 1], "work": [0.85, -1.7, -1, 0.15, -0.5, 0.05, 0.6, 0, 0, 0.32], "services": [-0.85, -1.7, -1, 0.15, 0.5, -0.05, 0.6, 2, 0, 0.95], "why": [0.85, -1.7, -1, 0.15, -0.5, 0.05, 0.6, 0, 0, 0.32], "process": [-0.85, -1.7, -1, 0.15, 0.5, -0.05, 0.6, 0, 0, 0.32], "reviews": [0.85, -1.7, -1, 0.15, -0.5, 0.05, 0.6, 0, 0, 0.32], "innovation": [0, -0.4, -3, 0.2, 0.15, 0, 1.2, 2, 0, 0.95], "ai": [-0.85, -1.7, -1, 0.15, 0.5, -0.05, 0.6, 0, 0, 0.32], "faq": [-0.85, -1.7, -1, 0.15, 0.5, -0.05, 0.6, 0, 0, 0.32], "cta": [0, -1.9, 0, 0.1, 5.833185307179586, 0, 0.55, 0, 1, 0.9], "footer": [0, -1.9, 0, 0.1, 5.833185307179586, 0, 0.55, 0, 1, 0.9]}, "assets": {"shapes": @json(asset('js/data/logo-shapes.json')), "dots": @json(asset('js/data/land-dots.json')), "img": @json(asset('img') . '/')}};</script>
<script type="module" src="{{ asset('js/three-site.js') }}?v={{ config('etrust.asset_version') }}"></script>
@endpush
