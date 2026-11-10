@extends('layouts.site')
@section('title', 'Page not found | e-Trust')
@section('description', 'This page could not be found on e-trust.online.')
@section('page', '404')
@section('page_css', 'home')
@section('body_class', 'err-page')
@section('robots', 'noindex')
@section('content')
<section class="nf"><div class="wrap">
  <p class="nf-code" aria-hidden="true">404</p>
  <h1>This page took a wrong turn.</h1>
  <p class="nf-sub">The link may be old, or the page has moved. Here are some places to go instead.</p>
  <div class="nf-acts">
    <a class="btn btn-pri" href="{{ url('/') }}">Back to home <i>→</i></a>
    <a class="btn btn-sec" href="{{ url('/services') }}">See our services</a>
    <a class="btn btn-sec" href="{{ url('/contact') }}">Contact us</a>
  </div>
</div></section>
<style>
.nf{min-height:calc(100vh - 72px);display:flex;align-items:center;padding:60px 0;background:#E6E7EA}
.nf-code{font-weight:800;font-size:clamp(90px,16vw,200px);line-height:.9;letter-spacing:-.05em;background:linear-gradient(90deg,#2BCF8F,#0D43B0);-webkit-background-clip:text;background-clip:text;color:transparent}
.nf h1{font-size:clamp(32px,4.4vw,60px);font-weight:800;margin:18px 0 12px;max-width:14em}
.nf-sub{font-size:18px;color:#4A5160;max-width:44ch}
.nf-acts{display:flex;flex-wrap:wrap;gap:12px;margin-top:28px}
</style>
@endsection
