@php
    // [x, y, z, rotX, rotY, rotZ, scale, energy, bubble size]
    $scene = [
        'type' => 'orb',
        'poses' => [
            'chat'   => [-3.4, -1.75, -1.5, 0.1, 0.4, 0, 0.62, 1, 0.8],
            'how'    => [2.4, -0.1, 0, 0.15, -0.3, 0, 1.05, 1.4, 1],
            'biz'    => [-3.4, -0.2, -1.2, 0.1, 0.5, 0, 0.85, 1, 0.9],
            'footer' => [-3.4, -0.2, -1.2, 0.1, 0.5, 0, 0.85, 1, 0.9],
        ],
        'mobile' => [
            'chat'   => [1.35, 3.0, -3, 0.1, 0.4, 0, 0.42, 1, 0.6],
            'how'    => [0, -2.1, 0, 0.15, -0.3, 0, 0.62, 1.4, 0.8],
            'biz'    => [0, -2.1, 0, 0.1, 0.5, 0, 0.6, 1, 0.8],
            'footer' => [0, -2.1, 0, 0.1, 0.5, 0, 0.6, 1, 0.8],
        ],
    ];
@endphp
@extends('layouts.three')

@section('title', 'Free AI assistant in Bangla and English')
@section('description', 'Chat with the e-Trust AI assistant for free. Ask questions in Bangla or English about study, business, writing, coding and staying safe online.')
@section('theme', 'assistant')
@section('hide_widget', '1')

@section('content')
<section class="pad" data-k="chat" style="padding-top:calc(var(--nav-h) + 32px);min-height:100svh">
    <div class="wrap assist">
        <div>
            <p class="eyebrow" style="color:var(--accent)">Free AI Assistant</p>
            <h1 class="display mid">Ask anything. <span lang="bn" style="display:block;text-transform:none;font-family:'Hind Siliguri',sans-serif;font-size:.62em;line-height:1.25;color:var(--accent)">যেকোনো প্রশ্ন করুন।</span></h1>
            <p class="body" style="color:inherit;font-size:18px">The e-Trust AI assistant is free for everyone. Write in Bangla, Banglish or English and get a clear answer in seconds.</p>
            <ul class="checks" style="font-size:16px">
                <li>Explain a topic for your exam</li>
                <li>Write a post, email or CV</li>
                <li>Plan a small business idea</li>
                <li>Fix a coding error</li>
                <li>Stay safe from online scams</li>
            </ul>
            <p class="muted" style="font-size:14px;margin-top:22px;max-width:46ch">Please don't share passwords, bank details or other private information. Need a person? <a href="{{ url('/contact') }}">Contact our team</a>.</p>
        </div>
        <div>
            @include('partials3d.chatbox', ['variant' => 'page'])
        </div>
    </div>
</section>

<section class="story" data-k="how" style="justify-content:center">
    <div class="wrap">
        <div class="col">
            <div class="label">How it works</div>
            <p class="lead">Built by e-Trust in Dhaka, answering in your language.</p>
            <ul class="checks">
                <li>Replies in the language you write in: Bangla, Banglish or English</li>
                <li>Free with a fair-use limit, so it stays fast for everyone</li>
                <li>Knows about e-Trust services and DORKARI</li>
                <li>Your chat stays in this browser tab only</li>
            </ul>
        </div>
    </div>
</section>

<section class="story right" data-k="biz" style="justify-content:center">
    <div class="wrap">
        <div class="col">
            <div class="label">For your business</div>
            <h2 class="display mid" style="margin-top:20px">Want an AI assistant like this?</h2>
            <p class="body" style="color:inherit;font-size:19px">We build AI chat assistants for websites that answer your customers in Bangla and English, around the clock, plus document and workflow automation.</p>
            <div class="actions">
                <a class="pill" href="{{ url('/contact') }}?service=AI%20%26%20automation#message">Talk to us <span>&rarr;</span></a>
                <a class="ghost" href="{{ url('/services') }}#s3">AI &amp; automation</a>
            </div>
        </div>
    </div>
</section>
@endsection
