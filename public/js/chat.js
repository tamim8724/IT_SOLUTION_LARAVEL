/* e-Trust AI chat. One shared conversation, shown in every chat panel on the page. */
(function () {
  'use strict';

  var KEY = 'etrust-chat-v1';
  var MODEL_KEY = 'etrust-chat-model';
  function getModel() { try { return sessionStorage.getItem(MODEL_KEY) || ''; } catch (e) { return ''; } }
  function setModel(v) { try { sessionStorage.setItem(MODEL_KEY, v); } catch (e) { /* storage unavailable */ } }
  var MAX_SEND = 16;

  var WELCOME =
    "Hi! I'm **e-Trust AI**, a free assistant for everyone.\n\n" +
    'বাংলা বা English, যেভাবে খুশি প্রশ্ন করুন। Study, business, writing, coding, online safety, or anything about e-Trust and DORKARI.';
  // ---------- shared store ----------
  var store = {
    messages: [],
    busy: false,
    listeners: [],
    load: function () {
      try { this.messages = JSON.parse(sessionStorage.getItem(KEY) || '[]') || []; } catch (e) { this.messages = []; }
    },
    save: function () {
      try { sessionStorage.setItem(KEY, JSON.stringify(this.messages.slice(-40))); } catch (e) { /* storage unavailable */ }
    },
    emit: function () { var self = this; this.listeners.forEach(function (fn) { fn(self); }); },
    push: function (m) { this.messages.push(m); this.save(); this.emit(); },
    reset: function () { this.messages = []; this.save(); this.emit(); }
  };
  store.load();

  // ---------- tiny, safe markdown ----------
  function esc(s) {
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
  }
  function inline(s) {
    var codes = [];
    s = s.replace(/`([^`\n]+)`/g, function (_, c) { codes.push(c); return '\u0000' + (codes.length - 1) + '\u0000'; });
    s = s.replace(/\*\*([^*\n]+)\*\*/g, '<strong>$1</strong>');
    s = s.replace(/(^|[\s(])\*([^*\n]+)\*(?=[\s).,!?:;]|$)/g, '$1<em>$2</em>');
    s = s.replace(/\[([^\]\n]+)\]\(((?:https?:\/\/|\/)[^\s)]+)\)/g, function (_, text, url) {
      var ext = /^https?:/.test(url) && url.indexOf(location.host) === -1;
      return '<a href="' + url + '"' + (ext ? ' target="_blank" rel="noopener nofollow"' : '') + '>' + text + '</a>';
    });
    s = s.replace(/(^|\s)(https?:\/\/[^\s<]+[^\s<.,)!?])/g, '$1<a href="$2" target="_blank" rel="noopener nofollow">$2</a>');
    s = s.replace(/\u0000(\d+)\u0000/g, function (_, i) { return '<code>' + codes[+i] + '</code>'; });
    return s;
  }
  function md(src) {
    var text = esc(src).replace(/\r/g, '');
    var blocks = [];
    text = text.replace(/```[\w-]*\n?([\s\S]*?)```/g, function (_, code) {
      blocks.push('<pre><code>' + code.replace(/\n$/, '') + '</code></pre>');
      return '\n\u0001' + (blocks.length - 1) + '\u0001\n';
    });
    var out = [], list = null, para = [];
    function flushPara() { if (para.length) { out.push('<p>' + inline(para.join('<br>')) + '</p>'); para = []; } }
    function flushList() { if (list) { out.push('<' + list.type + '>' + list.items.map(function (i) { return '<li>' + inline(i) + '</li>'; }).join('') + '</' + list.type + '>'); list = null; } }
    text.split('\n').forEach(function (line) {
      var m;
      if ((m = line.match(/^\u0001(\d+)\u0001$/))) { flushPara(); flushList(); out.push(blocks[+m[1]]); return; }
      if ((m = line.match(/^\s*[-*â€¢]\s+(.*)$/))) { flushPara(); if (!list || list.type !== 'ul') { flushList(); list = { type: 'ul', items: [] }; } list.items.push(m[1]); return; }
      if ((m = line.match(/^\s*\d+[.)]\s+(.*)$/))) { flushPara(); if (!list || list.type !== 'ol') { flushList(); list = { type: 'ol', items: [] }; } list.items.push(m[1]); return; }
      if ((m = line.match(/^#{1,6}\s+(.*)$/))) { flushPara(); flushList(); out.push('<h4>' + inline(m[1]) + '</h4>'); return; }
      if (!line.trim()) { flushPara(); flushList(); return; }
      if (list) flushList();
      para.push(line);
    });
    flushPara(); flushList();
    return out.join('');
  }

  // ---------- API ----------
  function send(text, endpoint) {
    text = (text || '').trim();
    if (!text || store.busy) return;
    store.push({ role: 'user', content: text });
    store.busy = true; store.emit();

    var history = store.messages
      .filter(function (m) { return m.role === 'user' || m.role === 'assistant'; })
      .slice(-MAX_SEND)
      .map(function (m) { return { role: m.role, content: m.content }; });

    var csrf = document.querySelector('meta[name="csrf-token"]');
    var ctrl = 'AbortController' in window ? new AbortController() : null;
    var timer = setTimeout(function () { if (ctrl) ctrl.abort(); }, 60000);

    fetch(endpoint, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf ? csrf.content : '' },
      body: JSON.stringify({ messages: history, model: getModel() || null }),
      signal: ctrl ? ctrl.signal : undefined
    })
      .then(function (r) { return r.json().catch(function () { return {}; }).then(function (data) { return { ok: r.ok, status: r.status, data: data }; }); })
      .then(function (res) {
        if (res.ok && res.data.reply) {
          // store.push({ role: 'assistant', content: res.data.reply, by: 'e-Trust AI' });
          store.push({ role: 'assistant', content: res.data.reply, by: 'e-Trust AI' });
        } else {
          var msg = res.data.error || (res.data.message && res.status === 422 ? res.data.message : null) || 'The assistant could not answer. Check your connection and send your message again.';
          store.push({ role: 'error', content: msg, retry: text });
        }
      })
      .catch(function () {
        store.push({ role: 'error', content: 'No response from the server. Check your internet connection and try again.', retry: text });
      })
      .then(function () { clearTimeout(timer); store.busy = false; store.emit(); });
  }

  // ---------- UI ----------
  function mount(root) {
    var log = root.querySelector('[data-chat-log]');
    var form = root.querySelector('[data-chat-form]');
    var input = root.querySelector('[data-chat-input]');
    var sendBtn = root.querySelector('[data-chat-send]');
    var suggest = root.querySelector('[data-chat-suggest]');
    var resetBtn = root.querySelector('[data-chat-reset]');
    var modelSel = root.querySelector('[data-chat-model]');
    if (modelSel) {
      var modelRow = modelSel.closest('label') || modelSel.parentElement;
      if (modelRow) modelRow.style.display = 'none';
      setModel('');
    }
    if (modelSel) {
      var saved = getModel();
      if (saved && modelSel.querySelector('option[value="' + saved + '"]')) modelSel.value = saved;
      modelSel.addEventListener('change', function () {
        setModel(modelSel.value);
        document.querySelectorAll('[data-chat-model]').forEach(function (s) { if (s !== modelSel) s.value = modelSel.value; });
      });
    }
    var endpoint = root.getAttribute('data-endpoint') || '/api/chat';
    var rendered = -1, wasBusy = false;

    function bubble(m, i) {
      var wrap = document.createElement('div');
      var cls = m.role === 'user' ? 'msg--user' : m.role === 'error' ? 'msg--bot msg--error' : 'msg--bot';
      wrap.className = 'msg ' + cls;
      var b = document.createElement('div');
      b.className = 'msg__bubble';
      if (m.role === 'user') b.textContent = m.content;
      else b.innerHTML = md(m.content);
      wrap.appendChild(b);

      if (m.role === 'assistant' && i !== -1) {
        var tools = document.createElement('div');
        tools.className = 'msg__tools';
        if (m.role === 'assistant') {
    var by = document.createElement('span');
    by.className = 'msg__by';
    by.textContent = 'e-Trust AI';
    tools.appendChild(by);
}
        // if (m.by) { var by = document.createElement('span'); by.className = 'msg__by'; by.textContent = 'e-Trust AI'; tools.appendChild(by); }
        var copy = document.createElement('button');
        copy.type = 'button';
        copy.innerHTML = '<svg class="icon" aria-hidden="true"><use href="#i-copy"/></svg><span>Copy</span>';
        copy.addEventListener('click', function () {
          var done = function () { copy.querySelector('span').textContent = 'Copied'; setTimeout(function () { copy.querySelector('span').textContent = 'Copy'; }, 1500); };
          if (navigator.clipboard) navigator.clipboard.writeText(m.content).then(done, function () {});
        });
        tools.appendChild(copy);
        wrap.appendChild(tools);
      }
      if (m.role === 'error' && m.retry) {
        var tools2 = document.createElement('div');
        tools2.className = 'msg__tools';
        var retry = document.createElement('button');
        retry.type = 'button';
        retry.innerHTML = '<svg class="icon" aria-hidden="true"><use href="#i-refresh"/></svg><span>Send again</span>';
        retry.addEventListener('click', function () {
          var idx = store.messages.indexOf(m);
          if (idx > -1) { store.messages.splice(idx, 1); }
          // remove the failed user message too, it will be re-added
          for (var k = store.messages.length - 1; k >= 0; k--) {
            if (store.messages[k].role === 'user' && store.messages[k].content === m.retry) { store.messages.splice(k, 1); break; }
          }
          store.save();
          send(m.retry, endpoint);
        });
        tools2.appendChild(retry);
        wrap.appendChild(tools2);
      }
      return wrap;
    }

    function render(s) {
      var msgs = s.messages;
      var needsFull = rendered === -1 || msgs.length < rendered;
      if (needsFull) {
        log.innerHTML = '';
        log.appendChild(bubble({ role: 'assistant', content: WELCOME }, -1));
        msgs.forEach(function (m, i) { log.appendChild(bubble(m, i)); });
      } else {
        for (var i = rendered; i < msgs.length; i++) log.appendChild(bubble(msgs[i], i));
      }
      rendered = msgs.length;

      var typing = log.querySelector('.msg--typing');
      if (s.busy && !typing) {
        typing = document.createElement('div');
        typing.className = 'msg msg--bot msg--typing';
        typing.innerHTML = '<div class="msg__bubble typing" aria-label="e-Trust AI is typing"><span></span><span></span><span></span></div>';
        log.appendChild(typing);
      } else if (!s.busy && typing) {
        typing.remove();
      }

      if (suggest) suggest.hidden = msgs.length > 0;
      sendBtn.disabled = s.busy;
      if (needsFull || msgs.length || s.busy !== wasBusy) log.scrollTop = log.scrollHeight;
      wasBusy = s.busy;
    }

    function autosize() { input.style.height = 'auto'; input.style.height = Math.min(input.scrollHeight, 160) + 'px'; }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var v = input.value;
      if (!v.trim() || store.busy) return;
      input.value = ''; autosize();
      send(v, endpoint);
    });
    input.addEventListener('input', autosize);
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey && !e.isComposing) { e.preventDefault(); form.requestSubmit ? form.requestSubmit() : form.dispatchEvent(new Event('submit', { cancelable: true })); }
    });
    if (suggest) suggest.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-prompt]');
      if (btn) { send(btn.getAttribute('data-prompt'), endpoint); input.focus({ preventScroll: true }); }
    });
    if (resetBtn) resetBtn.addEventListener('click', function () { if (!store.busy) store.reset(); input.focus(); });

    store.listeners.push(render);
    render(store);
    return { input: input };
  }

  var instances = [];
  document.querySelectorAll('[data-chat]').forEach(function (el) { instances.push({ el: el, ui: mount(el) }); });

  // ---------- floating widget ----------
  var widget = document.querySelector('[data-chat-widget]');
  if (widget) {
    var openBtn = widget.querySelector('[data-chat-open]');
    var panel = widget.querySelector('[data-chat-panel]');
    var closeBtn = widget.querySelector('[data-chat-close]');
    var panelInput = panel.querySelector('[data-chat-input]');
    var setOpen = function (open) {
      panel.hidden = !open;
      openBtn.setAttribute('aria-expanded', String(open));
      widget.classList.toggle('is-open', open);
      if (open) {
        var log = panel.querySelector('[data-chat-log]'); log.scrollTop = log.scrollHeight;
        if (window.matchMedia('(min-width: 561px)').matches) panelInput.focus();
      } else {
        openBtn.focus();
      }
    };
    openBtn.addEventListener('click', function () { setOpen(panel.hidden); });
    if (closeBtn) closeBtn.addEventListener('click', function () { setOpen(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !panel.hidden) setOpen(false); });

    // Hide the floating button while the inline chat section is on screen
    var inlineChatSection = document.querySelector('.chatbox--inline');
    if (inlineChatSection && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        widget.classList.toggle('is-hidden-by-section', entries[0].isIntersecting && panel.hidden);
      }, { threshold: 0.35 }).observe(inlineChatSection);
    }
  }
})();
