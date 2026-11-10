@extends('layouts.site')
@section('title', 'Free AI Assistant in Bangla & English | e-Trust')
@section('description', 'Chat with the free e-Trust AI assistant: ask anything in Bangla, Banglish or English. Want one for your business? e-Trust builds AI chat assistants.')
@section('page', 'assistant')
@section('page_css', 'assistant')
@section('body_class', 'navy ai-page')
@section('content')
<section class="ai-hero"><div class="wrap">
  <div class="label">Free AI Assistant</div>
  <h1>Ask anything.<span lang="bn">যেকোনো প্রশ্ন করুন।</span></h1>
  <p>The e-Trust AI assistant is free for everyone. Write in Bangla, Banglish or English and get a clear answer in seconds.</p>
</div></section>

<section class="ai-main" aria-label="Chat"><div class="wrap">
  <div id="etChat"></div>
</div></section>

<section class="ai-sec"><div class="wrap">
  <div class="label">How it works</div>
  <h2>Built by e-Trust in Dhaka, answering in your language.</h2>
  <div class="how4">
    <div><b aria-hidden="true">অ</b><p>Replies in the language you write in: Bangla, Banglish or English</p></div>
    <div><b aria-hidden="true">✓</b><p>Free with a fair-use limit, so it stays fast for everyone</p></div>
    <div><b aria-hidden="true">eT</b><p>Knows about e-Trust's services, prices and process</p></div>
    <div><b aria-hidden="true">🔒</b><p>Your chat stays in this browser tab only</p></div>
  </div>
</div></section>

<section class="ai-sec"><div class="wrap biz">
  <div>
    <div class="label">For your business</div>
    <h2>Want an AI assistant like this?</h2>
    <p class="lead">We build AI chat assistants for websites that answer your customers in Bangla and English, around the clock, plus document and workflow automation.</p>
    <div class="acts"><a class="btn btn-pri" href="#" data-lead>Talk to us <i>→</i></a></div>
  </div>
  <div class="uses">
    <div><i aria-hidden="true">🛍️</i><h3>Shops</h3><p>Answers price, stock and delivery questions, and takes orders.</p></div>
    <div><i aria-hidden="true">🍽️</i><h3>Restaurants</h3><p>Shares the menu, opening hours and takes table bookings.</p></div>
    <div><i aria-hidden="true">🩺</i><h3>Clinics</h3><p>Books appointments and answers common patient questions.</p></div>
    <div><i aria-hidden="true">🎓</i><h3>Schools &amp; coaching</h3><p>Explains courses, fees and admission steps to parents.</p></div>
  </div>
</div></section>
@endsection
@push('scripts')
<script>
document.querySelectorAll('[data-lead]').forEach(function(a){a.addEventListener('click',function(e){e.preventDefault();var c=document.getElementById('etChat');c.scrollIntoView({behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'auto':'smooth',block:'center'});if(window.etChat)window.etChat.leadCard();});});
</script>
@endpush
