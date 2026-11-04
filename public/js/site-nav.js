// Navbar: solid background after scrolling, and the full-screen mobile menu.
(function () {
  var nav = document.getElementById('nav');
  var btn = document.getElementById('nav-toggle');
  var sheet = document.getElementById('nav-sheet');
  if (!nav || !btn || !sheet) return;

  function onScroll() { nav.classList.toggle('scrolled', window.scrollY > 24); }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  function setOpen(open) {
    sheet.hidden = !open;
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    document.body.classList.toggle('sheet-open', open);
  }
  btn.addEventListener('click', function () { setOpen(sheet.hidden); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setOpen(false); });
  sheet.addEventListener('click', function (e) { if (e.target.closest('a')) setOpen(false); });
})();
