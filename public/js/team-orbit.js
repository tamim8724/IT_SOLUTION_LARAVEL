import * as THREE from 'three';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';

const canvas = document.getElementById('teamgl');
if (canvas) {
  const shot = !!window.__shot;
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches && !shot;
  const R = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
  R.setPixelRatio(Math.min(devicePixelRatio, 2));
  R.outputColorSpace = THREE.SRGBColorSpace;
  R.toneMapping = THREE.ACESFilmicToneMapping;
  const scene = new THREE.Scene();
  const pm = new THREE.PMREMGenerator(R);
  scene.environment = pm.fromScene(new RoomEnvironment(), 0.04).texture;
  const cam = new THREE.PerspectiveCamera(32, 1, 0.1, 100);
  cam.position.set(0, 0.6, 12);
  scene.add(new THREE.AmbientLight(0xffffff, 0.35));
  const key = new THREE.DirectionalLight(0xffffff, 1.4); key.position.set(3, 5, 6); scene.add(key);
  const glow = new THREE.PointLight(0x2bcf8f, 30, 10); scene.add(glow);

  const MINT = 0x2bcf8f;
  const root = new THREE.Group(); scene.add(root);

  // core: faceted gem + wire shell
  const core = new THREE.Group(); root.add(core);
  const gem = new THREE.Mesh(new THREE.IcosahedronGeometry(1.15, 1),
    new THREE.MeshPhysicalMaterial({ color: 0x1d3a6e, emissive: 0x0b3a3a, emissiveIntensity: 0.6, metalness: 0.5, roughness: 0.2, clearcoat: 1, flatShading: true }));
  core.add(gem);
  const wire = new THREE.Mesh(new THREE.IcosahedronGeometry(1.5, 1),
    new THREE.MeshBasicMaterial({ color: MINT, wireframe: true, transparent: true, opacity: 0.35 }));
  core.add(wire);
  const halo = new THREE.Mesh(new THREE.SphereGeometry(0.62, 32, 16),
    new THREE.MeshBasicMaterial({ color: MINT, transparent: true, opacity: 0.9 }));
  core.add(halo);

  // label sprite
  function label(text) {
    const c = document.createElement('canvas'); c.width = 512; c.height = 128;
    const g = c.getContext('2d');
    g.font = '700 54px Inter, system-ui, sans-serif';
    const w = Math.min(500, g.measureText(text).width + 70);
    const x0 = (512 - w) / 2;
    g.fillStyle = 'rgba(16,35,73,.92)'; g.strokeStyle = 'rgba(43,207,143,.8)'; g.lineWidth = 4;
    g.beginPath(); g.roundRect(x0, 20, w, 88, 44); g.fill(); g.stroke();
    g.fillStyle = '#F5F6F8'; g.textAlign = 'center'; g.textBaseline = 'middle'; g.fillText(text, 256, 66);
    const t = new THREE.CanvasTexture(c); t.colorSpace = THREE.SRGBColorSpace;
    const s = new THREE.Sprite(new THREE.SpriteMaterial({ map: t, transparent: true, depthWrite: false }));
    s.scale.set(2.2, 0.55, 1);
    return s;
  }

  // four orbiting team nodes
  const roles = ['Direction', 'Clients', 'People', 'Delivery'];
  const nodes = [];
  const lineMat = new THREE.LineBasicMaterial({ color: MINT, transparent: true, opacity: 0.55 });
  roles.forEach((r, i) => {
    const orbit = new THREE.Group();
    orbit.rotation.x = 1.15 + (i % 2 ? 0.25 : -0.2);
    orbit.rotation.y = i * 0.5;
    root.add(orbit);
    const ring = new THREE.Mesh(new THREE.TorusGeometry(3.1, 0.008, 6, 160),
      new THREE.MeshBasicMaterial({ color: 0xa3b0cb, transparent: true, opacity: 0.22 }));
    orbit.add(ring);
    const ball = new THREE.Mesh(new THREE.SphereGeometry(0.34, 32, 16),
      new THREE.MeshPhysicalMaterial({ color: MINT, emissive: MINT, emissiveIntensity: 0.55, roughness: 0.25, metalness: 0.1, clearcoat: 1 }));
    orbit.add(ball);
    const tag = label(r); scene.add(tag);
    const geo = new THREE.BufferGeometry().setFromPoints([new THREE.Vector3(), new THREE.Vector3()]);
    const ln = new THREE.Line(geo, lineMat); scene.add(ln);
    nodes.push({ orbit, ball, tag, ln, a: i * Math.PI / 2 + 0.4, sp: 0.16 + i * 0.02 });
  });
  // ring linking the nodes
  const loopGeo = new THREE.BufferGeometry().setFromPoints(Array.from({ length: 5 }, () => new THREE.Vector3()));
  const loop = new THREE.Line(loopGeo, new THREE.LineBasicMaterial({ color: MINT, transparent: true, opacity: 0.18 }));
  scene.add(loop);

  // dust
  const N = 260, pos = new Float32Array(N * 3);
  for (let i = 0; i < N; i++) {
    const r = 3 + Math.random() * 3.5, t = Math.random() * 6.283, p = Math.acos(2 * Math.random() - 1);
    pos[i * 3] = r * Math.sin(p) * Math.cos(t); pos[i * 3 + 1] = r * Math.cos(p) * 0.7; pos[i * 3 + 2] = r * Math.sin(p) * Math.sin(t);
  }
  const dg = new THREE.BufferGeometry(); dg.setAttribute('position', new THREE.BufferAttribute(pos, 3));
  const dust = new THREE.Points(dg, new THREE.PointsMaterial({ color: 0xa3b0cb, size: 0.035, transparent: true, opacity: 0.6 }));
  root.add(dust);

  // sizing
  function size() {
    const w = canvas.clientWidth, h = canvas.clientHeight;
    if (!w || !h) return;
    R.setSize(w, h, false); cam.aspect = w / h;
    cam.position.z = w / h < 0.9 ? 15 : 12.5;
    cam.updateProjectionMatrix();
  }
  addEventListener('resize', size); size();

  let mx = 0, my = 0;
  addEventListener('pointermove', e => { mx = e.clientX / innerWidth - 0.5; my = e.clientY / innerHeight - 0.5; });

  const v = new THREE.Vector3(), clock = new THREE.Clock();
  let visible = true;
  new IntersectionObserver(es => { visible = es[0].isIntersecting; }).observe(canvas);

  function frame(t) {
    core.rotation.y = t * 0.25; core.rotation.x = Math.sin(t * 0.4) * 0.2;
    wire.rotation.y = -t * 0.18;
    halo.scale.setScalar(1 + Math.sin(t * 2) * 0.06);
    root.rotation.y += ((mx * 0.5) - root.rotation.y) * 0.04;
    root.rotation.x += ((my * 0.3) - root.rotation.x) * 0.04;
    dust.rotation.y = t * 0.03;
    const pts = [];
    nodes.forEach(n => {
      const a = n.a + t * n.sp;
      n.ball.position.set(Math.cos(a) * 3.1, Math.sin(a) * 3.1, 0);
      n.ball.getWorldPosition(v);
      n.tag.position.copy(v).add(new THREE.Vector3(0, 0.62, 0));
      const p = n.ln.geometry.attributes.position;
      p.setXYZ(0, 0, 0, 0); p.setXYZ(1, v.x, v.y, v.z); p.needsUpdate = true;
      pts.push(v.clone());
    });
    pts.push(pts[0]);
    const lp = loop.geometry.attributes.position;
    pts.forEach((q, i) => lp.setXYZ(i, q.x, q.y, q.z)); lp.needsUpdate = true;
    R.render(scene, cam);
  }

  if (shot || reduce) { frame(2.2); }
  else {
    R.setAnimationLoop(() => { if (visible) frame(clock.getElapsedTime()); });
  }
}
