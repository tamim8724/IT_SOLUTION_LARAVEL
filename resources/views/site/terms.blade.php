@extends('layouts.site')
@section('title', 'Terms of Service | e-Trust')
@section('description', 'The terms for using e-trust.online, our free AI assistant and website audit, and for working with e-Trust on websites, apps and AI projects.')
@section('page', 'terms')
@section('page_css', 'terms')
@section('body_class', 'light-legal legal')
@section('content')
<style>
.pp-hero{padding:60px 0 30px}
.pp-hero h1{font-family:"Inter Display",Inter,sans-serif;font-weight:800;letter-spacing:-.03em;line-height:1.04;font-size:clamp(40px,5.4vw,64px);margin:10px 0 16px;color:var(--ink)}
.pp-hero h1 em{font-style:normal;color:var(--mint)}
.pp-hero p.lead{color:var(--muted);font-size:18px;line-height:1.6;max-width:62ch;margin:0}
.pp-meta{display:flex;flex-wrap:wrap;gap:10px 22px;align-items:center;margin-top:24px;font-size:14px;color:var(--muted)}
.pp-meta b{color:var(--ink);font-weight:600}
.pp-acts{display:flex;gap:10px;flex-wrap:wrap;margin-top:24px}
.pp-btn{display:inline-flex;align-items:center;gap:8px;font:inherit;font-weight:700;font-size:14.5px;padding:11px 18px;border-radius:999px;border:1px solid var(--line);background:var(--navy2);color:var(--ink);cursor:pointer;text-decoration:none}
.pp-btn.pri{background:var(--mint);border-color:var(--mint);color:#0B1B3A}
html[data-theme=light] .pp-btn.pri{color:#fff}
.pp-btn:hover{border-color:var(--mint)}
.pp-glance{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin:40px 0 10px}
.pp-glance div{background:var(--navy2);border:1px solid var(--line);border-radius:18px;padding:20px}
.pp-glance b{display:grid;place-items:center;width:38px;height:38px;border-radius:11px;background:rgba(43,207,143,.14);color:var(--mint);font-size:17px;margin-bottom:12px}
.pp-glance h3{margin:0 0 5px;font-size:16px;color:var(--ink)}
.pp-glance p{margin:0;color:var(--muted);font-size:14.5px;line-height:1.55}
.pp-body{display:grid;grid-template-columns:250px minmax(0,1fr);gap:56px;padding-top:40px;padding-bottom:90px;border-top:1px solid var(--line);margin-top:40px}
.pp-toc{position:sticky;top:96px;align-self:start;max-height:calc(100vh - 120px);overflow:auto}
.pp-toc small{display:block;font-size:12px;letter-spacing:.12em;text-transform:uppercase;color:var(--mint);font-weight:700;margin-bottom:12px}
.pp-toc ol{list-style:none;margin:0;padding:0;counter-reset:t}
.pp-toc li{counter-increment:t}
.pp-toc a{display:flex;gap:10px;padding:6px 10px;border-radius:8px;color:var(--muted);font-size:14px;line-height:1.4;text-decoration:none;border-left:2px solid transparent}
.pp-toc a::before{content:counter(t,decimal-leading-zero);font-variant-numeric:tabular-nums;opacity:.6;font-size:12px;padding-top:1px}
.pp-toc a:hover{color:var(--ink)}
.pp-toc a.on{color:var(--ink);background:var(--navy2);border-left-color:var(--mint);border-radius:0 8px 8px 0}
.pp-doc{max-width:760px;counter-reset:s}
.pp-doc section{padding:8px 0 30px;scroll-margin-top:96px;counter-increment:s}
.pp-doc h2{font-family:"Inter Display",Inter,sans-serif;font-size:26px;letter-spacing:-.02em;line-height:1.2;margin:18px 0 12px;color:var(--ink)}
.pp-doc h2::before{content:counter(s) ". ";color:var(--mint)}
.pp-doc h3{font-size:17px;margin:22px 0 8px;color:var(--ink)}
.pp-doc p,.pp-doc li{color:var(--ink);opacity:.92;font-size:16px;line-height:1.75}
.pp-doc p{margin:0 0 14px}
.pp-doc ul{margin:0 0 14px;padding-left:1.2em}
.pp-doc li{margin:4px 0}
.pp-doc a{color:var(--mint);text-underline-offset:3px}
.pp-doc .sum{background:var(--navy2);border:1px solid var(--line);border-left:3px solid var(--mint);border-radius:0 14px 14px 0;padding:14px 18px;margin:0 0 18px;font-size:15.5px;color:var(--ink)}
.pp-doc .sum b{color:var(--mint);font-size:12px;letter-spacing:.1em;text-transform:uppercase;display:block;margin-bottom:4px}
.pp-tbl{width:100%;border-collapse:separate;border-spacing:0;margin:6px 0 18px;font-size:14.5px;border:1px solid var(--line);border-radius:14px;overflow:hidden}
.pp-tbl th,.pp-tbl td{text-align:left;vertical-align:top;padding:12px 14px;border-bottom:1px solid var(--line);line-height:1.55;color:var(--ink)}
.pp-tbl th{background:var(--navy2);font-size:12.5px;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);font-weight:700}
.pp-tbl tr:last-child td{border-bottom:0}
.pp-tbl td:first-child{font-weight:600;width:28%}
.pp-contact{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:10px}
.pp-contact div{background:var(--navy2);border:1px solid var(--line);border-radius:16px;padding:18px}
.pp-contact h3{margin:0 0 6px!important}
.pp-contact p{margin:0!important;font-size:15px!important}
@@media (max-width:980px){.pp-body{grid-template-columns:1fr;gap:20px}.pp-toc{position:static;max-height:none;background:var(--navy2);border:1px solid var(--line);border-radius:16px;padding:16px}.pp-glance{grid-template-columns:1fr 1fr}}
@@media (max-width:620px){.pp-hero{padding:36px 0 20px}.pp-hero p.lead{font-size:16.5px}.pp-glance{grid-template-columns:1fr}.pp-contact{grid-template-columns:1fr}
.pp-tbl,.pp-tbl tbody,.pp-tbl tr,.pp-tbl td{display:block;width:auto!important}.pp-tbl thead{display:none}.pp-tbl tr{border-bottom:1px solid var(--line);padding:10px 4px}.pp-tbl tr:last-child{border-bottom:0}.pp-tbl td{border:0;padding:4px 12px}.pp-tbl td:first-child{color:var(--mint)}
.pp-doc h2{font-size:22px}}
@@media print{
  @@page{margin:18mm 16mm}
  html,body,body.navy.ai-page{background:#fff!important;color:#111!important}
  body *{color:#111!important;background:transparent!important;box-shadow:none!important}
  .nav,.cf,footer,.fab,.etc-wrap,.pp-acts,.pp-toc,.pp-glance{display:none!important}
  .pp-hero{padding:0 0 10px}.pp-hero h1{font-size:30px}.pp-body{display:block;padding-top:0;padding-bottom:0;margin:0;border:0}
  .pp-doc{max-width:none}.pp-doc a{color:#111!important;text-decoration:underline}
  .pp-doc .sum{border:1px solid #bbb!important;border-left:3px solid #1DA673!important}
  .pp-tbl th,.pp-tbl td{border-color:#ccc!important}.pp-tbl{border-color:#ccc!important}
  .pp-doc section{break-inside:auto}.pp-doc h2{break-after:avoid}
}
</style>

<section class="pp-hero"><div class="wrap">
  <div class="label">Legal</div>
  <h1>Terms of Service.<br><em>Fair and clear.</em></h1>
  <p class="lead">These terms explain the rules for using e-trust.online, our free AI assistant and free website audit, and the general terms for working with us. We've written them to be fair to both sides — a summary comes first in every section.</p>
  <div class="pp-meta"><span>Last updated: <b>10 November 2026</b></span><span>Applies to: <b>e-trust.online and our services</b></span><span>Version <b>1.0</b></span></div>
  <div class="pp-acts">
    <a class="pp-btn pri" href="{{ asset('docs/e-Trust-Terms-of-Service.pdf') }}" download>Download PDF</a>
    <button class="pp-btn" type="button" onclick="window.print()">Print</button>
    <a class="pp-btn" href="mailto:info@e-trust.online?subject=Question%20about%20your%20terms">Ask a question</a>
  </div>

  <div class="pp-glance" aria-label="Terms at a glance">
    <div><b aria-hidden="true">✓</b><h3>Your proposal comes first</h3><p>For paid projects, the proposal we both agree on sets the scope, price and timeline.</p></div>
    <div><b aria-hidden="true">©</b><h3>You own your website</h3><p>Once it's paid for, the custom work we create for you is yours.</p></div>
    <div><b aria-hidden="true">↺</b><h3>Fair cancellation</h3><p>Either side can end a project in writing. You only pay for work already done.</p></div>
    <div><b aria-hidden="true">AI</b><h3>AI is a helper, not advice</h3><p>The free AI assistant can make mistakes and never commits us to a price.</p></div>
    <div><b aria-hidden="true">⚖</b><h3>Your consumer rights stay</h3><p>Nothing here removes rights you have under consumer law in Australia or elsewhere.</p></div>
    <div><b aria-hidden="true">@@</b><h3>Talk to us first</h3><p>If something goes wrong, email us and we'll work in good faith to fix it.</p></div>
  </div>
</div></section>

<div class="wrap pp-body">
  <nav class="pp-toc" aria-label="On this page"><small>On this page</small><ol>
    <li><a href="#about">About these terms</a></li>
    <li><a href="#site">Using our website</a></li>
    <li><a href="#ai">Our AI assistant</a></li>
    <li><a href="#audit">Free website audit</a></li>
    <li><a href="#quotes">Quotes and proposals</a></li>
    <li><a href="#pay">Payments</a></li>
    <li><a href="#yours">Your part in a project</a></li>
    <li><a href="#ip">Who owns the work</a></li>
    <li><a href="#third">Hosting and third-party services</a></li>
    <li><a href="#cancel">Cancelling a project</a></li>
    <li><a href="#acl">Consumer guarantees</a></li>
    <li><a href="#liability">Limits of our liability</a></li>
    <li><a href="#links">Links to other sites</a></li>
    <li><a href="#changes">Changes to these terms</a></li>
    <li><a href="#law">Disputes and governing law</a></li>
    <li><a href="#general">General</a></li>
    <li><a href="#contact">Contact us</a></li>
  </ol></nav>

  <article class="pp-doc">

  <section id="about"><h2>About these terms</h2>
    <div class="sum"><b>In short</b>By using our website or services, you agree to these terms. For paid work, your signed proposal also applies.</div>
    <p>These Terms of Service ("terms") are an agreement between you and e-Trust IT Solutions ("e-Trust", "we", "us") of 250/1, Nowatola, Moghbazar, Dhaka-1217, Bangladesh. They apply when you use e-trust.online, our free AI assistant or free website audit, and when you buy services from us such as website design and development, apps, AI assistants, SEO, hosting and maintenance.</p>
    <p>For paid projects, we'll also agree a written proposal, quote or contract with you (a "proposal"). If the proposal says something different from these terms, the proposal wins. Our <a href="{{ url('/privacy') }}">Privacy Policy</a> explains how we handle personal information.</p>
    <p>If you use our website or services on behalf of a business, you confirm you're allowed to agree to these terms for that business.</p>
  </section>

  <section id="site"><h2>Using our website</h2>
    <div class="sum"><b>In short</b>Use the site normally and honestly. Don't misuse it or try to break it.</div>
    <p>You may browse and use our website for your own personal or business purposes. You agree not to:</p>
    <ul>
      <li>break the law, or use the site to deceive, harass or harm anyone;</li>
      <li>try to hack, overload, scan for weaknesses or interfere with the website or its servers;</li>
      <li>send spam, false information or automated submissions through our forms or chat;</li>
      <li>copy large parts of the site, or our designs, text and images, without our permission;</li>
      <li>pretend to be someone else or to be connected with e-Trust when you're not.</li>
    </ul>
    <p>We work hard to keep the site accurate and online, but we can't promise it will always be available or error-free. We may change or remove parts of it at any time. Information on the site is general and isn't a quote or an offer — prices and timelines are only confirmed in a proposal.</p>
  </section>

  <section id="ai"><h2>Our AI assistant</h2>
    <div class="sum"><b>In short</b>It's free and helpful, but it can be wrong. Don't rely on it for important decisions, and don't use it for anything harmful.</div>
    <ul>
      <li><strong>Free with fair-use limits.</strong> The AI assistant is free. To keep it fast for everyone, there are limits on how many messages you can send, and we may change or pause it at any time.</li>
      <li><strong>Answers can be wrong.</strong> Answers are created automatically by third-party AI models. They may be incomplete, out of date or incorrect, and they aren't legal, medical, financial or other professional advice. Check anything important with a qualified person.</li>
      <li><strong>No promises from the AI.</strong> The AI can't make offers, quotes, discounts or commitments for e-Trust. Only a proposal from our team can.</li>
      <li><strong>Use it responsibly.</strong> Don't use the assistant for anything illegal, harmful or unethical, such as hacking, scams, harassment or creating misleading content. It is designed to refuse these requests, and we may block access if it's misused.</li>
      <li><strong>Your content.</strong> You're responsible for what you type and how you use the answers. Don't share passwords, bank details or other private information in the chat.</li>
    </ul>
  </section>

  <section id="audit"><h2>Free website audit</h2>
    <div class="sum"><b>In short</b>Free, with no obligation to buy anything. It's our honest opinion, not a guarantee.</div>
    <p>Our free website audit looks at the public pages of the website you give us and shares our findings and suggestions by email. You must own the website or have permission to ask for an audit. There's no charge and no obligation to hire us afterwards.</p>
    <p>The audit is based on what we can see at the time and on our professional judgement. It isn't a full security test, and we can't guarantee specific results such as rankings, traffic or sales. We may decline an audit request, for example if we can't reach the website or the request seems to be spam.</p>
  </section>

  <section id="quotes"><h2>Quotes and proposals</h2>
    <div class="sum"><b>In short</b>We agree the scope, price and timeline in writing before we start. Changes are agreed in writing too.</div>
    <ul>
      <li>Before starting paid work, we send a proposal that sets out what we'll deliver, the price, the payment schedule and the expected timeline.</li>
      <li>Unless the proposal says otherwise, a quote is valid for 30 days.</li>
      <li>A project starts once you accept the proposal in writing (email is fine) and pay any upfront amount it asks for.</li>
      <li>If you'd like to add or change something after we start, we'll tell you how it affects the price and timeline, and we'll only go ahead once you agree in writing.</li>
      <li>Timelines are our honest estimate. If we expect a delay, we'll tell you as early as we can.</li>
    </ul>
  </section>

  <section id="pay"><h2>Payments</h2>
    <div class="sum"><b>In short</b>You pay as set out in your proposal. Third-party costs like domains are separate unless we say otherwise.</div>
    <ul>
      <li>Prices are in Bangladeshi Taka (BDT) or Australian Dollars (AUD), as shown in your proposal. Taxes such as VAT or GST are added where the law requires, and we'll show them clearly.</li>
      <li>Payments are due as set out in the proposal, which may include an upfront deposit and payments at agreed milestones. Invoices are due within 14 days unless the proposal says otherwise.</li>
      <li>Costs of third-party services — such as domain names, hosting, paid plugins, fonts, stock images, AI or email services — are paid by you, either directly or through us at the price we tell you in advance.</li>
      <li>If a payment is late, we'll remind you first. If it's still unpaid after a reasonable time, we may pause work until it's paid. We won't take your website offline over a payment issue without giving you written notice first.</li>
    </ul>
  </section>

  <section id="yours"><h2>Your part in a project</h2>
    <div class="sum"><b>In short</b>Good websites need teamwork. Send content and feedback on time, and only send content you're allowed to use.</div>
    <ul>
      <li>Provide the content, logins, information and feedback we need, within the times we agree.</li>
      <li>Make sure you own, or have permission to use, the text, images, logos and other material you give us, and that it's lawful.</li>
      <li>Review and approve work at each stage. Once you approve a stage, further changes to it may count as a change of scope.</li>
      <li>If we're waiting on you, the timeline moves by the same amount. If a project is on hold for more than 60 days because we're waiting on you, we may treat it as finished and invoice the work done so far, after giving you notice.</li>
    </ul>
  </section>

  <section id="ip"><h2>Who owns the work</h2>
    <div class="sum"><b>In short</b>Once you've paid in full, you own the custom work we made for you. We keep our own tools, and third-party items stay under their own licences.</div>
    <ul>
      <li><strong>Your deliverables:</strong> when you've paid for a project in full, you own the custom designs, code, text and other work we created specifically for you.</li>
      <li><strong>Our tools:</strong> we keep ownership of our own pre-existing code, templates, libraries and know-how. Where these are part of your project, you receive a permanent licence to use them as part of your website or app.</li>
      <li><strong>Third-party items:</strong> open-source software, themes, plugins, fonts, images and services we use remain under their own licences, which you agree to follow.</li>
      <li><strong>Your content:</strong> you keep ownership of everything you give us. You allow us to use it only to do your project.</li>
      <li><strong>Our portfolio:</strong> with your permission, we may show the finished work in our portfolio. We'll never share your confidential information.</li>
    </ul>
  </section>

  <section id="third"><h2>Hosting and third-party services</h2>
    <div class="sum"><b>In short</b>We choose reliable providers and look after them carefully, but we can't control their outages.</div>
    <p>Websites and apps depend on services run by other companies, such as hosting, domain registrars, email, payment gateways, maps and AI providers. Their own terms apply, and we can't guarantee they'll always be available. If you have a hosting or maintenance plan with us, we'll monitor your site, keep it updated and act quickly when there's a problem, as described in your plan.</p>
    <p>Unless your plan says otherwise, you're responsible for keeping your domain name renewed and for the content you publish on your website after it goes live.</p>
  </section>

  <section id="cancel"><h2>Cancelling a project</h2>
    <div class="sum"><b>In short</b>Either of us can end a project in writing. You pay for work done so far and get anything unused back.</div>
    <ul>
      <li>You can end a project at any time by telling us in writing. You'll pay for the work completed up to that date and any third-party costs we've already paid for you. If you've paid more than that, we'll refund the difference within 14 days.</li>
      <li>We can end a project in writing if you seriously breach these terms or the proposal and don't fix it within 14 days of our notice, or if we can't continue for reasons outside our control. If we end a project without fault on your side, we'll refund any amount paid for work we haven't done.</li>
      <li>When a project ends, we'll hand over the completed work you've paid for.</li>
    </ul>
  </section>

  <section id="acl"><h2>Consumer guarantees</h2>
    <div class="sum"><b>In short</b>We do our work with care and skill. If you're a consumer, the law gives you rights we can't take away.</div>
    <p>We provide our services with due care and skill, and we'll fix problems caused by our work that you tell us about within 30 days of launch, at no extra cost.</p>
    <p><strong>Australia:</strong> if you're a consumer or small business under the Australian Consumer Law, our services come with guarantees that can't be excluded. For a major failure with a service, you're entitled to cancel the contract and receive a refund for the unused portion, or compensation for its reduced value. You're also entitled to compensation for other reasonably foreseeable loss or damage. If the failure isn't major, you're entitled to have it fixed within a reasonable time, and if that doesn't happen, to cancel and get a refund for the unused portion.</p>
    <p><strong>Bangladesh and elsewhere:</strong> you keep any rights you have under the Consumer Rights Protection Act, 2009 and other laws that apply to you.</p>
    <p>Nothing in these terms excludes, restricts or changes any right or remedy that the law says can't be excluded.</p>
  </section>

  <section id="liability"><h2>Limits of our liability</h2>
    <div class="sum"><b>In short</b>We take responsibility for our work, within fair limits. These limits never override your consumer rights.</div>
    <p>To the extent the law allows, and except for the rights in <a href="#acl">section 11</a>:</p>
    <ul>
      <li>we're not responsible for indirect or consequential loss, such as lost profits, lost revenue or lost data, that wasn't a reasonably foreseeable result of our failure;</li>
      <li>we're not responsible for problems caused by third-party services, by changes made to your website by you or others, or by events outside our reasonable control such as natural disasters, power or internet outages, or cyber attacks on providers;</li>
      <li>our total liability for a project is limited to the amount you paid us for that project in the 12 months before the claim.</li>
    </ul>
    <p>These limits don't apply to liability for fraud, for death or personal injury caused by negligence, or for anything else the law doesn't allow us to limit. The free AI assistant and free audit are provided "as is", to the extent the law allows.</p>
  </section>

  <section id="links"><h2>Links to other sites</h2>
    <div class="sum"><b>In short</b>Other websites have their own terms.</div>
    <p>Our website links to other sites, such as client projects, WhatsApp and Facebook. We aren't responsible for their content or practices, and their own terms apply.</p>
  </section>

  <section id="changes"><h2>Changes to these terms</h2>
    <div class="sum"><b>In short</b>We'll update the date when we change anything. Changes don't affect a project already agreed.</div>
    <p>We may update these terms from time to time. The "Last updated" date shows the latest version. Changes apply from the date they're published and don't change the terms of a proposal you've already accepted, unless we both agree in writing.</p>
  </section>

  <section id="law"><h2>Disputes and governing law</h2>
    <div class="sum"><b>In short</b>Let's talk first. If we can't agree, Bangladesh law applies, but you keep the protections of your local consumer law.</div>
    <p>If you're unhappy with anything, please email us first. We'll respond within 7 days and both of us will try in good faith to solve the problem within 30 days, including through mediation if we both agree.</p>
    <p>These terms are governed by the laws of Bangladesh, and the courts of Dhaka can hear any dispute. However, if you're a consumer in Australia or another country, you keep the protection of the mandatory consumer laws of where you live, and you may bring a claim in your local courts.</p>
  </section>

  <section id="general"><h2>General</h2>
    <ul>
      <li>These terms, together with any proposal and our Privacy Policy, are the whole agreement between us about their subject.</li>
      <li>If a court finds any part of these terms invalid, the rest still applies.</li>
      <li>If we don't enforce a right straight away, we haven't given it up.</li>
      <li>You can't transfer your rights under these terms to someone else without our written consent. We may transfer ours to a business that takes over our services, and we'll tell you if that happens.</li>
      <li>Notices can be sent by email to the address each of us has used for the project.</li>
    </ul>
  </section>

  <section id="contact"><h2>Contact us</h2>
    <div class="sum"><b>In short</b>Questions about these terms? We're happy to explain anything.</div>
    <div class="pp-contact">
      <div><h3>e-Trust IT Solutions</h3><p>250/1, Nowatola, Moghbazar, Dhaka-1217, Bangladesh<br><a href="mailto:info@e-trust.online">info@e-trust.online</a><br>+880 1960 013601</p></div>
      <div><h3>Sydney</h3><p>WhatsApp only: +61 422 757 090<br>7 days, 10 am – 4 pm (Sydney time)<br><a href="mailto:info@e-trust.online">info@e-trust.online</a></p></div>
    </div>
  </section>

  </article>
</div>


@endsection
@push('scripts')
<script>
(function(){var links=[].slice.call(document.querySelectorAll('.pp-toc a'));if(!('IntersectionObserver' in window))return;
var map={};links.forEach(function(a){map[a.getAttribute('href').slice(1)]=a});
var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){links.forEach(function(l){l.classList.remove('on')});var a=map[e.target.id];if(a)a.classList.add('on')}})},{rootMargin:'-20% 0px -70% 0px'});
document.querySelectorAll('.pp-doc section').forEach(function(s){io.observe(s)});})();
</script>
@endpush
