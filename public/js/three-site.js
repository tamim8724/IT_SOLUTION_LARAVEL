// e-Trust 3D site engine.
// Every page has one pinned 3D scene. Each section with data-k="name" has a pose in
// window.SCENE.poses[name] (and optional SCENE.mobile[name]); scrolling blends between poses.
// Pose = [x, y, z, a, b, c, scale, e1, e2]; what a, b, c, e1, e2 mean depends on the scene type.

import * as THREE from 'three';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';

const S = window.SCENE || { type: 'logo', poses: {}, mobile: {}, assets: {} };
const canvas = document.getElementById('gl');
const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

let renderer;
try {
  renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true, powerPreference: 'high-performance' });
} catch (e) {
  document.documentElement.classList.add('no-gl');
  throw e;
}
renderer.setPixelRatio(Math.min(devicePixelRatio, 2));
renderer.outputColorSpace = THREE.SRGBColorSpace;
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 1.05;

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(30, 1, 0.1, 100);
camera.position.set(0, 0.4, 11);
camera.lookAt(0, 0, 0);

const pmrem = new THREE.PMREMGenerator(renderer);
scene.environment = pmrem.fromScene(new RoomEnvironment(), 0.04).texture;

/* ---------- theme colours from CSS ---------- */
const css = getComputedStyle(document.body);
const cssColor = (n, f) => new THREE.Color((css.getPropertyValue(n) || '').trim() || f);
const TH = {
  accent: cssColor('--accent', '#2bcf8f'),
  accent2: cssColor('--accent2', '#0d43b0'),
  ink: cssColor('--ink', '#0c0e13'),
  stage: cssColor('--stage', '#e6e7ea'),
};
const hsl = {}; TH.stage.getHSL(hsl);
const DARK = hsl.l < 0.4;
const BRAND = { g: new THREE.Color('#2bcf8f'), b: new THREE.Color('#0d43b0') };

scene.add(new THREE.HemisphereLight(0xffffff, DARK ? 0x223044 : 0xb9bcc4, DARK ? 0.9 : 0.6));
const key = new THREE.DirectionalLight(0xffffff, 1.6); key.position.set(4, 6, 6); scene.add(key);
const rim = new THREE.DirectionalLight(DARK ? TH.accent2 : 0xbfd4ff, DARK ? 1.6 : 1.1); rim.position.set(-6, 2, -4); scene.add(rim);

/* ---------- helpers ---------- */
const deg = d => d * Math.PI / 180;
const lerp = (a, b, t) => a + (b - a) * t;
const clamp01 = v => Math.max(0, Math.min(1, v));
const phys = (color, o = {}) => new THREE.MeshPhysicalMaterial({ color, metalness: 0.15, roughness: 0.3, clearcoat: 1, clearcoatRoughness: 0.15, ...o });
const loader = new THREE.TextureLoader();
const tex = url => { const t = loader.load(url); t.colorSpace = THREE.SRGBColorSpace; t.anisotropy = 4; return t; };
const IMG = n => (S.assets && S.assets.img ? S.assets.img : '/img/') + n;

function roundedRect(w, h, r) {
  const s = new THREE.Shape(), x = -w / 2, y = -h / 2;
  s.moveTo(x + r, y); s.lineTo(x + w - r, y); s.quadraticCurveTo(x + w, y, x + w, y + r);
  s.lineTo(x + w, y + h - r); s.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
  s.lineTo(x + r, y + h); s.quadraticCurveTo(x, y + h, x, y + h - r);
  s.lineTo(x, y + r); s.quadraticCurveTo(x, y, x + r, y);
  return s;
}
function polyShape(pts) { return new THREE.Shape(pts.map(([x, y]) => new THREE.Vector2(x, y))); }
function extrude(shape, depth = 0.2, bevel = 0.03) {
  const g = new THREE.ExtrudeGeometry(shape, { depth, bevelEnabled: true, bevelThickness: bevel, bevelSize: bevel * 0.7, bevelSegments: 4, curveSegments: 18 });
  g.translate(0, 0, -depth / 2);
  return g;
}
function radialTexture(stops) {
  const c = document.createElement('canvas'); c.width = c.height = 256;
  const x = c.getContext('2d'); const g = x.createRadialGradient(128, 128, 0, 128, 128, 128);
  stops.forEach(([o, col]) => g.addColorStop(o, col)); x.fillStyle = g; x.fillRect(0, 0, 256, 256);
  return new THREE.CanvasTexture(c);
}

// Soft shadow + three brand stripes on the floor under an object.
function makeFloor(parent, y = -1.3, width = 3.2) {
  const g = new THREE.Group(); parent.add(g);
  const shadowMat = new THREE.MeshBasicMaterial({
    map: radialTexture(DARK ? [[0, 'rgba(0,0,0,0.75)'], [1, 'rgba(0,0,0,0)']] : [[0, 'rgba(0,0,0,0.38)'], [1, 'rgba(0,0,0,0)']]),
    transparent: true, depthWrite: false,
  });
  const shadow = new THREE.Mesh(new THREE.PlaneGeometry(width, width / 2), shadowMat);
  shadow.rotation.x = -Math.PI / 2; shadow.position.y = y; g.add(shadow);
  const stripes = new THREE.Group();
  [TH.accent, TH.accent2, DARK ? new THREE.Color('#ffffff') : new THREE.Color('#0b1f5c')].forEach((c, i) => {
    const m = new THREE.Mesh(new THREE.PlaneGeometry(13, 0.16), new THREE.MeshBasicMaterial({ color: c, transparent: true, depthWrite: false }));
    m.rotation.x = -Math.PI / 2; m.position.set(-2.5, y - 0.02, -0.55 - i * 0.2); stripes.add(m);
  });
  stripes.rotation.y = 0.42; g.add(stripes);
  return {
    group: g,
    set(st) {
      stripes.children.forEach(m => (m.material.opacity = st));
      stripes.position.x = (1 - st) * -4;
      shadowMat.opacity = 0.35 + st * 0.65;
    },
  };
}

/* =========================================================
   1. LOGO  (Home, 404)  pose: [x,y,z, rx,ry,rz, scale, colour 0 brand/1 silver/2 navy, stripes]
   ========================================================= */
function buildLogo() {
  const stage = new THREE.Group(); scene.add(stage);
  const logo = new THREE.Group(); stage.add(logo);
  const silver = { g: new THREE.Color('#f3f3f0'), b: new THREE.Color('#d9dbe0') };
  const navy = { g: new THREE.Color('#1d2c4f'), b: new THREE.Color('#0e1834') };
  const mats = { g: phys(BRAND.g.clone(), { metalness: 0.2, roughness: 0.26 }), b: phys(BRAND.b.clone(), { metalness: 0.2, roughness: 0.26 }) };
  fetch(S.assets.shapes).then(r => r.json()).then(sh => {
    for (const part of ['g', 'b']) for (const poly of sh[part === 'g' ? 'green' : 'blue']) {
      const shape = polyShape(poly.map(([x, y]) => [x * 2.2, y * 2.2]));
      const g = new THREE.ExtrudeGeometry(shape, { depth: 0.2, bevelEnabled: true, bevelThickness: 0.035, bevelSize: 0.022, bevelSegments: 5, curveSegments: 1 });
      g.translate(0, 0, -0.1);
      logo.add(new THREE.Mesh(g, mats[part]));
    }
  });
  // S.floor === false: no shadow/stripes under the logo (full-screen look)
  const floor = S.floor === false ? { set() {} } : makeFloor(stage);
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, colr, st] = p;
      // optional 10th value: opacity (lets text read clearly when the logo passes behind it)
      const op = p.length > 9 ? p[9] : 1;
      for (const m of [mats.g, mats.b]) { const tr = op < 0.999; if (m.transparent !== tr) { m.transparent = tr; m.depthWrite = !tr; m.needsUpdate = true; } m.opacity = op; }
      stage.position.set(x, y + Math.sin(t * 0.9) * 0.05 * idle, z);
      stage.scale.setScalar(sc);
      logo.rotation.set(rx + ptr.y * 0.12 * idle, ry + Math.sin(t * 0.5) * 0.06 * idle + ptr.x * 0.25 * idle, rz);
      const a = colr <= 1 ? BRAND : silver, b = colr <= 1 ? silver : navy, u = colr <= 1 ? colr : colr - 1;
      mats.g.color.copy(a.g).lerp(b.g, u); mats.b.color.copy(a.b).lerp(b.b, u);
      floor.set(st);
    },
  };
}

/* =========================================================
   2. GLOBE  (About)  pose: [x,y,z, focusLat, focusLon, tilt, scale, arcProgress 0..1, glow]
   ========================================================= */
function buildGlobe() {
  const R = 1.6;
  const root = new THREE.Group(); scene.add(root);
  const tilt = new THREE.Group(); root.add(tilt);
  const spin = new THREE.Group(); tilt.add(spin);
  const ll = (lat, lon, r = R) => {
    const phi = deg(90 - lat), th = deg(lon + 180);
    return new THREE.Vector3(-r * Math.sin(phi) * Math.cos(th), r * Math.cos(phi), r * Math.sin(phi) * Math.sin(th));
  };
  const core = new THREE.Mesh(new THREE.SphereGeometry(R * 0.985, 64, 48),
    new THREE.MeshStandardMaterial({ color: TH.stage.clone().offsetHSL(0, 0.05, 0.07), roughness: 0.9, metalness: 0.05, envMapIntensity: 0.35 }));
  spin.add(core);
  // atmosphere glow
  const glowMat = new THREE.ShaderMaterial({
    uniforms: { c: { value: TH.accent2.clone() }, k: { value: 1 } },
    vertexShader: 'varying vec3 n; void main(){ n = normalize(normalMatrix * normal); gl_Position = projectionMatrix * modelViewMatrix * vec4(position,1.0); }',
    fragmentShader: 'uniform vec3 c; uniform float k; varying vec3 n; void main(){ float i = pow(0.72 - dot(n, vec3(0.,0.,1.)), 3.0); gl_FragColor = vec4(c, 1.0) * i * k; }',
    side: THREE.BackSide, blending: THREE.AdditiveBlending, transparent: true, depthWrite: false,
  });
  tilt.add(new THREE.Mesh(new THREE.SphereGeometry(R * 1.18, 64, 48), glowMat));

  fetch(S.assets.dots).then(r => r.json()).then(arr => {
    const n = arr.length / 2;
    const inst = new THREE.InstancedMesh(new THREE.CircleGeometry(0.012, 6), new THREE.MeshBasicMaterial({ color: TH.accent }), n);
    const o = new THREE.Object3D();
    for (let i = 0; i < n; i++) {
      const v = ll(arr[i * 2], arr[i * 2 + 1], R * 1.002);
      o.position.copy(v); o.lookAt(v.clone().multiplyScalar(2)); o.updateMatrix(); inst.setMatrixAt(i, o.matrix);
    }
    spin.add(inst);
  });

  const CITIES = { dhaka: [23.81, 90.41], sydney: [-33.87, 151.21] };
  const pins = {};
  for (const [name, [la, lo]] of Object.entries(CITIES)) {
    const g = new THREE.Group(); const p = ll(la, lo);
    g.position.copy(p); g.lookAt(p.clone().multiplyScalar(2));
    const stick = new THREE.Mesh(new THREE.CylinderGeometry(0.008, 0.008, 0.28, 8), new THREE.MeshBasicMaterial({ color: 0xffffff }));
    stick.rotation.x = Math.PI / 2; stick.position.z = 0.14; g.add(stick);
    const head = new THREE.Mesh(new THREE.SphereGeometry(0.045, 16, 12), new THREE.MeshBasicMaterial({ color: name === 'dhaka' ? TH.accent : TH.accent2 }));
    head.position.z = 0.28; g.add(head);
    const ring = new THREE.Mesh(new THREE.RingGeometry(0.06, 0.08, 32), new THREE.MeshBasicMaterial({ color: name === 'dhaka' ? TH.accent : TH.accent2, transparent: true, side: THREE.DoubleSide }));
    ring.position.z = 0.005; g.add(ring);
    g.userData.ring = ring; pins[name] = g; spin.add(g);
  }
  // arc Dhaka -> Sydney
  const a = ll(...CITIES.dhaka).normalize(), b = ll(...CITIES.sydney).normalize();
  const pts = [];
  for (let i = 0; i <= 64; i++) {
    const t = i / 64; const v = new THREE.Vector3().copy(a).lerp(b, t).normalize();
    pts.push(v.multiplyScalar(R + 0.02 + Math.sin(Math.PI * t) * 0.55));
  }
  const curve = new THREE.CatmullRomCurve3(pts);
  const TUB = 160, RAD = 8;
  const arcGeo = new THREE.TubeGeometry(curve, TUB, 0.016, RAD, false);
  const arc = new THREE.Mesh(arcGeo, new THREE.MeshBasicMaterial({ color: 0xffffff }));
  spin.add(arc);
  const head = new THREE.Mesh(new THREE.SphereGeometry(0.05, 16, 12), new THREE.MeshBasicMaterial({ color: 0xffffff }));
  spin.add(head);
  const haloMat = new THREE.SpriteMaterial({ map: radialTexture([[0, 'rgba(255,255,255,0.9)'], [1, 'rgba(255,255,255,0)']]), color: TH.accent, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending });
  const halo = new THREE.Sprite(haloMat); halo.scale.setScalar(0.4); spin.add(halo);

  const lonAngle = lon => { const v = ll(0, lon); return -Math.atan2(v.x, v.z); };
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, fLat, fLon, tl, sc, prog, gl] = p;
      root.position.set(x, y + Math.sin(t * 0.7) * 0.04 * idle, z);
      root.scale.setScalar(sc);
      root.rotation.z = tl;
      tilt.rotation.x = deg(fLat) + ptr.y * 0.15 * idle;
      spin.rotation.y = lonAngle(fLon + Math.sin(t * 0.25) * 3 * idle) + ptr.x * 0.3 * idle;
      const pr = clamp01(prog);
      arcGeo.setDrawRange(0, Math.floor(pr * TUB) * RAD * 6);
      head.visible = halo.visible = pr > 0.01 && pr < 0.999;
      const hp = curve.getPointAt(Math.min(pr, 0.999)); head.position.copy(hp); halo.position.copy(hp);
      glowMat.uniforms.k.value = gl;
      for (const g of Object.values(pins)) {
        const s = 1 + ((t * 0.8) % 1) * 2.2; g.userData.ring.scale.setScalar(s); g.userData.ring.material.opacity = 1 - ((t * 0.8) % 1);
      }
    },
  };
}

/* =========================================================
   3. SERVICES RING  pose: [x,y,z, rx, ry, rz, scale, activeIndex 0..5, spread]
   ========================================================= */
function buildServices() {
  const root = new THREE.Group(); scene.add(root);
  const ring = new THREE.Group(); root.add(ring);
  const white = new THREE.Color('#f4f6f8'), dark = new THREE.Color('#14171c');
  const A = TH.accent, B = TH.accent2;

  function browser() {
    const g = new THREE.Group();
    g.add(new THREE.Mesh(extrude(roundedRect(1.9, 1.35, 0.12), 0.14), phys(A)));
    const scr = new THREE.Mesh(new THREE.PlaneGeometry(1.72, 1.02), new THREE.MeshStandardMaterial({ color: white, roughness: 0.6 }));
    scr.position.set(0, -0.09, 0.11); g.add(scr);
    [-0.78, -0.64, -0.5].forEach((x, i) => { const d = new THREE.Mesh(new THREE.CylinderGeometry(0.045, 0.045, 0.04, 20), new THREE.MeshStandardMaterial({ color: i === 0 ? B : white })); d.rotation.x = Math.PI / 2; d.position.set(x, 0.55, 0.11); g.add(d); });
    const blk = (w, h, x, y, c, zz = 0.13) => { const m = new THREE.Mesh(new THREE.BoxGeometry(w, h, 0.03), new THREE.MeshStandardMaterial({ color: c, roughness: 0.5 })); m.position.set(x, y, zz); g.add(m); };
    blk(1.5, 0.1, 0, 0.27, A);
    blk(0.72, 0.5, -0.38, -0.17, B, 0.16);
    [0.06, -0.08, -0.22].forEach(y => blk(0.6, 0.06, 0.42, y, dark));
    blk(0.34, 0.12, 0.29, -0.38, B);
    return g;
  }
  function code() {
    const g = new THREE.Group();
    const lt = polyShape([[-0.12, 0.55], [-0.62, 0], [-0.12, -0.55], [0.04, -0.42], [-0.36, 0], [0.04, 0.42]]);
    const l = new THREE.Mesh(extrude(lt, 0.24), phys(B)); l.position.x = -0.35; g.add(l);
    const r = new THREE.Mesh(extrude(lt, 0.24), phys(B)); r.rotation.y = Math.PI; r.position.x = 0.35; g.add(r);
    const sl = new THREE.Mesh(extrude(polyShape([[0.14, 0.66], [0.3, 0.66], [-0.14, -0.66], [-0.3, -0.66]]), 0.24), phys(A)); g.add(sl);
    return g;
  }
  function phone() {
    const g = new THREE.Group();
    g.add(new THREE.Mesh(extrude(roundedRect(0.98, 1.85, 0.16), 0.12), phys(dark)));
    const scr = new THREE.Mesh(new THREE.PlaneGeometry(0.84, 1.62), new THREE.MeshStandardMaterial({ color: white, roughness: 0.5 })); scr.position.z = 0.1; g.add(scr);
    [[0.48, A, 0.3], [0.0, B, 0.5], [-0.48, white, 0.7]].forEach(([y, c, z], i) => {
      const card = new THREE.Mesh(new RoundedBoxGeometry(0.78, 0.34, 0.05, 3, 0.04), phys(c)); card.position.set(i === 1 ? 0.22 : -0.1, y, z); card.userData.base = z; g.add(card);
    });
    return g;
  }
  function shield() {
    const g = new THREE.Group();
    const s = new THREE.Shape();
    s.moveTo(0, 0.9); s.quadraticCurveTo(0.45, 0.74, 0.78, 0.76); s.lineTo(0.78, 0.12);
    s.quadraticCurveTo(0.72, -0.56, 0, -0.98); s.quadraticCurveTo(-0.72, -0.56, -0.78, 0.12);
    s.lineTo(-0.78, 0.76); s.quadraticCurveTo(-0.45, 0.74, 0, 0.9);
    g.add(new THREE.Mesh(extrude(s, 0.2), phys(B)));
    const body = new THREE.Mesh(new RoundedBoxGeometry(0.52, 0.42, 0.18, 3, 0.05), phys(white)); body.position.set(0, -0.12, 0.22); g.add(body);
    const sh = new THREE.Mesh(new THREE.TorusGeometry(0.16, 0.05, 12, 32, Math.PI), phys(white, { metalness: 0.6, roughness: 0.2 })); sh.position.set(0, 0.09, 0.22); g.add(sh);
    const kh = new THREE.Mesh(new THREE.CylinderGeometry(0.05, 0.05, 0.05, 16), new THREE.MeshStandardMaterial({ color: dark })); kh.rotation.x = Math.PI / 2; kh.position.set(0, -0.1, 0.32); g.add(kh);
    return g;
  }
  function chart() {
    const g = new THREE.Group();
    [0.42, 0.68, 0.96, 1.28].forEach((h, i) => { const b = new THREE.Mesh(new RoundedBoxGeometry(0.24, h, 0.24, 3, 0.04), phys(i % 2 ? B : A)); b.position.set(-0.5 + i * 0.32, -0.65 + h / 2, 0); g.add(b); });
    const lens = new THREE.Group(); lens.position.set(0.32, 0.38, 0.42);
    lens.add(new THREE.Mesh(new THREE.TorusGeometry(0.32, 0.06, 16, 48), phys(white, { metalness: 0.5, roughness: 0.2 })));
    lens.add(new THREE.Mesh(new THREE.CircleGeometry(0.3, 40), new THREE.MeshPhysicalMaterial({ color: 0xffffff, transparent: true, opacity: 0.22, roughness: 0, clearcoat: 1 })));
    const handle = new THREE.Mesh(new THREE.CylinderGeometry(0.055, 0.055, 0.5, 16), phys(dark)); handle.position.set(0.32, -0.32, 0); handle.rotation.z = Math.PI / 4; lens.add(handle);
    g.add(lens);
    return g;
  }
  function gear(rOut, rIn, teeth, hole) {
    const s = new THREE.Shape(); const n = teeth * 4;
    for (let i = 0; i <= n; i++) {
      const a = (i / n) * Math.PI * 2; const r = (i % 4 < 2) ? rOut : rIn;
      const x = Math.cos(a) * r, y = Math.sin(a) * r; i ? s.lineTo(x, y) : s.moveTo(x, y);
    }
    const h = new THREE.Path(); h.absarc(0, 0, hole, 0, Math.PI * 2, true); s.holes.push(h);
    return s;
  }
  function gears() {
    const g = new THREE.Group();
    const big = new THREE.Mesh(extrude(gear(0.78, 0.6, 10, 0.22), 0.24), phys(A)); big.position.set(-0.18, 0.12, 0); big.userData.rot = 1; g.add(big);
    const small = new THREE.Mesh(extrude(gear(0.46, 0.34, 8, 0.13), 0.24), phys(B)); small.position.set(0.72, -0.62, 0.12); small.userData.rot = -1.25; g.add(small);
    return g;
  }

  function spark() {
    const g = new THREE.Group();
    const chip = new THREE.Mesh(new RoundedBoxGeometry(1.25, 1.25, 0.18, 4, 0.1), phys(dark)); g.add(chip);
    for (let i = 0; i < 4; i++) for (let side = 0; side < 4; side++) {
      const pin = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.2, 0.05), phys(white, { metalness: 0.8, roughness: 0.25 }));
      const off = -0.39 + i * 0.26, a = side * Math.PI / 2;
      pin.position.set(Math.cos(a) * 0.72 - Math.sin(a) * off, Math.sin(a) * 0.72 + Math.cos(a) * off, 0); pin.rotation.z = a + Math.PI / 2; g.add(pin);
    }
    const st = new THREE.Shape(); const P = 8;
    for (let i = 0; i <= P; i++) { const a = Math.PI / 2 + i * Math.PI * 2 / P; const r = i % 2 ? 0.14 : 0.5; const x = Math.cos(a) * r, y = Math.sin(a) * r; i ? st.lineTo(x, y) : st.moveTo(x, y); }
    const star = new THREE.Mesh(extrude(st, 0.14, 0.02), phys(A, { emissive: A, emissiveIntensity: 0.35 })); star.position.z = 0.18; star.userData.rot = 0.6; g.add(star);
    [[0.62, 0.62, 0.16], [-0.66, 0.5, 0.11], [0.5, -0.66, 0.1]].forEach(([x, y, r]) => {
      const sm = new THREE.Mesh(extrude(st, 0.08, 0.01), phys(B)); sm.scale.setScalar(r / 0.5); sm.position.set(x, y, 0.3); sm.userData.rot = -0.9; g.add(sm);
    });
    return g;
  }
  function pen() {
    const g = new THREE.Group();
    const nib = new THREE.Shape();
    nib.moveTo(0, -0.95); nib.lineTo(0.42, -0.1); nib.quadraticCurveTo(0.46, 0.25, 0.3, 0.42); nib.lineTo(-0.3, 0.42); nib.quadraticCurveTo(-0.46, 0.25, -0.42, -0.1); nib.lineTo(0, -0.95);
    const hole = new THREE.Path(); hole.absarc(0, -0.15, 0.09, 0, Math.PI * 2, true); nib.holes.push(hole);
    const n = new THREE.Mesh(extrude(nib, 0.16), phys(B)); n.rotation.z = -0.5; g.add(n);
    const cap = new THREE.Mesh(new RoundedBoxGeometry(0.7, 0.32, 0.22, 3, 0.06), phys(dark)); cap.position.set(0.24, 0.48, 0); cap.rotation.z = -0.5; g.add(cap);
    const curve = new THREE.CubicBezierCurve3(new THREE.Vector3(-1.0, -0.7, 0.1), new THREE.Vector3(-1.0, 0.6, 0.2), new THREE.Vector3(0.2, -1.0, 0.2), new THREE.Vector3(0.95, 0.75, 0.1));
    g.add(new THREE.Mesh(new THREE.TubeGeometry(curve, 60, 0.035, 8), phys(A)));
    [[-1.0, -0.7], [0.95, 0.75]].forEach(([x, y]) => { const h = new THREE.Mesh(new RoundedBoxGeometry(0.16, 0.16, 0.16, 2, 0.03), phys(white)); h.position.set(x, y, 0.1); g.add(h); });
    [A, B, white].forEach((c, i) => { const d = new THREE.Mesh(new THREE.CylinderGeometry(0.13, 0.13, 0.08, 32), phys(c)); d.rotation.x = Math.PI / 2; d.position.set(-0.75 + i * 0.32, 0.85, 0.2); d.userData.base = 0.2; g.add(d); });
    return g;
  }
  function cloud() {
    const g = new THREE.Group();
    const cm = phys(white, { roughness: 0.5, clearcoat: 0.3 });
    [[-0.45, 0.35, 0.42], [0.05, 0.55, 0.52], [0.5, 0.35, 0.4], [-0.15, 0.2, 0.45], [0.3, 0.18, 0.38]].forEach(([x, y, r]) => { const b = new THREE.Mesh(new THREE.SphereGeometry(r, 32, 24), cm); b.position.set(x, y, 0); b.scale.z = 0.6; g.add(b); });
    [-0.35, -0.72].forEach((y, i) => {
      const rack = new THREE.Mesh(new RoundedBoxGeometry(1.25, 0.3, 0.4, 3, 0.05), phys(i ? B : A)); rack.position.set(0.05, y, 0); g.add(rack);
      [0, 1, 2].forEach(k => { const led = new THREE.Mesh(new THREE.SphereGeometry(0.035, 12, 8), new THREE.MeshBasicMaterial({ color: k === 0 ? 0x2bff9a : 0xffffff })); led.position.set(-0.42 + k * 0.12, y, 0.21); g.add(led); });
      const slot = new THREE.Mesh(new THREE.BoxGeometry(0.5, 0.05, 0.02), new THREE.MeshBasicMaterial({ color: 0x0b0c0e })); slot.position.set(0.3, y, 0.21); g.add(slot);
    });
    return g;
  }

  const MAKERS = { browser, code, phone, shield, chart, gears, spark, pen, cloud };
  const items = (S.shapes && S.shapes.length ? S.shapes : ['browser', 'code', 'phone', 'shield', 'chart', 'gears']).map(n => (MAKERS[n] || browser)());
  const N = items.length;
  const cols = Math.ceil(N / 2);
  const grid = items.map((_, i) => { const r = i < cols ? 0 : 1; const ci = r ? i - cols : i; const cn = r ? N - cols : cols;
    return [(ci - (cn - 1) / 2) * 1.95 + (r ? 0.5 : 0), r ? -0.85 : 0.95, r ? 0.3 : 0]; });
  items.forEach((it, i) => { const holder = new THREE.Group(); holder.add(it); ring.add(holder); it.userData.i = i; });
  // pedestal
  const ped = new THREE.Group(); ped.position.set(0, -1.12, 0); root.add(ped);
  const top = new THREE.Mesh(new THREE.CylinderGeometry(1.35, 1.42, 0.16, 64), phys(new THREE.Color('#eef2f0'), { roughness: 0.35 })); ped.add(top);
  const rimM = new THREE.Mesh(new THREE.TorusGeometry(1.36, 0.035, 12, 96), new THREE.MeshStandardMaterial({ color: TH.accent2, emissive: TH.accent2, emissiveIntensity: 0.25 })); rimM.rotation.x = Math.PI / 2; rimM.position.y = 0.08; ped.add(rimM);
  const floor = S.floor === false ? { set() {} } : makeFloor(root, -1.6, 4.4);
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, act, spread] = p;
      root.position.set(x, y, z); root.scale.setScalar(sc);
      root.rotation.set(rx + ptr.y * 0.08 * idle, ptr.x * 0.15 * idle + ry, rz);
      const sp = clamp01(spread);
      ring.children.forEach((h, i) => {
        const it = h.children[0];
        const d = Math.abs(i - act);
        const focus = clamp01(1 - d * 1.6);
        const g = grid[i];
        h.position.set(lerp(0, g[0], sp), lerp(-0.15 + (1 - focus) * -0.9, g[1], sp), lerp(0, g[2], sp));
        it.scale.setScalar(lerp(focus * 1.35, 0.72, sp) + 0.0001);
        it.position.y = Math.sin(t * 1.1 + i) * 0.06 * idle;
        it.rotation.y = Math.sin(t * 0.6 + i) * 0.25 * idle - 0.25;
        it.traverse(o => { if (o.userData.rot) o.rotation.z = t * 0.6 * o.userData.rot; if (o.userData.base !== undefined) o.position.z = o.userData.base + Math.sin(t * 1.4 + o.position.y * 4) * 0.05 * idle; });
      });
      ped.scale.setScalar(Math.max(0.0001, 1 - sp));
      floor.set(spread);
    },
  };
}

/* =========================================================
   4. LAPTOP  (Projects)  pose: [x,y,z, rx,ry,rz, scale, lidOpen 0..1, screenIndex]
   ========================================================= */
function buildLaptop() {
  const root = new THREE.Group(); scene.add(root);
  const lap = new THREE.Group(); root.add(lap);
  const shell = phys(new THREE.Color(DARK ? '#c9ccd2' : '#2a2d33'), { metalness: 0.7, roughness: 0.32, clearcoat: 0.4 });
  const W = 3.2, D = 2.1;
  const base = new THREE.Mesh(new RoundedBoxGeometry(W, 0.12, D, 4, 0.05), shell); base.position.y = -0.06; lap.add(base);
  // keyboard texture
  const kc = document.createElement('canvas'); kc.width = 512; kc.height = 256; const kx = kc.getContext('2d');
  kx.fillStyle = '#1a1c20'; kx.fillRect(0, 0, 512, 256); kx.fillStyle = '#2c2f35';
  for (let r = 0; r < 5; r++) for (let c = 0; c < 14; c++) kx.fillRect(14 + c * 35, 14 + r * 46, 29, 38);
  const kb = new THREE.Mesh(new THREE.PlaneGeometry(2.7, 1.0), new THREE.MeshStandardMaterial({ map: new THREE.CanvasTexture(kc), roughness: 0.8 }));
  kb.rotation.x = -Math.PI / 2; kb.position.set(0, 0.001, -0.3); lap.add(kb);
  const pad = new THREE.Mesh(new THREE.PlaneGeometry(1.0, 0.55), new THREE.MeshStandardMaterial({ color: '#30333a', roughness: 0.5 }));
  pad.rotation.x = -Math.PI / 2; pad.position.set(0, 0.002, 0.62); lap.add(pad);
  const hinge = new THREE.Group(); hinge.position.set(0, 0.0, -D / 2 + 0.04); lap.add(hinge);
  const lid = new THREE.Mesh(new RoundedBoxGeometry(W, 2.05, 0.08, 4, 0.04), shell); lid.position.set(0, 1.025, -0.02); hinge.add(lid);
  const bezel = new THREE.Mesh(new THREE.PlaneGeometry(W - 0.12, 1.95), new THREE.MeshBasicMaterial({ color: '#0b0c0e' })); bezel.position.set(0, 1.025, 0.025); hinge.add(bezel);
  // Each project gets a simple "website" drawn on the laptop screen from its name, type, tags and colour.
  function screenTexture(p) {
    const c = document.createElement('canvas'); c.width = 1024; c.height = 640; const x = c.getContext('2d');
    const acc = p.accent || '#2bcf8f';
    x.fillStyle = '#f5f6f8'; x.fillRect(0, 0, 1024, 640);
    x.fillStyle = '#e4e6ea'; x.fillRect(0, 0, 1024, 46);
    ['#ff5f57', '#febc2e', '#28c840'].forEach((cl, i) => { x.fillStyle = cl; x.beginPath(); x.arc(28 + i * 24, 23, 7, 0, 7); x.fill(); });
    x.fillStyle = '#ffffff'; x.fillRect(120, 11, 600, 24); x.fillStyle = '#7a7f8a'; x.font = '15px Archivo, Arial'; x.fillText((p.url || '').replace(/^https?:\/\//, '').replace(/\/$/, '') || 'e-trust.online', 134, 28);
    const grd = x.createLinearGradient(0, 46, 1024, 420); grd.addColorStop(0, acc); grd.addColorStop(1, '#14161a');
    x.fillStyle = grd; x.fillRect(0, 46, 1024, 380);
    x.fillStyle = 'rgba(255,255,255,.85)'; x.font = '600 20px Archivo, Arial'; x.fillText((p.type || '').toUpperCase(), 60, 120);
    x.fillStyle = '#ffffff'; x.font = '78px Anton, Impact, sans-serif';
    const words = (p.title || '').toUpperCase().split(' '); let line = '', y = 210;
    words.forEach(w => { const t = line ? line + ' ' + w : w; if (x.measureText(t).width > 880) { x.fillText(line, 60, y); line = w; y += 84; } else line = t; });
    x.fillText(line, 60, y);
    x.fillStyle = '#ffffff'; x.beginPath(); x.roundRect ? x.roundRect(60, y + 34, 190, 50, 25) : x.rect(60, y + 34, 190, 50); x.fill();
    x.fillStyle = '#14161a'; x.font = '600 19px Archivo, Arial'; x.fillText('Visit site  \u2192', 86, y + 66);
    (p.tags || []).forEach((tg, i) => { const bx = 60 + i * 230; x.fillStyle = '#ffffff'; x.fillRect(bx, 470, 210, 120); x.fillStyle = acc; x.fillRect(bx, 470, 210, 8); x.fillStyle = '#20232a'; x.font = '600 20px Archivo, Arial'; x.fillText(tg, bx + 16, 520, 180); x.fillStyle = '#c9ccd3'; x.fillRect(bx + 16, 540, 150, 10); x.fillRect(bx + 16, 560, 110, 10); });
    const t = new THREE.CanvasTexture(c); t.colorSpace = THREE.SRGBColorSpace; t.anisotropy = 4;
    return t;
  }
  const textures = (S.projects || []).map(p => typeof p === 'string'
    ? (() => { const t = tex(IMG(p)); const r = (550 / 450) / (2.86 / 1.78); t.repeat.set(1, r); t.offset.set(0, (1 - r) / 2); return t; })()
    : screenTexture(p));
  // redraw once web fonts are ready so titles use Anton
  if (document.fonts) document.fonts.ready.then(() => (S.projects || []).forEach((p, i) => { if (typeof p !== 'string') { const n = screenTexture(p); textures[i].image = n.image; textures[i].needsUpdate = true; } }));
  const screenMat = new THREE.MeshBasicMaterial({ color: 0xffffff, map: textures[0] || null, toneMapped: false });
  const screen = new THREE.Mesh(new THREE.PlaneGeometry(2.86, 1.78), screenMat); screen.position.set(0, 1.04, 0.03); hinge.add(screen);
  const glowMat = new THREE.SpriteMaterial({ map: radialTexture([[0, 'rgba(255,255,255,0.55)'], [1, 'rgba(255,255,255,0)']]), color: TH.accent, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending });
  const glow = new THREE.Sprite(glowMat); glow.scale.set(6, 4, 1); glow.position.set(0, 1.1, -0.4); hinge.add(glow);
  const floor = makeFloor(root, -0.16, 5);
  let shown = 0;
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, open, idx] = p;
      root.position.set(x, y + Math.sin(t * 0.8) * 0.04 * idle, z); root.scale.setScalar(sc);
      lap.rotation.set(rx + ptr.y * 0.08 * idle, ry + ptr.x * 0.22 * idle + Math.sin(t * 0.4) * 0.05 * idle, rz);
      hinge.rotation.x = lerp(Math.PI / 2 - 0.02, -0.3, clamp01(open));
      const i = Math.max(0, Math.min(textures.length - 1, Math.round(idx)));
      if (textures.length && i !== shown) { shown = i; screenMat.map = textures[i]; screenMat.needsUpdate = true; }
      const f = 1 - Math.min(1, Math.abs(idx - Math.round(idx)) * 2.2); // dim between projects
      screenMat.color.setScalar(lerp(0.35, 1, f));
      glowMat.opacity = clamp01(open) * 0.9;
      floor.set(clamp01(open));
    },
  };
}

/* =========================================================
   5. TEAM RING  pose: [x,y,z, rx, ry, rz, scale, activeIndex, lines]
   ========================================================= */
function buildTeam() {
  const root = new THREE.Group(); scene.add(root);
  const ring = new THREE.Group(); root.add(ring);
  const photos = S.team || [];
  const N = Math.max(photos.length, 1), STEP = (Math.PI * 2) / N, Rr = 2.3;
  const holders = [];
  photos.forEach((n, i) => {
    const h = new THREE.Group(); const a = i * STEP;
    h.position.set(Math.sin(a) * Rr, 0, Math.cos(a) * Rr); h.rotation.y = a;
    const card = new THREE.Group(); h.add(card);
    const back = new THREE.Mesh(new THREE.CylinderGeometry(1.0, 1.0, 0.12, 64), phys(i % 2 ? TH.accent2 : TH.accent)); back.rotation.x = Math.PI / 2; back.position.z = -0.07; card.add(back);
    const face = new THREE.Mesh(new THREE.CircleGeometry(0.9, 64), new THREE.MeshBasicMaterial({ map: tex(IMG(n)), toneMapped: false })); face.position.z = 0.001; card.add(face);
    const rimM = new THREE.Mesh(new THREE.TorusGeometry(0.93, 0.04, 16, 80), phys(new THREE.Color('#ffffff'), { metalness: 0.4 })); rimM.position.z = 0.0; card.add(rimM);
    ring.add(h); holders.push(h);
  });
  // network lines between everyone
  const pts = [];
  holders.forEach((a, i) => holders.forEach((b, j) => { if (j > i) pts.push(a.position.clone(), b.position.clone()); }));
  const lineMat = new THREE.LineBasicMaterial({ color: TH.accent2, transparent: true, opacity: 0.5 });
  ring.add(new THREE.LineSegments(new THREE.BufferGeometry().setFromPoints(pts), lineMat));
  // floating particles
  const pg = new THREE.BufferGeometry(); const P = [];
  for (let i = 0; i < 160; i++) { const r = 3 + Math.random() * 2.5, a = Math.random() * Math.PI * 2, y = (Math.random() - 0.5) * 3; P.push(Math.sin(a) * r, y, Math.cos(a) * r); }
  pg.setAttribute('position', new THREE.Float32BufferAttribute(P, 3));
  const dots = new THREE.Points(pg, new THREE.PointsMaterial({ color: TH.accent, size: 0.05, transparent: true, opacity: 0.7 }));
  root.add(dots);
  const floor = S.floor === false ? { set() {} } : makeFloor(root, -1.45, 4.6);
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, act, ln] = p;
      root.position.set(x, y, z); root.scale.setScalar(sc);
      root.rotation.set(rx + ptr.y * 0.08 * idle, ptr.x * 0.15 * idle, rz);
      ring.rotation.y = -act * STEP + ry;
      dots.rotation.y = t * 0.03;
      holders.forEach((h, i) => {
        let d = Math.abs(i - act) % N; d = Math.min(d, N - d);
        h.children[0].scale.setScalar(lerp(1.15, 0.7, clamp01(d)));
        h.children[0].position.y = Math.sin(t * 1.1 + i * 1.7) * 0.07 * idle;
        // keep faces turned toward the camera a little
        h.children[0].rotation.y = -(h.rotation.y + ring.rotation.y) + ptr.x * 0.2 * idle; // always face the camera
      });
      lineMat.opacity = 0.15 + ln * 0.45;
      floor.set(ln);
    },
  };
}

/* =========================================================
   6. CONTACT: paper plane orbiting a location pin
   pose: [x,y,z, rx, ry, rz, scale, flightOffset, ringPulse]
   ========================================================= */
function buildContact() {
  const root = new THREE.Group(); scene.add(root);
  // platform with grid
  const gc = document.createElement('canvas'); gc.width = gc.height = 512; const gx = gc.getContext('2d');
  const grad = gx.createRadialGradient(256, 256, 40, 256, 256, 256);
  grad.addColorStop(0, 'rgba(255,255,255,0.9)'); grad.addColorStop(1, 'rgba(255,255,255,0)');
  gx.strokeStyle = 'rgba(255,255,255,0.35)'; gx.lineWidth = 2;
  for (let i = 0; i <= 512; i += 32) { gx.beginPath(); gx.moveTo(i, 0); gx.lineTo(i, 512); gx.stroke(); gx.beginPath(); gx.moveTo(0, i); gx.lineTo(512, i); gx.stroke(); }
  gx.globalCompositeOperation = 'destination-in'; gx.fillStyle = grad; gx.fillRect(0, 0, 512, 512);
  const grid = new THREE.Mesh(new THREE.CircleGeometry(3.2, 64), new THREE.MeshBasicMaterial({ map: new THREE.CanvasTexture(gc), color: TH.accent2, transparent: true, depthWrite: false }));
  grid.rotation.x = -Math.PI / 2; grid.position.y = -1.2; root.add(grid);
  // pin
  const pin = new THREE.Group(); root.add(pin);
  const head = new THREE.Mesh(new THREE.SphereGeometry(0.5, 48, 32), phys(TH.accent)); head.position.y = 0.55; pin.add(head);
  const cone = new THREE.Mesh(new THREE.ConeGeometry(0.42, 1.25, 48, 1, true), phys(TH.accent)); cone.rotation.x = Math.PI; cone.position.y = -0.33; pin.add(cone);
  const dot = new THREE.Mesh(new THREE.SphereGeometry(0.2, 32, 20), phys(new THREE.Color('#ffffff'))); dot.position.set(0, 0.6, 0.38); pin.add(dot);
  const pulse = new THREE.Mesh(new THREE.RingGeometry(0.3, 0.38, 48), new THREE.MeshBasicMaterial({ color: TH.accent, transparent: true, side: THREE.DoubleSide, depthWrite: false }));
  pulse.rotation.x = -Math.PI / 2; pulse.position.y = -1.18; root.add(pulse);
  // flight path
  const path = new THREE.CatmullRomCurve3([
    new THREE.Vector3(2.4, 0.4, 0), new THREE.Vector3(1.2, 1.3, 1.8), new THREE.Vector3(-1.4, 0.8, 1.9),
    new THREE.Vector3(-2.4, 0.1, 0), new THREE.Vector3(-1.0, 1.0, -1.9), new THREE.Vector3(1.5, 1.4, -1.6),
  ], true, 'catmullrom', 0.5);
  const line = new THREE.Line(new THREE.BufferGeometry().setFromPoints(path.getSpacedPoints(240)), new THREE.LineDashedMaterial({ color: DARK ? 0xffffff : 0x111111, dashSize: 0.08, gapSize: 0.08, transparent: true, opacity: 0.35 }));
  line.computeLineDistances(); root.add(line);
  // paper plane
  const pg = new THREE.BufferGeometry();
  const V = [0, 0, 0.75, -0.55, 0, -0.45, 0, 0.02, -0.4, 0, 0, 0.75, 0, 0.02, -0.4, 0.55, 0, -0.45, 0, 0, 0.75, 0, -0.2, -0.42, 0, 0.02, -0.4];
  pg.setAttribute('position', new THREE.Float32BufferAttribute(V, 3)); pg.computeVertexNormals();
  const plane = new THREE.Mesh(pg, new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 0.45, side: THREE.DoubleSide, flatShading: true }));
  root.add(plane);
  const look = new THREE.Vector3();
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, off, pl] = p;
      root.position.set(x, y, z); root.scale.setScalar(sc);
      root.rotation.set(rx + ptr.y * 0.1 * idle, ry + ptr.x * 0.25 * idle, rz);
      pin.position.y = Math.sin(t * 1.3) * 0.08 * idle; pin.rotation.y = t * 0.6 * idle;
      const u = ((off + (reduce ? 0 : t * 0.045)) % 1 + 1) % 1;
      const pos = path.getPointAt(u); plane.position.copy(pos);
      look.copy(pos).add(path.getTangentAt(u)); plane.lookAt(look);
      plane.rotateZ(Math.sin(t * 2) * 0.25);
      const k = (t * 0.6) % 1; pulse.scale.setScalar(1 + k * 4); pulse.material.opacity = (1 - k) * pl;
    },
  };
}

/* =========================================================
   7. DORKARI product ring  pose: [x,y,z, rx, ringYaw, rz, scale, active product, floor]
   ========================================================= */
function buildDorkari() {
  const root = new THREE.Group(); scene.add(root);
  const ring = new THREE.Group(); root.add(ring);
  const prods = S.products || [];
  const N = Math.max(prods.length, 1), STEP = (Math.PI * 2) / N, Rr = 2.9;
  function face(p) {
    const c = document.createElement('canvas'); c.width = c.height = 512; const x = c.getContext('2d');
    x.fillStyle = p.color; x.fillRect(0, 0, 512, 512);
    x.fillStyle = 'rgba(255,255,255,.22)'; x.beginPath(); x.arc(420, 90, 150, 0, 7); x.fill();
    x.fillStyle = '#1a1030'; x.textAlign = 'center';
    x.font = '600 118px "Hind Siliguri", sans-serif'; x.fillText(p.bn, 256, 290, 460);
    x.font = '600 46px Archivo, Arial, sans-serif'; x.fillText(p.name, 256, 390, 460);
    const t = new THREE.CanvasTexture(c); t.colorSpace = THREE.SRGBColorSpace; return t;
  }
  const tiles = prods.map((p, i) => {
    const h = new THREE.Group(); const a = i * STEP;
    h.position.set(Math.sin(a) * Rr, 0, Math.cos(a) * Rr); h.rotation.y = a;
    const box = new THREE.Mesh(new RoundedBoxGeometry(1.5, 1.5, 0.34, 5, 0.16), phys(new THREE.Color(p.color), { roughness: 0.35 }));
    h.add(box);
    const mat = new THREE.MeshBasicMaterial({ map: face(p), toneMapped: false });
    const front = new THREE.Mesh(new THREE.PlaneGeometry(1.3, 1.3), mat); front.position.z = 0.175; h.add(front);
    h.userData = { p, mat };
    ring.add(h); return h;
  });
  if (document.fonts) document.fonts.load('600 118px "Hind Siliguri"').then(() => tiles.forEach(h => { h.userData.mat.map = face(h.userData.p); h.userData.mat.needsUpdate = true; }));
  // centre: DORKARI core
  const core = new THREE.Mesh(new THREE.IcosahedronGeometry(0.75, 1), phys(TH.accent, { flatShading: true, metalness: 0.3 }));
  root.add(core);
  const halo = new THREE.Sprite(new THREE.SpriteMaterial({ map: radialTexture([[0, 'rgba(255,255,255,0.8)'], [1, 'rgba(255,255,255,0)']]), color: TH.accent, transparent: true, depthWrite: false, blending: THREE.AdditiveBlending }));
  halo.scale.setScalar(4); root.add(halo);
  const orbit = new THREE.Mesh(new THREE.TorusGeometry(Rr, 0.015, 8, 160), new THREE.MeshBasicMaterial({ color: TH.accent2, transparent: true, opacity: 0.5 }));
  orbit.rotation.x = Math.PI / 2; root.add(orbit);
  const floor = makeFloor(root, -1.5, 5);
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, act, fl] = p;
      root.position.set(x, y, z); root.scale.setScalar(sc);
      root.rotation.set(rx + ptr.y * 0.08 * idle, ptr.x * 0.15 * idle, rz);
      ring.rotation.y = -act * STEP + ry;
      core.rotation.set(t * 0.3, t * 0.45, 0);
      tiles.forEach((h, i) => {
        let d = Math.abs(i - act) % N; d = Math.min(d, N - d);
        h.scale.setScalar(lerp(1.15, 0.72, clamp01(d)));
        h.position.y = Math.sin(t * 1.2 + i) * 0.08 * idle;
      });
      floor.set(fl);
    },
  };
}

/* =========================================================
   8. AI ORB (Assistant)  pose: [x,y,z, rx, ry, rz, scale, energy, bubbles]
   ========================================================= */
function buildOrb() {
  const root = new THREE.Group(); scene.add(root);
  const inner = new THREE.Mesh(new THREE.SphereGeometry(1, 64, 48), new THREE.MeshPhysicalMaterial({ color: TH.accent, roughness: 0.15, metalness: 0.1, clearcoat: 1, iridescence: 1, iridescenceIOR: 1.6, sheen: 1, sheenColor: TH.accent2 }));
  root.add(inner);
  const wire = new THREE.LineSegments(new THREE.WireframeGeometry(new THREE.IcosahedronGeometry(1.45, 2)), new THREE.LineBasicMaterial({ color: TH.accent2, transparent: true, opacity: 0.45 }));
  root.add(wire);
  const nodes = new THREE.Points(new THREE.IcosahedronGeometry(1.45, 2), new THREE.PointsMaterial({ color: TH.accent, size: 0.07 }));
  root.add(nodes);
  const bubbles = new THREE.Group(); root.add(bubbles);
  const bub = (w, c, txtDark) => {
    const g = new THREE.Group();
    g.add(new THREE.Mesh(new RoundedBoxGeometry(w, 0.5, 0.14, 4, 0.12), phys(c)));
    const tail = new THREE.Mesh(new THREE.ConeGeometry(0.1, 0.22, 3), phys(c)); tail.rotation.z = Math.PI * 0.8; tail.position.set(-w / 2 + 0.18, -0.28, 0); g.add(tail);
    [0, 1, 2].forEach(k => { const d = new THREE.Mesh(new THREE.SphereGeometry(0.05, 12, 8), new THREE.MeshBasicMaterial({ color: txtDark ? 0x1b1d22 : 0xffffff })); d.position.set(-0.16 + k * 0.16, 0, 0.08); d.userData.k = k; g.add(d); });
    return g;
  };
  const B1 = bub(1.0, new THREE.Color('#ffffff'), true), B2 = bub(0.85, TH.accent2, false), B3 = bub(0.75, TH.accent, false);
  [B1, B2, B3].forEach((b, i) => { b.userData.a = i * 2.1; bubbles.add(b); });
  return {
    update(p, t, ptr, idle) {
      const [x, y, z, rx, ry, rz, sc, energy, bb] = p;
      root.position.set(x, y + Math.sin(t * 0.9) * 0.06 * idle, z); root.scale.setScalar(sc);
      root.rotation.set(rx + ptr.y * 0.1 * idle, ry + ptr.x * 0.3 * idle, rz);
      const pulse = 1 + Math.sin(t * 2.2) * 0.03 * energy * idle;
      inner.scale.setScalar(pulse);
      wire.rotation.set(t * 0.12, t * 0.18, 0); nodes.rotation.copy(wire.rotation);
      bubbles.children.forEach((b, i) => {
        const a = b.userData.a + t * 0.35 * idle;
        b.position.set(Math.cos(a) * 2.1, Math.sin(a * 1.3) * 0.7, Math.sin(a) * 2.1);
        b.lookAt(camera.position); b.scale.setScalar(bb);
        b.children.forEach(o => { if (o.userData.k !== undefined) o.position.y = Math.max(0, Math.sin(t * 6 - o.userData.k)) * 0.06; });
      });
    },
  };
}

const BUILDERS = { logo: buildLogo, globe: buildGlobe, services: buildServices, laptop: buildLaptop, team: buildTeam, contact: buildContact, dorkari: buildDorkari, orb: buildOrb };
const obj = (BUILDERS[S.type] || buildLogo)();

/* ---------- scroll choreography ---------- */
const sections = [...document.querySelectorAll('[data-k]')];
let anchors = [], mobile = false;
let mid = false; // laptops / tablets in landscape: optional S.mid poses
const pose = k => (mobile && S.mobile && S.mobile[k]) || (mid && S.mid && S.mid[k]) || (S.poses && S.poses[k]);
function layout() {
  const w = innerWidth, h = innerHeight;
  renderer.setSize(w, h, false);
  camera.aspect = w / h; camera.updateProjectionMatrix();
  mobile = w / h < 0.85;
  mid = !mobile && w / h < 1.5;
  anchors = sections
    .map(el => { const r = el.getBoundingClientRect(); return { k: el.dataset.k, at: r.top + scrollY + Math.min(r.height, h) * 0.5 }; })
    .filter(a => pose(a.k));
}
addEventListener('resize', layout);
const smooth = t => t * t * (3 - 2 * t);
function target() {
  if (!anchors.length) return null;
  const s = scrollY + innerHeight * 0.5;
  if (s <= anchors[0].at) return pose(anchors[0].k).slice();
  for (let i = 0; i < anchors.length - 1; i++) {
    const a = anchors[i], b = anchors[i + 1];
    if (s < b.at) { let t = smooth((s - a.at) / (b.at - a.at)); if (window.__shot) t = t < 0.5 ? 0 : 1; const pa = pose(a.k), pb = pose(b.k); return pa.map((v, j) => v + (pb[j] - v) * t); }
  }
  return pose(anchors[anchors.length - 1].k).slice();
}

layout();
const first = target() || [0, 0, 0, 0, 0, 0, 1, 0, 0];
const cur = first.slice();
const ptr = { x: 0, y: 0 };
addEventListener('pointermove', e => { ptr.x = e.clientX / innerWidth - 0.5; ptr.y = e.clientY / innerHeight - 0.5; });
let last = performance.now(), visible = true;
document.addEventListener('visibilitychange', () => { visible = !document.hidden; });
function frame(now) {
  requestAnimationFrame(frame);
  if (!visible) return;
  const dt = Math.min((now - last) / 1000, 0.05); last = now;
  const tgt = target() || cur;
  const k = reduce ? 1 : 1 - Math.exp(-dt * 5);
  for (let i = 0; i < cur.length; i++) cur[i] += (tgt[i] - cur[i]) * k;
  obj.update(cur, now / 1000, ptr, reduce ? 0 : 1);
  renderer.render(scene, camera);
}
requestAnimationFrame(frame);
if (document.fonts) document.fonts.ready.then(layout);
addEventListener('load', layout);
setTimeout(layout, 1200);
