/* e-Trust AI chat — one script for the /assistant page and the floating chat button.
 * - Page mode: mounts into #etChat.
 * - Widget mode: any .fab (or [data-open-chat]) opens a small chat window.
 * - Talks to POST /api/chat; leads go to POST /api/lead and /api/lead/verify (email code).
 * - Without a server (static preview) it answers with short demo replies.
 * - The chat is kept only in this browser tab (sessionStorage).
 */
(function () {
  'use strict';
  var API = (window.ETRUST_API || '').replace(/\/$/, '');
  var STORE = 'et-chat-v1', THEME = 'et-theme';
  var CHIPS = [
    'Explain a topic for my exam',
    'Write a Facebook post for my shop',
    'Plan a small business idea',
    'Fix a coding error',
    'How do I stay safe from online scams?',
    'ব্যবসার জন্য ওয়েবসাইট কেন দরকার?'
  ];
  var preview = false;

  /* ---------- storage (may be blocked) ---------- */
  function sget(store, k) { try { return window[store].getItem(k); } catch (e) { return null; } }
  function sset(store, k, v) { try { window[store].setItem(k, v); } catch (e) {} }
  function sdel(store, k) { try { window[store].removeItem(k); } catch (e) {} }

  /* ---------- theme: saved choice > device setting > dark ---------- */
  function theme() {
    var t = sget('localStorage', THEME);
    if (t === 'light' || t === 'dark') return t;
    return window.matchMedia && matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
  }
  function applyTheme(t) {
    document.querySelectorAll('.etc').forEach(function (el) { el.setAttribute('data-theme', t); });
    if (document.body.classList.contains('ai-page')) document.documentElement.setAttribute('data-theme', t);
    document.querySelectorAll('.etc-theme').forEach(function (b) {
      b.setAttribute('aria-label', t === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
      b.innerHTML = t === 'dark' ? ICON.sun : ICON.moon;
    });
  }

  var ICON = {
    send: '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
    sun: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 3v2M12 19v2M3 12h2M19 12h2M5.6 5.6l1.4 1.4M17 17l1.4 1.4M5.6 18.4 7 17M17 7l1.4-1.4"/></svg>',
    moon: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z"/></svg>',
    plus: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>',
    x: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>',
    expand: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h6v6M10 20H4v-6M20 4l-7 7M4 20l7-7"/></svg>',
    chat: '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12z"/></svg>'
  };

  /* ---------- styles (injected once) ---------- */
  var CSS = '\
.etc{--c-bg:#111A2E;--c-panel:#152039;--c-bot:#1A2540;--c-me:#1F4D3E;--c-me-ink:#E3F3EC;--c-ink:#D7DEEA;--c-muted:#8C99B3;--c-line:#26334F;--c-field:#0D1526;--c-mint:#2BCF8F;--c-mint-ink:#0B1B3A;--c-link:#6FE0B4;--c-err:#F19A9A;\
font-family:Inter,system-ui,sans-serif;color:var(--c-ink);background:var(--c-panel);border:1px solid var(--c-line);border-radius:22px;display:flex;flex-direction:column;overflow:hidden}\
.etc[data-theme=light]{--c-bg:#F6F3EC;--c-panel:#FBF9F4;--c-bot:#FFFFFF;--c-me:#DDF1E8;--c-me-ink:#14402F;--c-ink:#26303F;--c-muted:#5D6675;--c-line:#E3DCCD;--c-field:#FFFFFF;--c-mint:#1DA673;--c-mint-ink:#FFFFFF;--c-link:#0F7A55;--c-err:#B23B3B}\
.etc *{box-sizing:border-box}\
.etc-head{display:flex;align-items:center;gap:12px;padding:14px 16px;border-bottom:1px solid var(--c-line)}\
.etc-av{width:38px;height:38px;border-radius:12px;background:var(--c-mint);color:var(--c-mint-ink);display:grid;place-items:center;font-weight:800;font-size:15px;flex:none}\
.etc-t{flex:1;min-width:0}.etc-t b{display:block;font-size:15px;color:var(--c-ink)}.etc-t small{display:flex;align-items:center;gap:6px;font-size:12.5px;color:var(--c-muted)}\
.etc-t small i{width:7px;height:7px;border-radius:50%;background:var(--c-mint)}\
.etc-ib{width:36px;height:36px;border-radius:10px;border:1px solid var(--c-line);background:transparent;color:var(--c-muted);display:grid;place-items:center;cursor:pointer;flex:none;text-decoration:none}\
.etc-ib:hover{color:var(--c-ink);border-color:var(--c-muted)}\
.etc-ib:focus-visible,.etc button:focus-visible,.etc input:focus-visible,.etc textarea:focus-visible{outline:2px solid var(--c-mint);outline-offset:2px}\
.etc-log{flex:1;overflow-y:auto;padding:18px 16px;display:flex;flex-direction:column;gap:12px;scroll-behavior:smooth;overscroll-behavior:contain}\
.etc-m{max-width:min(88%,640px);font-size:15.5px;line-height:1.65;padding:11px 15px;border-radius:16px;word-wrap:break-word;overflow-wrap:anywhere}\
.etc-m.bot{background:var(--c-bot);color:var(--c-ink);border-bottom-left-radius:5px;align-self:flex-start}\
.etc-m.me{background:var(--c-me);color:var(--c-me-ink);border-bottom-right-radius:5px;align-self:flex-end;white-space:pre-wrap}\
.etc-m p{margin:0 0 .6em}.etc-m p:last-child{margin:0}.etc-m ul,.etc-m ol{margin:.2em 0 .6em;padding-left:1.3em}.etc-m li{margin:.15em 0}\
.etc-m a{color:var(--c-link);text-decoration:underline;text-underline-offset:2px}\
.etc-m code{font-family:ui-monospace,Menlo,monospace;font-size:.88em;background:rgba(127,140,170,.16);padding:.1em .35em;border-radius:5px}\
.etc-m pre{background:var(--c-field);border:1px solid var(--c-line);border-radius:10px;padding:10px 12px;overflow-x:auto;margin:.4em 0}.etc-m pre code{background:none;padding:0}\
.etc-m.err{background:transparent;border:1px solid var(--c-err);color:var(--c-err)}\
.etc-dots{display:inline-flex;gap:5px;padding:4px 2px}.etc-dots i{width:7px;height:7px;border-radius:50%;background:var(--c-muted);animation:etcb 1.2s infinite}.etc-dots i:nth-child(2){animation-delay:.15s}.etc-dots i:nth-child(3){animation-delay:.3s}\
@keyframes etcb{0%,60%,100%{opacity:.3;transform:translateY(0)}30%{opacity:1;transform:translateY(-3px)}}\
.etc-hi{margin:auto 0;text-align:center;padding:10px 6px}\
.etc-hi h3{margin:0 0 6px;font-size:20px;color:var(--c-ink)}.etc-hi p{margin:0 auto 18px;color:var(--c-muted);font-size:14.5px;max-width:40ch}\
.etc-chips{display:flex;flex-wrap:wrap;gap:8px;justify-content:center}\
.etc-chip{font:inherit;font-size:13.5px;font-weight:500;color:var(--c-ink);background:var(--c-bot);border:1px solid var(--c-line);border-radius:999px;padding:8px 13px;cursor:pointer;text-align:left}\
.etc-chip:hover{border-color:var(--c-mint)}\
.etc-foot{padding:12px 14px 14px;border-top:1px solid var(--c-line)}\
.etc-in{display:flex;align-items:flex-end;gap:8px;background:var(--c-field);border:1px solid var(--c-line);border-radius:16px;padding:6px 6px 6px 14px}\
.etc-in:focus-within{border-color:var(--c-mint)}\
.etc-in textarea{flex:1;border:0;background:transparent;color:var(--c-ink);font:inherit;font-size:15.5px;line-height:1.5;resize:none;max-height:160px;padding:7px 0;outline:none}\
.etc-in textarea::placeholder{color:var(--c-muted)}\
.etc-send{width:40px;height:40px;border-radius:12px;border:0;background:var(--c-mint);color:var(--c-mint-ink);display:grid;place-items:center;cursor:pointer;flex:none}\
.etc-send[aria-busy=true]{opacity:.5;cursor:wait}\
.etc-note{margin:8px 2px 0;font-size:12px;color:var(--c-muted);line-height:1.5}.etc-note a{color:var(--c-link)}\
.etc-note button{font:inherit;color:var(--c-link);background:none;border:0;padding:0;text-decoration:underline;cursor:pointer}\
.etc-card{align-self:stretch;background:var(--c-bot);border:1px solid var(--c-line);border-radius:16px;padding:16px}\
.etc-card h4{margin:0 0 4px;font-size:15.5px;color:var(--c-ink)}.etc-card>p{margin:0 0 12px;font-size:13.5px;color:var(--c-muted)}\
.etc-card label{display:block;font-size:12.5px;font-weight:600;color:var(--c-muted);margin:10px 0 5px}\
.etc-card input{width:100%;font:inherit;font-size:15px;color:var(--c-ink);background:var(--c-field);border:1px solid var(--c-line);border-radius:10px;padding:10px 12px}\
.etc-card input.code{letter-spacing:.4em;font-size:20px;text-align:center;font-weight:700}\
.etc-card .row{display:grid;grid-template-columns:1fr 1fr;gap:0 10px}\
.etc-card .e{color:var(--c-err);font-size:12.5px;margin-top:5px;min-height:0}\
.etc-card .acts{display:flex;gap:10px;align-items:center;margin-top:14px;flex-wrap:wrap}\
.etc-btn{font:inherit;font-weight:700;font-size:14px;border:0;border-radius:10px;padding:10px 16px;background:var(--c-mint);color:var(--c-mint-ink);cursor:pointer}\
.etc-btn[disabled]{opacity:.6;cursor:wait}\
.etc-lnk{font:inherit;font-size:13.5px;background:none;border:0;color:var(--c-muted);text-decoration:underline;cursor:pointer;padding:0}\
.etc-hp{position:absolute;left:-9999px;width:1px;height:1px;opacity:0}\
.etc-pv{font-size:12px;color:var(--c-muted);border:1px dashed var(--c-line);border-radius:8px;padding:6px 10px;margin-top:10px}\
@media (max-width:560px){.etc-card .row{grid-template-columns:1fr}.etc-m{max-width:92%;font-size:15px}}\
.etc-wrap{position:fixed;right:20px;bottom:90px;z-index:60;width:min(400px,calc(100vw - 24px));height:min(620px,calc(100vh - 120px));box-shadow:0 30px 80px -20px rgba(0,0,0,.55);transform-origin:bottom right;transition:transform .2s,opacity .2s}\
.etc-wrap[hidden]{display:block!important;opacity:0;transform:scale(.92) translateY(10px);pointer-events:none;visibility:hidden}\
.etc-wrap .etc{height:100%}\
@media (max-width:560px){.etc-wrap{right:0;bottom:0;width:100vw;height:100dvh;border-radius:0}.etc-wrap .etc{border-radius:0}}\
.etc h3,.etc h4{font-family:Inter,system-ui,sans-serif!important;color:var(--c-ink)!important;letter-spacing:0!important;text-transform:none!important;line-height:1.3!important}\
.etc .etc-hi p,.etc .etc-card>p,.etc .etc-note{color:var(--c-muted)!important}.etc .etc-m p{color:inherit!important;font-size:inherit!important;line-height:inherit!important}\
.etc .etc-in textarea{border:0!important;background:transparent!important;box-shadow:none!important;padding:7px 0!important;margin:0!important;border-radius:0!important;min-height:0!important;height:auto;width:auto!important;outline:none!important;color:var(--c-ink)!important}\
.etc .etc-card input{margin:0!important;box-shadow:none!important;height:auto!important;background:var(--c-field)!important;color:var(--c-ink)!important;border:1px solid var(--c-line)!important;border-radius:10px!important}\
.etc .etc-card input:focus{border-color:var(--c-mint)!important;outline:none}\
.etc .etc-card label{color:var(--c-muted)!important;text-transform:none!important;letter-spacing:0!important}\
.etc-t small{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}\
@media (prefers-reduced-motion:reduce){.etc-wrap{transition:none}.etc-dots i{animation:none}.etc-log{scroll-behavior:auto}}';

  function injectCSS() {
    if (document.getElementById('etc-css')) return;
    var s = document.createElement('style'); s.id = 'etc-css'; s.textContent = CSS; document.head.appendChild(s);
  }

  /* ---------- tiny, safe markdown ---------- */
  function esc(s) { return String(s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }
  function inline(s) {
    return s
      .replace(/`([^`\n]+)`/g, '<code>$1</code>')
      .replace(/\*\*([^*\n]+)\*\*/g, '<strong>$1</strong>')
      .replace(/(^|[\s(])\*([^*\n]+)\*(?=[\s).,!?]|$)/g, '$1<em>$2</em>')
      .replace(/\[([^\]\n]+)\]\(((?:https?:\/\/|\/|mailto:)[^)\s]+)\)/g, function (m, t, u) {
        var ext = /^https?:/.test(u) && u.indexOf(location.host) === -1;
        return '<a href="' + u + '"' + (ext ? ' target="_blank" rel="noopener nofollow"' : '') + '>' + t + '</a>';
      });
  }
  function md(src) {
    var parts = esc(src).split(/```[a-zA-Z0-9_-]*\n?/), out = '';
    parts.forEach(function (part, i) {
      if (i % 2) { out += '<pre><code>' + part.replace(/\n$/, '') + '</code></pre>'; return; }
      var lines = part.split('\n'), list = null, para = [];
      function flushP() { if (para.length) { out += '<p>' + inline(para.join('<br>')) + '</p>'; para = []; } }
      function flushL() { if (list) { out += '</' + list + '>'; list = null; } }
      lines.forEach(function (l) {
        var ul = l.match(/^\s*[-*•]\s+(.*)/), ol = l.match(/^\s*\d+[.)]\s+(.*)/), h = l.match(/^#{1,4}\s+(.*)/);
        if (ul || ol) {
          flushP(); var t = ul ? 'ul' : 'ol';
          if (list !== t) { flushL(); out += '<' + t + '>'; list = t; }
          out += '<li>' + inline((ul || ol)[1]) + '</li>';
        } else if (h) { flushP(); flushL(); out += '<p><strong>' + inline(h[1]) + '</strong></p>'; }
        else if (!l.trim()) { flushP(); flushL(); }
        else { flushL(); para.push(l); }
      });
      flushP(); flushL();
    });
    return out;
  }

  /* ---------- network ---------- */
  function csrf() { var m = document.querySelector('meta[name="csrf-token"]'); return m ? m.content : ''; }
  function post(path, body) {
    return fetch(API + path, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf(), 'X-Requested-With': 'XMLHttpRequest' },
      credentials: 'same-origin',
      body: JSON.stringify(body)
    }).then(function (r) {
      var ct = r.headers.get('content-type') || '';
      if (!ct.includes('json')) { var e = new Error('no-server'); e.noServer = true; throw e; }
      return r.json().then(function (j) { return { ok: r.ok, status: r.status, data: j }; });
    }, function () { var e = new Error('no-server'); e.noServer = true; throw e; });
  }
  function firstError(d) {
    if (d && d.errors) { for (var k in d.errors) return d.errors[k][0]; }
    return (d && (d.error || d.message)) || 'Something went wrong. Try again.';
  }

  /* ---------- preview replies (no server) ---------- */
  function demoReply(text) {
    var t = text.toLowerCase(), bn = /[ঀ-৿]/.test(text);
    if (/website|app|quote|price|cost|budget|ai assistant|chatbot|team|contact|ওয়েবসাইট|দাম|খরচ|website lagbe|banate/.test(t)) {
      return bn
        ? 'দারুণ! e-Trust আপনার ব্যবসার জন্য ওয়েবসাইট, অ্যাপ বা AI অ্যাসিস্ট্যান্ট বানিয়ে দিতে পারে। আপনার তথ্য দিলে আমাদের টিম ইমেইলে পরিষ্কার একটা কোটেশন পাঠাবে।\n[[LEAD]]'
        : 'Great — e-Trust can build that for you: websites, apps and AI assistants like this one, in Bangla and English.\n\nShare your details below and the team will email you a clear quote.\n[[LEAD]]';
    }
    if (/hack|password of|crack|scam someone|phishing kit|fake review/.test(t)) {
      return "Sorry, I can't help with that. If you're worried about your own account, I can show you how to secure it.";
    }
    return bn
      ? 'এটা একটা প্রিভিউ। লাইভ সাইটে এখানে AI আপনার প্রশ্নের পুরো উত্তর দেবে — বাংলা, Banglish বা English-এ।'
      : "This is a **preview** of the chat. On the live site the AI answers here — any question, in Bangla, Banglish or English.\n\nTry asking about **a website for your business** to see how the team hand-off works.";
  }

  /* ---------- chat instance ---------- */
  function Chat(root, opts) {
    this.root = root; this.opts = opts || {};
    this.msgs = [];
    try { this.msgs = JSON.parse(sget('sessionStorage', STORE) || '[]') || []; } catch (e) { this.msgs = []; }
    this.busy = false;
    this.build();
  }
  Chat.prototype.save = function () { sset('sessionStorage', STORE, JSON.stringify(this.msgs.slice(-40))); };
  Chat.prototype.build = function () {
    var w = this.opts.widget;
    this.root.classList.add('etc');
    this.root.setAttribute('data-theme', theme());
    this.root.innerHTML =
      '<div class="etc-head"><span class="etc-av" aria-hidden="true">eT</span>' +
      '<div class="etc-t"><b>e-Trust AI</b><small><i aria-hidden="true"></i>Free · বাংলা &amp; English</small></div>' +
      '<button class="etc-ib etc-theme" type="button"></button>' +
      '<button class="etc-ib etc-new" type="button" aria-label="Start a new chat" title="New chat">' + ICON.plus + '</button>' +
      (w ? '<a class="etc-ib" href="' + (this.opts.pageUrl || 'assistant.html') + '" aria-label="Open full page" title="Open full page">' + ICON.expand + '</a>' +
           '<button class="etc-ib etc-close" type="button" aria-label="Close chat">' + ICON.x + '</button>' : '') +
      '</div>' +
      '<div class="etc-log" role="log" aria-live="polite" aria-label="Chat messages"></div>' +
      '<form class="etc-foot" autocomplete="off"><label class="etc-hp" for="etc-q-' + (w ? 'w' : 'p') + '">Message</label>' +
      '<div class="etc-in"><textarea id="etc-q-' + (w ? 'w' : 'p') + '" rows="1" maxlength="2000" placeholder="Ask anything… / যেকোনো প্রশ্ন…"></textarea>' +
      '<button class="etc-send" type="submit" aria-label="Send">' + ICON.send + '</button></div>' +
      '<p class="etc-note">Don\'t share passwords or bank details. AI can make mistakes. <button type="button" class="etc-team">Talk to our team</button></p></form>';
    this.log = this.root.querySelector('.etc-log');
    this.ta = this.root.querySelector('textarea');
    this.sendBtn = this.root.querySelector('.etc-send');
    var self = this;
    this.root.querySelector('form').addEventListener('submit', function (e) { e.preventDefault(); self.send(self.ta.value); });
    this.ta.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey && !e.isComposing) { e.preventDefault(); self.send(self.ta.value); }
    });
    this.ta.addEventListener('input', function () { self.ta.style.height = 'auto'; self.ta.style.height = Math.min(self.ta.scrollHeight, 160) + 'px'; });
    this.root.querySelector('.etc-new').addEventListener('click', function () { self.msgs = []; self.save(); self.render(); self.ta.focus(); });
    this.root.querySelector('.etc-theme').addEventListener('click', function () {
      var t = self.root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      sset('localStorage', THEME, t); applyTheme(t);
    });
    this.root.querySelector('.etc-team').addEventListener('click', function () { self.leadCard(); });
    var close = this.root.querySelector('.etc-close');
    if (close) close.addEventListener('click', function () { self.opts.onClose && self.opts.onClose(); });
    applyTheme(theme());
    this.render();
  };
  Chat.prototype.render = function () {
    var self = this;
    this.log.innerHTML = '';
    if (!this.msgs.length) {
      var hi = document.createElement('div'); hi.className = 'etc-hi';
      hi.innerHTML = '<h3>Assalamu alaikum! 👋</h3><p>Ask me anything — study, writing, coding, business or everyday questions.</p><div class="etc-chips"></div>';
      var box = hi.querySelector('.etc-chips');
      (this.opts.widget ? CHIPS.slice(0, 4) : CHIPS).forEach(function (c) {
        var b = document.createElement('button'); b.type = 'button'; b.className = 'etc-chip'; b.textContent = c;
        b.addEventListener('click', function () { self.send(c); });
        box.appendChild(b);
      });
      this.log.appendChild(hi);
      return;
    }
    this.msgs.forEach(function (m) { self.bubble(m.role, m.content); });
    this.scroll();
  };
  Chat.prototype.bubble = function (role, text, cls) {
    var d = document.createElement('div');
    d.className = 'etc-m ' + (role === 'user' ? 'me' : 'bot') + (cls ? ' ' + cls : '');
    if (role === 'user') d.textContent = text; else d.innerHTML = md(text);
    this.log.appendChild(d);
    return d;
  };
  Chat.prototype.scroll = function () { this.log.scrollTop = this.log.scrollHeight; };
  Chat.prototype.setBusy = function (b) { this.busy = b; this.sendBtn.setAttribute('aria-busy', b ? 'true' : 'false'); };
  Chat.prototype.send = function (text) {
    text = (text || '').trim();
    if (!text || this.busy) return;
    if (!this.msgs.length) this.log.innerHTML = '';
    this.ta.value = ''; this.ta.style.height = 'auto';
    this.msgs.push({ role: 'user', content: text }); this.save();
    this.bubble('user', text);
    var typing = this.bubble('assistant', ''); typing.innerHTML = '<span class="etc-dots" aria-label="e-Trust AI is typing"><i></i><i></i><i></i></span>';
    this.scroll(); this.setBusy(true);
    var self = this;
    var done = function (reply, isErr) {
      typing.remove(); self.setBusy(false);
      if (isErr) { self.bubble('assistant', reply, 'err'); self.scroll(); return; }
      var wantsLead = /\[\[LEAD\]\]/.test(reply);
      reply = reply.replace(/\s*\[\[LEAD\]\]\s*/g, '\n').trim();
      self.msgs.push({ role: 'assistant', content: reply }); self.save();
      self.bubble('assistant', reply);
      if (wantsLead) self.leadCard();
      self.scroll();
    };
    var history = this.msgs.slice(-16).map(function (m) { return { role: m.role, content: m.content }; });
    if (preview) { setTimeout(function () { done(demoReply(text)); }, 700); return; }
    post('/api/chat', { messages: history }).then(function (r) {
      if (r.ok && r.data.reply) done(r.data.reply);
      else done(firstError(r.data), true);
    }).catch(function (e) {
      if (e.noServer) { preview = true; setTimeout(function () { done(demoReply(text)); }, 500); }
      else done('Connection problem. Check your internet and try again.', true);
    });
  };

  /* ---------- lead card: details -> email code -> confirmed ---------- */
  Chat.prototype.leadCard = function () {
    if (this.log.querySelector('.etc-card[data-step]')) { this.log.querySelector('.etc-card[data-step] input').focus(); return; }
    if (!this.msgs.length) this.log.innerHTML = '';
    var self = this, id = 'l' + Date.now();
    var c = document.createElement('form'); c.className = 'etc-card'; c.setAttribute('data-step', '1'); c.noValidate = true;
    c.innerHTML =
      '<h4>Talk to the e-Trust team</h4><p>We\'ll email you within one working day. Your email is confirmed with a 6-digit code.</p>' +
      '<label for="' + id + 'n">Your name</label><input id="' + id + 'n" name="name" autocomplete="name" maxlength="80" required>' +
      '<div class="row"><div><label for="' + id + 'e">Email</label><input id="' + id + 'e" name="email" type="email" autocomplete="email" maxlength="150" placeholder="name@example.com" required></div>' +
      '<div><label for="' + id + 'p">Mobile</label><input id="' + id + 'p" name="phone" type="tel" autocomplete="tel" maxlength="30" placeholder="01XXXXXXXXX / 04XXXXXXXX" required></div></div>' +
      '<input class="etc-hp" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">' +
      '<div class="e" role="alert"></div>' +
      '<div class="acts"><button class="etc-btn" type="submit">Send me a code</button><button class="etc-lnk" type="button" data-x>Not now</button></div>';
    this.log.appendChild(c); this.scroll();
    c.querySelector('input').focus();
    var err = c.querySelector('.e');
    c.querySelector('[data-x]').addEventListener('click', function () { c.remove(); });
    c.addEventListener('submit', function (e) {
      e.preventDefault();
      if (c.getAttribute('data-step') !== '1') return; // code step has its own handler
      err.textContent = '';
      var q = function (n) { return c.querySelector('[name="' + n + '"]'); };
      var f = { name: q('name').value.trim(), email: q('email').value.trim(), phone: q('phone').value.trim(), website: q('website').value };
      if (f.name.length < 2) return (err.textContent = 'Enter your name.', q('name').focus());
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(f.email)) return (err.textContent = 'Enter a valid email address.', q('email').focus());
      if (f.phone.replace(/\D/g, '').length < 9) return (err.textContent = 'Enter your mobile number.', q('phone').focus());
      f.summary = self.msgs.filter(function (m) { return m.role === 'user'; }).slice(-6).map(function (m) { return '• ' + m.content; }).join('\n').slice(0, 1400);
      f.page = location.pathname;
      var btn = c.querySelector('.etc-btn'); btn.disabled = true; btn.textContent = 'Sending…';
      var next = function (lead, email) { self.codeStep(c, lead, email, f.name); };
      if (preview) { setTimeout(function () { next('preview', f.email); }, 600); return; }
      post('/api/lead', f).then(function (r) {
        btn.disabled = false; btn.textContent = 'Send me a code';
        if (r.ok) next(r.data.lead, r.data.email); else err.textContent = firstError(r.data);
      }).catch(function (e2) {
        if (e2.noServer) { preview = true; next('preview', f.email); return; }
        btn.disabled = false; btn.textContent = 'Send me a code'; err.textContent = 'Connection problem. Try again.';
      });
    });
  };
  Chat.prototype.codeStep = function (c, lead, email, name) {
    var self = this, id = 'c' + Date.now();
    c.setAttribute('data-step', '2');
    c.innerHTML =
      '<h4>Check your email</h4><p>We sent a 6-digit code to <b>' + esc(email) + '</b>. It works for 10 minutes.</p>' +
      '<label for="' + id + '">Code</label><input id="' + id + '" name="code" class="code" inputmode="numeric" autocomplete="one-time-code" maxlength="6" placeholder="••••••">' +
      '<div class="e" role="alert"></div>' +
      '<div class="acts"><button class="etc-btn" type="submit">Confirm</button><button class="etc-lnk" type="button" data-back>Change details</button></div>' +
      (lead === 'preview' ? '<p class="etc-pv">Preview: no email is sent here. Type any 6 digits.</p>' : '');
    var inp = c.querySelector('input'), err = c.querySelector('.e');
    inp.focus(); this.scroll();
    inp.addEventListener('input', function () { inp.value = inp.value.replace(/\D/g, '').slice(0, 6); });
    c.querySelector('[data-back]').addEventListener('click', function () { c.remove(); self.leadCard(); });
    c.onsubmit = function (e) {
      e.preventDefault(); err.textContent = '';
      if (!/^\d{6}$/.test(inp.value)) return (err.textContent = 'Enter the 6-digit code from the email.', inp.focus());
      var btn = c.querySelector('.etc-btn'); btn.disabled = true; btn.textContent = 'Checking…';
      var ok = function () {
        c.remove();
        var msg = 'Thanks, **' + name.split(' ')[0] + '**! Your email is confirmed. The e-Trust team will email you within one working day.';
        self.msgs.push({ role: 'assistant', content: msg }); self.save();
        self.bubble('assistant', msg); self.scroll();
      };
      if (lead === 'preview') { setTimeout(ok, 500); return; }
      post('/api/lead/verify', { lead: lead, code: inp.value }).then(function (r) {
        btn.disabled = false; btn.textContent = 'Confirm';
        if (r.ok) ok(); else { err.textContent = firstError(r.data); inp.select(); }
      }).catch(function () { btn.disabled = false; btn.textContent = 'Confirm'; err.textContent = 'Connection problem. Try again.'; });
    };
  };

  /* ---------- mount ---------- */
  function init() {
    injectCSS();
    var page = document.getElementById('etChat');
    if (page) { window.etChat = new Chat(page, { widget: false }); return; }
    var openers = document.querySelectorAll('.fab, [data-open-chat]');
    if (!openers.length) return;
    var wrap = null, chat = null, last = null;
    function open() {
      if (!wrap) {
        wrap = document.createElement('div'); wrap.className = 'etc-wrap'; wrap.hidden = true;
        wrap.setAttribute('role', 'dialog'); wrap.setAttribute('aria-label', 'e-Trust AI chat');
        var box = document.createElement('div'); wrap.appendChild(box); document.body.appendChild(wrap);
        chat = new Chat(box, { widget: true, pageUrl: window.ETRUST_ASSISTANT_URL || 'assistant.html', onClose: close });
        wrap.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
      }
      last = document.activeElement;
      wrap.hidden = false; requestAnimationFrame(function () { chat.ta.focus(); chat.scroll(); });
      openers.forEach(function (o) { o.setAttribute('aria-expanded', 'true'); });
    }
    function close() {
      if (!wrap) return; wrap.hidden = true;
      openers.forEach(function (o) { o.setAttribute('aria-expanded', 'false'); });
      if (last && last.focus) last.focus();
    }
    openers.forEach(function (o) {
      o.setAttribute('aria-haspopup', 'dialog'); o.setAttribute('aria-expanded', 'false');
      o.addEventListener('click', function (e) { e.preventDefault(); wrap && !wrap.hidden ? close() : open(); });
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
  if (window.matchMedia) {
    var mq = matchMedia('(prefers-color-scheme: light)');
    var onChange = function () { if (!sget('localStorage', THEME)) applyTheme(theme()); };
    mq.addEventListener ? mq.addEventListener('change', onChange) : mq.addListener && mq.addListener(onChange);
  }
})();
