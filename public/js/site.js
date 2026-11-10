/* e-Trust: shared behaviour for every page */
(function () {
  'use strict';
  var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- live clocks (Dhaka / Sydney) ---- */
  function t(z) { return new Intl.DateTimeFormat('en-US', { hour: 'numeric', minute: '2-digit', timeZone: z }).format(new Date()); }
  function tick() {
    var a = document.getElementById('cd'), b = document.getElementById('cs');
    if (a) a.textContent = t('Asia/Dhaka');
    if (b) b.textContent = t('Australia/Sydney');
  }
  tick(); setInterval(tick, 30000);

  /* ---- reveal on scroll ---- */
  var els = document.querySelectorAll('.reveal');
  if (reduce || !('IntersectionObserver' in window)) { els.forEach(function (e) { e.classList.add('in'); }); }
  else {
    var io = new IntersectionObserver(function (es) { es.forEach(function (x) { if (x.isIntersecting) { x.target.classList.add('in'); io.unobserve(x.target); } }); }, { threshold: 0.2 });
    els.forEach(function (e) { io.observe(e); });
  }

  /* ---- nav wordmark: every 5 s the letters leave from the end (Belver style) to "e.", then come back ---- */
  document.querySelectorAll('.brand > span').forEach(function (sp) {
    var txt = sp.textContent; if (!/^e-trust\.online$/.test(txt)) return;
    var h = '<span class="bw">', n = 0;
    for (var i = 0; i < txt.length; i++) {
      var c = txt[i], keep = (i === 0 || c === '.');
      h += keep && c === '.' ? '<b class="ch">.</b>' : '<span class="ch' + (keep ? '' : ' x') + '"' + (keep ? '' : ' data-i="' + (n++) + '"') + '>' + c + '</span>';
    }
    sp.outerHTML = h + '</span>';
  });
  var nav = document.querySelector('.nav');
  if (nav && !reduce) {
    var xs = [].slice.call(nav.querySelectorAll('.brand .ch.x')), N = xs.length, STEP = 0.045;
    var go = function (out) {
      xs.forEach(function (e) { var i = +e.dataset.i; e.style.transitionDelay = (out ? STEP * (N - 1 - i) : STEP * i) + 's'; });
      nav.classList.toggle('mini', out);
    };
    var loop = function () { go(true); setTimeout(function () { go(false); }, N * STEP * 1000 + 1200); };
    setInterval(loop, 5000); setTimeout(loop, 2500);
  }

  /* ---- mobile menu ---- */
  var menu = document.getElementById('mnav'), burger = document.querySelector('.nav .burger');
  if (menu && burger) {
    var close = menu.querySelector('.x'), lastFocus = null;
    var open = function () { lastFocus = document.activeElement; menu.classList.add('open'); document.body.classList.add('menu-open'); burger.setAttribute('aria-expanded', 'true'); setTimeout(function () { close.focus(); }, 50); };
    var shut = function () { menu.classList.remove('open'); document.body.classList.remove('menu-open'); burger.setAttribute('aria-expanded', 'false'); if (lastFocus) lastFocus.focus(); };
    burger.addEventListener('click', open);
    close.addEventListener('click', shut);
    menu.addEventListener('keydown', function (e) { if (e.key === 'Escape') shut(); });
    menu.querySelectorAll('a').forEach(function (a) { a.addEventListener('click', shut); });
    matchMedia('(min-width: 861px)').addEventListener('change', function (m) { if (m.matches) shut(); });
  }

  /* ---- "Get launch updates" (Our Innovation) ---- */
  document.querySelectorAll('form.lu-form').forEach(function (f) {
    var msg = f.querySelector('.lu-msg');
    f.addEventListener('submit', function (e) {
      e.preventDefault();
      var email = f.querySelector('input[type=email]').value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email)) { msg.className = 'lu-msg err'; msg.textContent = 'Enter a valid email address.'; return; }
      var btn = f.querySelector('button'); btn.disabled = true;
      var token = document.querySelector('meta[name="csrf-token"]');
      fetch(f.action, {
        method: 'POST', credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token ? token.content : '' },
        body: JSON.stringify({ email: email, website: (f.querySelector('.hp') || {}).value || '' })
      }).then(function (r) { return r.json().then(function (j) { return { ok: r.ok, s: r.status, j: j }; }); })
        .then(function (r) {
          btn.disabled = false;
          if (r.ok) { msg.className = 'lu-msg ok'; msg.textContent = "Thanks! You'll be the first to know when we launch."; f.reset(); }
          else { msg.className = 'lu-msg err'; msg.textContent = r.s === 429 ? 'Too many tries. Please wait a few minutes and try again.' : (r.j && r.j.errors && r.j.errors.email && r.j.errors.email[0]) || (r.j && (r.j.error || r.j.message)) || 'Something went wrong. Try again.'; }
        })
        .catch(function () { btn.disabled = false; msg.className = 'lu-msg err'; msg.textContent = 'Connection problem. Try again.'; });
    });
  });
})();
