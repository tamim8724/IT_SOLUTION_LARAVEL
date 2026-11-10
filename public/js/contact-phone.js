import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';

const canvas = document.getElementById('gl');
if (canvas) {
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches || window.__shot;
  const R = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
  R.setPixelRatio(Math.min(devicePixelRatio, 2));
  R.outputColorSpace = THREE.SRGBColorSpace;
  R.toneMapping = THREE.ACESFilmicToneMapping;
  const scene = new THREE.Scene();
  const pm = new THREE.PMREMGenerator(R);
  scene.environment = pm.fromScene(new RoomEnvironment(), 0.04).texture;
  const cam = new THREE.PerspectiveCamera(30, 1, 0.1, 100);
  cam.position.set(0, 0, 11);
  scene.add(new THREE.AmbientLight(0xffffff, 0.35));
  const key = new THREE.DirectionalLight(0xffffff, 1.6); key.position.set(3, 5, 6); scene.add(key);
  const rim = new THREE.PointLight(0x2bcf8f, 18, 14); rim.position.set(-3, 1, -2); scene.add(rim);

  const root = new THREE.Group(); scene.add(root);
  const phone = new THREE.Group(); root.add(phone);

  // body + screen
  const body = new THREE.Mesh(new RoundedBoxGeometry(2.3, 4.7, 0.26, 8, 0.32),
    new THREE.MeshPhysicalMaterial({ color: 0x14294f, metalness: 0.6, roughness: 0.28, clearcoat: 1 }));
  phone.add(body);

  const W = 720, H = 1480;
  const cv = document.createElement('canvas'); cv.width = W; cv.height = H;
  const x = cv.getContext('2d');
  const tex = new THREE.CanvasTexture(cv); tex.colorSpace = THREE.SRGBColorSpace; tex.anisotropy = 4;
  const screen = new THREE.Mesh(new THREE.PlaneGeometry(2.08, 4.28), new THREE.MeshBasicMaterial({ map: tex, toneMapped: false }));
  screen.position.z = 0.135; phone.add(screen);

  const msgs = [
    { me: false, t: 'Hi! How can we help your business today?' },
    { me: true, t: 'I need a new website for my shop in Sydney.' },
    { me: false, t: 'Great — want a free website audit first?' },
    { me: true, t: 'Yes please 🙌' },
    { me: false, t: 'Done! We\'ll reply with a fixed quote within 1 working day.' },
  ];
  function rr(px, py, w, h, r) { x.beginPath(); x.moveTo(px + r, py); x.arcTo(px + w, py, px + w, py + h, r); x.arcTo(px + w, py + h, px, py + h, r); x.arcTo(px, py + h, px, py, r); x.arcTo(px, py, px + w, py, r); x.closePath(); }
  function wrap(t, maxW) { const words = t.split(' '); const lines = []; let l = ''; for (const w of words) { const n = l ? l + ' ' + w : w; if (x.measureText(n).width > maxW) { lines.push(l); l = w; } else l = n; } lines.push(l); return lines; }
  function draw(shown, typing) {
    x.fillStyle = '#0b1b3a'; x.fillRect(0, 0, W, H);
    // header
    x.fillStyle = '#102349'; x.fillRect(0, 0, W, 190);
    x.fillStyle = '#2bcf8f'; x.beginPath(); x.arc(92, 118, 40, 0, 7); x.fill();
    x.fillStyle = '#0b1b3a'; x.font = '700 34px Inter, Arial'; x.textAlign = 'center'; x.fillText('eT', 92, 130); x.textAlign = 'left';
    x.fillStyle = '#f5f6f8'; x.font = '700 34px Inter, Arial'; x.fillText('e-Trust', 152, 112);
    x.fillStyle = '#2bcf8f'; x.font = '500 24px Inter, Arial'; x.fillText('● Online · replies fast', 152, 148);
    // bubbles from bottom
    x.font = '500 30px Inter, Arial';
    let y = H - 150;
    const items = msgs.slice(0, shown);
    if (typing) items.push({ me: false, typing: true });
    for (let i = items.length - 1; i >= 0; i--) {
      const m = items[i];
      const lines = m.typing ? [''] : wrap(m.t, 440);
      const bw = m.typing ? 140 : Math.max(...lines.map(l => x.measureText(l).width)) + 56;
      const bh = lines.length * 42 + 36;
      y -= bh;
      const bx = m.me ? W - 40 - bw : 40;
      x.fillStyle = m.me ? '#2bcf8f' : '#1a3463';
      rr(bx, y, bw, bh, 30); x.fill();
      if (m.typing) { x.fillStyle = '#a3b0cb'; [0, 1, 2].forEach(k => { x.beginPath(); x.arc(bx + 42 + k * 28, y + bh / 2, 8, 0, 7); x.fill(); }); }
      else { x.fillStyle = m.me ? '#0b1b3a' : '#f5f6f8'; lines.forEach((l, k) => x.fillText(l, bx + 28, y + 52 + k * 42)); }
      y -= 22;
      if (y < 220) break;
    }
    // input bar
    x.fillStyle = '#102349'; rr(36, H - 112, W - 72, 80, 40); x.fill();
    x.fillStyle = '#7f8db0'; x.font = '400 28px Inter, Arial'; x.fillText('Type a message…', 76, H - 62);
    x.fillStyle = '#2bcf8f'; x.beginPath(); x.arc(W - 80, H - 72, 30, 0, 7); x.fill();
    tex.needsUpdate = true;
  }

  // floating 3D bubbles around the phone
  const bubbles = [];
  const bubMat = (c) => new THREE.MeshPhysicalMaterial({ color: c, roughness: 0.25, metalness: 0.1, clearcoat: 1, transmission: 0 });
  [[1.6, 1.4, 0.6, 0x2bcf8f, 0.5], [-1.65, -0.4, 0.7, 0xf5f6f8, 0.42], [1.45, -1.55, 0.3, 0x5c77b0, 0.36]].forEach(([bx, by, bz, c, s], i) => {
    const g = new THREE.Group();
    const b = new THREE.Mesh(new RoundedBoxGeometry(1.5 * s, 1.0 * s, 0.32 * s, 6, 0.3 * s), bubMat(c));
    const tail = new THREE.Mesh(new THREE.ConeGeometry(0.16 * s, 0.32 * s, 12), bubMat(c));
    tail.position.set((i % 2 ? 0.45 : -0.45) * s, -0.58 * s, 0); tail.rotation.z = i % 2 ? -0.5 : 0.5;
    g.add(b, tail);
    const dotM = new THREE.MeshStandardMaterial({ color: c === 0xf5f6f8 ? 0x0b1b3a : 0xffffff });
    [-1, 0, 1].forEach(k => { const d = new THREE.Mesh(new THREE.SphereGeometry(0.075 * s / 0.45, 12, 8), dotM); d.scale.setScalar(s / 0.45 * 0.55); d.position.set(k * 0.3 * s, 0, 0.17 * s); g.add(d); });
    g.position.set(bx, by, bz); g.userData = { base: by, ph: i * 1.7 };
    root.add(g); bubbles.push(g);
  });

  let mobile = false;
  function size() {
    const r = canvas.getBoundingClientRect();
    R.setSize(r.width, r.height, false); cam.aspect = r.width / r.height; cam.updateProjectionMatrix();
    mobile = innerWidth < 900;
    if (mobile) { root.position.set(0, 0, 0); root.scale.setScalar(0.95); return; }
    // desktop/laptop: fit the phone (with its bubbles) into the free right part of the hero,
    // whatever the screen size or browser zoom, so it never covers the text or gets cut off
    const halfW = Math.tan(THREE.MathUtils.degToRad(cam.fov / 2)) * cam.position.z * cam.aspect;
    const s = Math.min(0.88, Math.max(0.5, (0.84 * halfW) / 4.6));
    root.scale.setScalar(s);
    root.position.set(Math.min(0.58 * halfW, halfW - 2.25 * s), -0.1, 0);
  }
  addEventListener('resize', size); size();

  const ptr = { x: 0, y: 0 };
  addEventListener('pointermove', e => { ptr.x = e.clientX / innerWidth - 0.5; ptr.y = e.clientY / innerHeight - 0.5; });

  let shown = reduce ? msgs.length : 1, typing = false, tAcc = 0;
  draw(shown, typing);
  const clock = new THREE.Clock();
  (function loop() {
    requestAnimationFrame(loop);
    const dt = Math.min(clock.getDelta(), 0.05), t = clock.elapsedTime;
    if (!reduce) {
      tAcc += dt;
      if (!typing && tAcc > 1.4 && shown < msgs.length) { typing = !msgs[shown].me; if (!typing) { shown++; } tAcc = 0; draw(shown, typing); }
      else if (typing && tAcc > 1.1) { typing = false; shown++; tAcc = 0; draw(shown, typing); }
      else if (shown >= msgs.length && tAcc > 4) { shown = 1; tAcc = 0; draw(shown, false); }
    }
    const idle = reduce ? 0 : 1;
    phone.rotation.y = -0.38 + ptr.x * 0.35 * idle + Math.sin(t * 0.5) * 0.05 * idle;
    phone.rotation.x = 0.06 + ptr.y * 0.2 * idle;
    phone.position.y = Math.sin(t * 0.8) * 0.08 * idle;
    bubbles.forEach(b => { b.position.y = b.userData.base + Math.sin(t * 1.1 + b.userData.ph) * 0.14 * idle; b.rotation.y = -0.3 + Math.sin(t * 0.7 + b.userData.ph) * 0.2 * idle; });
    R.render(scene, cam);
  })();
}
