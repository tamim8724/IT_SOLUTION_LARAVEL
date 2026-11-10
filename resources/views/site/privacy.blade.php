@extends('layouts.site')
@section('title', 'Privacy Policy | e-Trust')
@section('description', 'How e-Trust collects, uses and protects personal information on e-trust.online, including our contact forms and AI assistant.')
@section('page', 'privacy')
@section('page_css', 'privacy')
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
  <h1>Privacy Policy.<br><em>In plain words.</em></h1>
  <p class="lead">This policy explains what personal information e-Trust collects through e-trust.online, why we collect it, who we share it with and the choices you have. We've kept it short and clear — a summary comes first in every section.</p>
  <div class="pp-meta"><span>Last updated: <b>10 November 2026</b></span><span>Applies to: <b>e-trust.online</b></span><span>Version <b>1.0</b></span></div>
  <div class="pp-acts">
    <a class="pp-btn pri" href="{{ asset('docs/e-Trust-Privacy-Policy.pdf') }}" download>Download PDF</a>
    <button class="pp-btn" type="button" onclick="window.print()">Print</button>
    <a class="pp-btn" href="mailto:info@e-trust.online?subject=Privacy%20request">Email a privacy request</a>
  </div>

  <div class="pp-glance" aria-label="Privacy at a glance">
    <div><b aria-hidden="true">✕</b><h3>We never sell your data</h3><p>Not to advertisers, not to data brokers, not to anyone.</p></div>
    <div><b aria-hidden="true">◎</b><h3>No ads, no tracking</h3><p>No advertising or analytics cookies. Only what the site needs to work.</p></div>
    <div><b aria-hidden="true">✓</b><h3>Only what we need</h3><p>We collect what you give us to answer you, and nothing hidden.</p></div>
    <div><b aria-hidden="true">AI</b><h3>AI chats aren't stored</h3><p>Chats stay in your browser tab. We only keep details you choose to send us.</p></div>
    <div><b aria-hidden="true">↺</b><h3>You're in control</h3><p>Ask to see, correct or delete your information at any time.</p></div>
    <div><b aria-hidden="true">@@</b><h3>A real person replies</h3><p>Email info@e-trust.online and our team answers within 30 days.</p></div>
  </div>
</div></section>

<div class="wrap pp-body">
  <nav class="pp-toc" aria-label="On this page"><small>On this page</small><ol>
    <li><a href="#who">Who we are</a></li>
    <li><a href="#scope">What this policy covers</a></li>
    <li><a href="#collect">Information we collect</a></li>
    <li><a href="#use">How we use it</a></li>
    <li><a href="#ai">Our AI assistant</a></li>
    <li><a href="#share">Who we share it with</a></li>
    <li><a href="#transfer">International transfers</a></li>
    <li><a href="#cookies">Cookies and browser storage</a></li>
    <li><a href="#keep">How long we keep it</a></li>
    <li><a href="#protect">How we protect it</a></li>
    <li><a href="#rights">Your rights</a></li>
    <li><a href="#children">Children</a></li>
    <li><a href="#clients">Data in client projects</a></li>
    <li><a href="#other">Other websites</a></li>
    <li><a href="#changes">Changes to this policy</a></li>
    <li><a href="#contact">Contact and complaints</a></li>
  </ol></nav>

  <article class="pp-doc">

  <section id="who"><h2>Who we are</h2>
    <div class="sum"><b>In short</b>e-Trust is an IT company in Dhaka that also works with clients in Australia. We are responsible for the information collected on this website.</div>
    <p>e-Trust IT Solutions ("e-Trust", "we", "us") is a web design and development company based at 250/1, Nowatola, Moghbazar, Dhaka-1217, Bangladesh, serving businesses in Bangladesh, Australia and other countries. We decide how personal information collected through e-trust.online is used, so we are responsible for it (the "data controller" or "data fiduciary").</p>
    <p>You can contact us about privacy at any time at <a href="mailto:info@e-trust.online">info@e-trust.online</a>.</p>
  </section>

  <section id="scope"><h2>What this policy covers</h2>
    <div class="sum"><b>In short</b>This website, our forms, our AI assistant and the emails and messages you send us.</div>
    <p>This policy applies to personal information we collect when you visit e-trust.online, fill in a form, use our AI assistant, request a free website audit, or contact us by email or WhatsApp. It does not cover websites or apps we build for clients (see <a href="#clients">section 13</a>).</p>
    <p>We follow the Personal Data Protection Act, 2026 of Bangladesh and, for people in Australia, the Australian Privacy Principles in the Privacy Act 1988 (Cth). Where the law of your country gives you more protection, we respect it.</p>
  </section>

  <section id="collect"><h2>Information we collect</h2>
    <div class="sum"><b>In short</b>Mostly what you type into our forms or chat. A small amount of technical data is created automatically when you visit.</div>
    <h3>Information you give us</h3>
    <table class="pp-tbl"><thead><tr><th>When</th><th>What we collect</th></tr></thead><tbody>
      <tr><td>Contact form</td><td>Name, email, phone or WhatsApp number (optional), the service you need, your country, budget range and your message.</td></tr>
      <tr><td>Free website audit</td><td>Name, email, your website address, where your business is and what matters most to you.</td></tr>
      <tr><td>AI assistant — "Talk to our team"</td><td>Name, email, mobile number and a short summary of the questions you asked in the chat, so our team understands what you need.</td></tr>
      <tr><td>Email code</td><td>A one-time 6-digit code we email you to confirm your address. We only keep a scrambled (hashed) copy for 10 minutes.</td></tr>
      <tr><td>Email and WhatsApp</td><td>Whatever you choose to send us, such as your name, number, messages, files and project details.</td></tr>
      <tr><td>Job applications</td><td>Your CV, contact details and any work samples you send.</td></tr>
    </tbody></table>
    <h3>Information collected automatically</h3>
    <ul>
      <li><strong>Technical data:</strong> your IP address, browser type, device and the page you visited, recorded in our server logs for security and to keep the site running.</li>
      <li><strong>Form source:</strong> the page you sent a form from and your IP address, saved with your enquiry to help stop spam.</li>
      <li><strong>Fair-use limits:</strong> to stop abuse of the free AI assistant, we count messages per visitor using a scrambled (hashed) form of your IP address and browser, kept for about a day.</li>
    </ul>
    <p>We don't use advertising trackers, analytics cookies, social media pixels or fingerprinting. We don't ask for sensitive information such as health, religion, financial account or national ID details — please don't send it in the forms or chat.</p>
  </section>

  <section id="use"><h2>How we use it</h2>
    <div class="sum"><b>In short</b>To reply to you, prepare quotes, deliver our work and keep the site safe. Never for advertising.</div>
    <ul>
      <li>To reply to your enquiry and send you a quote or proposal.</li>
      <li>To prepare and send the free website audit you asked for.</li>
      <li>To deliver, support and invoice the services you buy from us.</li>
      <li>To confirm your email address when you ask our team to contact you from the AI chat.</li>
      <li>To run the AI assistant and keep it fair for everyone (rate limits).</li>
      <li>To protect the website against spam, fraud and attacks.</li>
      <li>To meet our legal, tax and accounting obligations.</li>
    </ul>
    <p>We use your information because you asked us to (your consent), because we need it to take steps towards or perform a contract with you, or because the law requires it. You can withdraw your consent at any time by emailing us; this won't affect anything we did before.</p>
    <p>We only send you marketing emails if you've agreed to receive them, and every such email has an easy way to unsubscribe. We don't use automated decision-making that has legal or similarly significant effects on you.</p>
  </section>

  <section id="ai"><h2>Our AI assistant</h2>
    <div class="sum"><b>In short</b>Your chat is sent to an AI provider to get an answer, but it isn't saved on our servers. Don't share private information in the chat.</div>
    <ul>
      <li><strong>Where the chat lives:</strong> your conversation is kept only in your browser tab (session storage). Closing the tab or pressing "New chat" clears it. We don't store your chat history on our servers.</li>
      <li><strong>How answers are made:</strong> to answer you, the text of your recent messages is sent to one of the AI providers listed in <a href="#share">section 6</a>. We don't send your name, email or phone with it.</li>
      <li><strong>Provider policies:</strong> each provider handles data under its own terms. Some free AI services may keep prompts for a limited time or use them to improve their models, so treat the chat like a public conversation and don't include passwords, bank details or other private information.</li>
      <li><strong>Talking to our team:</strong> only if you choose to fill in the "Talk to our team" form do we store your name, email, mobile and a summary of the questions you asked, as an enquiry.</li>
      <li><strong>Accuracy:</strong> AI answers can be wrong. They are not professional advice, and they never commit e-Trust to a price or a promise.</li>
    </ul>
  </section>

  <section id="share"><h2>Who we share it with</h2>
    <div class="sum"><b>In short</b>Only with trusted service providers who help us run the site, and only what they need. We never sell your information.</div>
    <table class="pp-tbl"><thead><tr><th>Provider type</th><th>What and why</th></tr></thead><tbody>
      <tr><td>Website hosting</td><td>Render, which hosts our website.</td></tr>
      <tr><td>Database</td><td>MongoDB Atlas, which stores enquiries securely.</td></tr>
      <tr><td>Email delivery</td><td>Our email service, to send you replies, audit reports and the 6-digit email code.</td></tr>
      <tr><td>AI providers</td><td>Your chat messages (without your contact details) go to one of: Google (Gemini), Groq, Mistral AI, OpenRouter, Cloudflare, NVIDIA, Hetzner, Cohere or SambaNova. If one is busy, another answers.</td></tr>
            <tr><td>WhatsApp</td><td>If you message us on WhatsApp, Meta processes those messages under its own privacy policy.</td></tr>
    </tbody></table>
    <p>We may also share information if the law requires it, to protect our rights or the safety of others, or as part of a business sale or merger (in which case this policy will continue to apply). We may share information with professional advisers such as accountants and lawyers under a duty of confidentiality.</p>
  </section>

  <section id="transfer"><h2>International transfers</h2>
    <div class="sum"><b>In short</b>Our providers may store data outside Bangladesh and Australia. We use reputable providers with strong security.</div>
    <p>Our team works from Bangladesh, and our hosting, email and AI providers may store or process information in other countries, including the United States, the European Union and Singapore. When we transfer personal information across borders, we take reasonable steps to make sure it is protected to a standard similar to the laws that apply to you, as required by Bangladesh's Personal Data Protection Act, 2026 and Australian Privacy Principle 8.</p>
  </section>

  <section id="cookies"><h2>Cookies and browser storage</h2>
    <div class="sum"><b>In short</b>Only a few essential items so the site works. No advertising or analytics cookies, so there's no cookie banner.</div>
    <table class="pp-tbl"><thead><tr><th>Name</th><th>Purpose and duration</th></tr></thead><tbody>
      <tr><td>Session cookie</td><td>Keeps forms working securely while you browse. Deleted after about 2 hours of inactivity.</td></tr>
      <tr><td>XSRF-TOKEN cookie</td><td>Protects forms against cross-site request forgery. Same duration as the session.</td></tr>
      <tr><td>et-theme (local storage)</td><td>Remembers whether you chose light or dark mode. Stays until you clear it.</td></tr>
      <tr><td>et-chat (session storage)</td><td>Holds your AI chat in this tab. Deleted when you close the tab.</td></tr>
    </tbody></table>
    <p>You can block or delete cookies in your browser settings, but the forms may not work without the essential ones.</p>
  </section>

  <section id="keep"><h2>How long we keep it</h2>
    <div class="sum"><b>In short</b>Only as long as we need it, then we delete it or make it anonymous.</div>
    <table class="pp-tbl"><thead><tr><th>Information</th><th>How long</th></tr></thead><tbody>
      <tr><td>Enquiries that didn't become projects</td><td>Up to 24 months after our last contact, then deleted.</td></tr>
      <tr><td>Client records and invoices</td><td>As long as the law requires for tax and accounting (in Bangladesh, usually up to 6 years).</td></tr>
      <tr><td>Unconfirmed AI chat contact requests</td><td>Up to 12 months, then deleted.</td></tr>
      <tr><td>Email codes</td><td>10 minutes, then deleted.</td></tr>
      <tr><td>AI chat conversations</td><td>Not stored by us — only in your browser tab.</td></tr>
      <tr><td>Server logs and fair-use counters</td><td>Up to 30 days (counters about a day).</td></tr>
      <tr><td>Job applications</td><td>Up to 12 months, unless you ask us to delete them sooner.</td></tr>
    </tbody></table>
  </section>

  <section id="protect"><h2>How we protect it</h2>
    <div class="sum"><b>In short</b>Encryption, limited access and careful habits. No system is perfect, but we work hard to keep your data safe.</div>
    <ul>
      <li>The whole website uses HTTPS encryption.</li>
      <li>Enquiries are stored in a protected database. Only authorised team members can see them, using a password-protected admin area.</li>
      <li>API keys and passwords are kept on the server, never in your browser.</li>
      <li>Email codes are stored only in scrambled (hashed) form and expire quickly.</li>
      <li>Forms are protected against spam and repeated attempts.</li>
    </ul>
    <p>If a data breach is likely to cause you serious harm, we will tell you and the relevant authority as the law requires.</p>
  </section>

  <section id="rights"><h2>Your rights</h2>
    <div class="sum"><b>In short</b>You can ask to see, correct or delete your information, or withdraw your consent. Just email us.</div>
    <p>Depending on where you live, you have the right to:</p>
    <ul>
      <li><strong>Access</strong> the personal information we hold about you and get a copy.</li>
      <li><strong>Correct</strong> information that is wrong or out of date.</li>
      <li><strong>Delete</strong> your information when we no longer need it or you withdraw consent.</li>
      <li><strong>Withdraw consent</strong> or object to how we use your information, including marketing.</li>
      <li><strong>Deal with us anonymously</strong> or using a nickname where that's practical (for example, using the AI chat without giving your name).</li>
      <li><strong>Complain</strong> to us or to a regulator (see <a href="#contact">section 16</a>).</li>
    </ul>
    <p>To use any of these rights, email <a href="mailto:info@e-trust.online?subject=Privacy%20request">info@e-trust.online</a>. We may ask you to confirm your identity first. We reply within 30 days and don't charge for reasonable requests. If we can't do what you ask, we'll explain why.</p>
  </section>

  <section id="children"><h2>Children</h2>
    <div class="sum"><b>In short</b>Our services are for businesses and adults.</div>
    <p>Our website and services are meant for people aged 18 and over. Younger visitors may use the free AI assistant for things like study help, but shouldn't send us personal details through our forms without a parent or guardian. If you think a child has given us personal information, contact us and we'll delete it.</p>
  </section>

  <section id="clients"><h2>Data in client projects</h2>
    <div class="sum"><b>In short</b>When we build or run a website for a client, the client decides how their customers' data is used, and we follow their instructions.</div>
    <p>When we design, build, host or maintain websites, apps or AI assistants for clients, we may handle personal information of their customers or users. In that case our client is responsible for that information and their own privacy policy applies; we act as their service provider (the "data processor"), use the information only to provide our services, keep it confidential and secure, and delete or return it when the work ends.</p>
  </section>

  <section id="other"><h2>Other websites</h2>
    <div class="sum"><b>In short</b>Other websites have their own rules.</div>
    <p>Our website links to other sites, such as client projects, WhatsApp and Facebook. We are not responsible for their privacy practices, so please read their policies.</p>
  </section>

  <section id="changes"><h2>Changes to this policy</h2>
    <div class="sum"><b>In short</b>If we change anything important, we'll update the date at the top and tell you clearly.</div>
    <p>We may update this policy when our services or the law change. The "Last updated" date at the top shows when it last changed. If a change is significant, we'll show a notice on the website or email people who are affected.</p>
  </section>

  <section id="contact"><h2>Contact and complaints</h2>
    <div class="sum"><b>In short</b>Email us first — we'll try to fix it. You can also go to a regulator.</div>
    <p>If you have a question or complaint about privacy, please contact us first. We'll acknowledge it within 7 days and aim to resolve it within 30 days.</p>
    <div class="pp-contact">
      <div><h3>e-Trust IT Solutions</h3><p>250/1, Nowatola, Moghbazar, Dhaka-1217, Bangladesh<br><a href="mailto:info@e-trust.online">info@e-trust.online</a><br>+880 1960 013601</p></div>
      <div><h3>Not happy with our answer?</h3><p><strong>Australia:</strong> Office of the Australian Information Commissioner (OAIC), <a href="https://www.oaic.gov.au" rel="noopener" target="_blank">oaic.gov.au</a><br><strong>Bangladesh:</strong> the data protection authority under the Personal Data Protection Act, 2026<br><strong>Elsewhere:</strong> your local data protection authority</p></div>
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
