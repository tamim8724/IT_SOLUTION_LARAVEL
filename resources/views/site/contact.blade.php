@extends('layouts.site')
@section('title', 'Contact e-Trust | Web Design Company in Dhaka & Sydney')
@section('description', 'Tell us about your project and get a clear, fixed quote within one working day. e-Trust works with businesses in Bangladesh, Sydney and worldwide.')
@section('page', 'contact')
@section('page_css', 'contact')
@section('body_class', 'navy')
@section('content')
<section class="ct-hero"><canvas id="gl" aria-hidden="true"></canvas><div class="wrap"><div>
<p class="eyebrow">Contact</p>
<h1>Let's <em>talk.</em></h1>
<p class="sub">Tell us about your project. We reply within one working day — with a clear next step, not a sales pitch.</p>
<div class="ways">
<a class="way" href="tel:+8801960013601"><i>☎</i><div><b>Call Dhaka</b><strong>+880 1960 013601</strong><span>Sat – Thu · 10 am – 7 pm</span></div></a>
<a class="way" href="https://wa.me/61422757090"><i>✆</i><div><b>Sydney · WhatsApp only</b><strong>+61 422 757 090</strong><span>7 days · 10 am – 4 pm</span></div></a>
<a class="way" href="mailto:info@e-trust.online"><i>✉</i><div><b>Email us</b><strong>info@e-trust.online</strong><span>Any time — we reply within a day</span></div></a>
<a class="way" href="{{ url('/audit') }}"><i>✓</i><div><b>Free website audit</b><strong>Get a free report</strong><span>Speed, SEO and mobile check</span></div></a>
</div></div></div></section>

<section class="ct-form" id="message"><div class="wrap fgrid">
<form class="card" id="cform" method="POST" action="{{ route('contact.send') }}" novalidate>
@csrf
@if (session('contact_success'))<p class="ok" role="status">{{ session('contact_success') }}</p>@endif
@if ($errors->any())<p class="ok bad-box" role="alert">{{ $errors->first() }}</p>@endif
<h2>Send us a message</h2><p class="s2">Takes about a minute. Fields marked optional can be skipped.</p>
<div class="hp" aria-hidden="true"><label>Leave empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
<div class="row2"><div class="f"><label for="c-name">Your name</label><input class="in" id="c-name" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name" placeholder="Sarah Khan"><span class="err"></span></div>
<div class="f"><label for="c-email">Your email</label><input class="in" id="c-email" name="email" value="{{ old('email') }}" type="email" required maxlength="150" autocomplete="email" placeholder="you@business.com"><span class="err"></span></div></div>
<div class="row2"><div class="f"><label for="c-phone">Phone or WhatsApp <small>(optional)</small></label><input class="in" id="c-phone" name="phone" value="{{ old('phone') }}" type="tel" maxlength="30" autocomplete="tel" placeholder="+61 4XX XXX XXX"></div>
<div class="f"><label for="c-svc">What do you need? <small>(optional)</small></label><select class="in" id="c-svc" name="service"><option value="">Choose a service</option><option>Website design &amp; development</option><option>Web &amp; mobile applications</option><option>Cyber security</option><option>AI &amp; automation</option><option>UI/UX &amp; brand design</option><option>Digital marketing &amp; SEO</option><option>Hosting, cloud &amp; maintenance</option><option>Our Innovation (coming soon)</option><option>Something else</option></select></div></div>
<fieldset class="f"><legend>Where is your business?</legend><div class="seg" role="radiogroup">
<label><input type="radio" name="country" value="Australia" checked><span>🇦🇺 Australia</span></label>
<label><input type="radio" name="country" value="Bangladesh"><span>🇧🇩 Bangladesh</span></label>
<label><input type="radio" name="country" value="Other"><span>🌏 Other</span></label></div></fieldset>
<fieldset class="f"><legend>Budget <small>(optional — helps us suggest the right plan)</small></legend><div class="chips2" id="budget"></div></fieldset>
<div class="f"><label for="c-msg">Tell us about your project</label><textarea class="in ta" id="c-msg" name="message" required minlength="10" maxlength="5000" placeholder="What does your business do, and what would you like your website or app to achieve?">{{ old('message') }}</textarea><span class="err"></span></div>
<button class="btn btn-pri send" type="submit" style="border:0;cursor:pointer;font:inherit;font-weight:600">Send message <i>→</i></button>
<div class="fine2"><span>Reply within 1 working day</span><span>No spam</span><span>No obligation</span></div>
</form>
<div class="side2">
<div class="card next"><h3>What happens next</h3><div class="nx">
<div><b>1</b><p><strong>We read your message</strong>A real person replies within one working day.</p></div>
<div><b>2</b><p><strong>We talk it through</strong>A quick call or WhatsApp chat to understand your goals.</p></div>
<div><b>3</b><p><strong>You get a fixed quote</strong>Clear scope, clear price — no surprises later.</p></div>
</div></div>
<div class="card" style="padding:22px 24px"><h3 style="font-size:18px;font-weight:700">Prefer to chat?</h3><p style="color:var(--muted);font-size:15px;margin:6px 0 14px">Message us on WhatsApp and we'll pick it up from there.</p><a class="btn btn-sec" href="https://wa.me/61422757090">Chat on WhatsApp</a></div>
</div>
</div></section>

<section class="ct-visit"><div class="wrap">
<div class="head"><div><div class="label">Visit or reach us</div><h2>Based in Dhaka. Working worldwide.</h2></div></div>
<div class="vgrid">
<div class="map"><svg viewBox="0 0 600 340" preserveAspectRatio="xMidYMid slice" aria-hidden="true"><rect width="600" height="340" fill="#102349"/><g stroke="#1d3566" stroke-width="10" fill="none"><path d="M0 170 C150 150 300 190 600 160"/><path d="M310 0 C300 120 330 220 300 340"/><path d="M60 40 C200 110 380 90 560 30"/><path d="M80 300 C220 240 400 260 560 310"/></g><g stroke="#163058" stroke-width="4" fill="none"><path d="M0 90 L600 110"/><path d="M0 250 L600 230"/><path d="M180 0 L200 340"/><path d="M450 0 L430 340"/></g></svg><span class="pin">e-Trust · Moghbazar</span></div>
<div class="vcards">
<div class="vc"><span class="fl">🇧🇩 Dhaka office</span><h3>250/1, Nowatola, Moghbazar</h3><p>Dhaka-1217, Bangladesh · Sat – Thu, 10 am – 7 pm</p><a class="btn btn-pri" href="https://www.google.com/maps/search/?api=1&amp;query=250%2F1+Nowatola+Moghbazar+Dhaka+1217" target="_blank" rel="noopener">Open in Google Maps <i>→</i></a></div>
<div class="vc"><span class="fl">🌏 Clients worldwide</span><h3>Sydney &amp; beyond</h3><p>We work with clients in Australia and around the world online. Sydney: WhatsApp 7 days, 10 am – 4 pm.</p></div>
</div></div>
</div></section>

<section class="ct-faq"><div class="wrap">
<div><div class="label">FAQ</div><h2>Before you get in touch</h2></div>
<div class="faq">
<details open><summary>How quickly will you reply?</summary><p>Within one working day. Sydney clients on WhatsApp usually hear back the same day between 10 am and 4 pm.</p></details>
<details><summary>Can I work with you from Sydney or overseas?</summary><p>Yes. We already build and maintain websites for Sydney businesses. Everything happens by email, WhatsApp and video call.</p></details>
<details><summary>Can we talk before I commit?</summary><p>Of course. We'll have a quick call or chat first, understand what you need, and only then send a fixed quote.</p></details>
</div></div></section>
@endsection
@push('scripts')
<script type="importmap">{"imports":{"three":"{{ asset('js/vendor/three/three.module.min.js') }}","three/addons/":"{{ asset('js/vendor/three/addons') }}/"}}</script>
<script type="module" src="{{ asset('js/contact-phone.js') }}?v={{ config('etrust.asset_version') }}"></script>
<script>
(function(){
var B={Australia:['Under $1,500','$1,500 – $4,000','$4,000 – $10,000','$10,000+','Not sure yet'],
Bangladesh:['Under ৳30k','৳30k – ৳80k','৳80k – ৳2 lakh','৳2 lakh+','Not sure yet']};
B.Other=B.Australia;
var box=document.getElementById('budget');
function render(c){box.innerHTML=B[c].map(function(v,i){return '<label><input type="radio" name="budget" value="'+v+'"'+(i===4?' checked':'')+'><span>'+v+'</span></label>'}).join('')}
document.querySelectorAll('input[name=country]').forEach(function(r){r.addEventListener('change',function(){render(r.value)})});
render('Australia');
var f=document.getElementById('cform');
function err(el,msg){var e=el.parentNode.querySelector('.err');el.classList.toggle('bad',!!msg);if(e)e.textContent=msg||''}
['c-name','c-email','c-msg'].forEach(function(id){document.getElementById(id).addEventListener('input',function(){err(this,'')})});
var F=function(n){return f.elements[n]};
f.addEventListener('submit',function(e){
var n=F('name').value.trim(),m=F('email').value.trim(),t=F('message').value.trim(),okv=true;
if(!n){err(F('name'),'Enter your name');okv=false}
if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(m)){err(F('email'),'Enter a valid email address');okv=false}
if(t.length<10){err(F('message'),'Tell us a little more (at least 10 characters)');okv=false}
if(!okv){e.preventDefault();return}
f.querySelector('.send').disabled=true;});
var SV={web:'Website design & development',apps:'Web & mobile applications',security:'Cyber security',ai:'AI & automation',design:'UI/UX & brand design',seo:'Digital marketing & SEO',hosting:'Hosting, cloud & maintenance'};
var q=new URLSearchParams(location.search),p=q.get('service'),old=@json(old('service'));p=old||SV[p]||p;
if(p){var o=[].find.call(F('service').options,function(o){return o.text===p});if(o)o.selected=true}
if(q.get('subject')==='feedback'&&!F('message').value)F('message').value='Feedback: ';
})();
</script>
@endpush
