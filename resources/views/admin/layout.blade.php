<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>@yield('title', 'Enquiries') · e-Trust admin</title>
<style>
:root{--navy:#0B1B3A;--navy2:#102349;--navy3:#14294F;--ink:#F5F6F8;--muted:#A3B0CB;--mint:#2BCF8F;--line:rgba(245,246,248,.1)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Inter,system-ui,sans-serif;background:var(--navy);color:var(--ink);font-size:15px;line-height:1.5}
a{color:inherit}
.top{display:flex;align-items:center;gap:16px;padding:14px clamp(16px,3vw,32px);border-bottom:1px solid var(--line);background:var(--navy2)}
.top b{font-size:17px}.top b span{color:var(--mint)}
.top form{margin-left:auto}
.wrap{max-width:1200px;margin:0 auto;padding:24px clamp(16px,3vw,32px)}
h1{font-size:26px;margin-bottom:16px}
.btn{display:inline-flex;align-items:center;height:40px;padding:0 16px;border-radius:999px;border:1px solid var(--line);background:transparent;color:var(--ink);font:inherit;font-weight:600;cursor:pointer;text-decoration:none}
.btn.pri{background:var(--mint);color:var(--navy);border-color:var(--mint)}
.pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px}
.pills a{text-decoration:none;padding:7px 14px;border-radius:999px;border:1px solid var(--line);font-weight:600;font-size:14px}
.pills a.on{background:var(--mint);color:var(--navy);border-color:var(--mint)}
.pills small{opacity:.7;margin-left:4px}
.bar{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px}
input,select,textarea{font:inherit;color:var(--ink);background:var(--navy3);border:1px solid var(--line);border-radius:10px;height:40px;padding:0 12px}
textarea{height:auto;padding:10px 12px;width:100%}
table{width:100%;border-collapse:collapse;background:var(--navy2);border-radius:14px;overflow:hidden}
th,td{text-align:left;padding:12px 14px;border-bottom:1px solid var(--line);vertical-align:top}
th{font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:var(--muted)}
tr:hover td{background:var(--navy3)}
.st{display:inline-block;font-size:12px;font-weight:700;padding:3px 10px;border-radius:999px}
.st-new{background:rgba(43,207,143,.15);color:var(--mint)}.st-replied{background:rgba(111,155,255,.15);color:#9bb8ff}
.st-won{background:rgba(255,197,107,.15);color:#ffc56b}.st-lost{background:rgba(245,246,248,.08);color:var(--muted)}
.muted{color:var(--muted)}
.card{background:var(--navy2);border:1px solid var(--line);border-radius:14px;padding:20px}
.grid{display:grid;grid-template-columns:1.4fr .6fr;gap:16px}
dl div{display:flex;gap:12px;padding:8px 0;border-bottom:1px solid var(--line)}dl dt{width:110px;color:var(--muted);flex:none}
.ok{background:rgba(43,207,143,.12);color:var(--mint);padding:10px 14px;border-radius:10px;margin-bottom:14px}
.err{color:#ff9b9b;font-size:14px;margin-top:6px}
nav[role=navigation]{margin-top:16px}
@media (max-width:800px){.grid{grid-template-columns:1fr}.hide-m{display:none}}
.tag{display:inline-block;font-size:11px;font-weight:700;padding:2px 8px;border-radius:999px;background:rgba(163,176,203,.15);color:#c9d2e6;margin-left:4px;vertical-align:middle}.tag.ok{background:rgba(43,207,143,.15);color:var(--mint)}.tag.warn{background:rgba(240,180,60,.15);color:#f0c46a}
</style>
</head>
<body>
@auth
<div class="top"><b>e-trust<span>.</span>online · admin</b>
<form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn">Log out</button></form></div>
@endauth
<div class="wrap">@yield('content')</div>
</body>
</html>
