@php
    // [x, y, z, rotX, rotY, rotZ, scale, flight offset 0..1, pulse]
    $scene = [
        'type' => 'contact',
        'poses' => [
            'hero'   => [2.4, -0.45, 0, 0.28, -0.3, 0, 0.82, 0, 1],
            'form'   => [2.9, -0.2, -1.5, 0.32, 0.5, 0, 0.72, 0.3, 1],
            'visit'  => [-2.6, -0.2, -0.5, 0.3, 1.1, 0, 0.78, 0.6, 1],
            'footer' => [-2.6, -0.2, -0.5, 0.3, 1.1, 0, 0.78, 0.8, 1],
        ],
        'mobile' => [
            'hero'   => [0, -1.85, 0, 0.3, -0.3, 0, 0.55, 0, 1],
            'form'   => [0, 2.9, -3, 0.3, 0.5, 0, 0.5, 0.3, 1],
            'visit'  => [0, 2.9, -3, 0.3, 1.1, 0, 0.5, 0.6, 1],
            'footer' => [0, 2.9, -3, 0.3, 1.1, 0, 0.5, 0.8, 1],
        ],
    ];
@endphp
@extends('layouts.three')

@section('title', 'Contact e-Trust | Web Design Company in Dhaka & Sydney')
@section('description', 'Contact e-Trust in Moghbazar, Dhaka. Call +880 1960 013601 or email info@e-trust.online for website design, development and SEO in Bangladesh or Sydney.')
@section('theme', 'contact')

@section('content')
<section class="story hero" data-k="hero">
    <div class="wrap">
        <p class="eyebrow" style="color:var(--accent)">Contact</p>
        <h1 class="display big" style="max-width:7em">Let's talk.</h1>
        <p class="lead" style="max-width:24ch">Tell us about your project. We reply as soon as we can.</p>
        <div class="contact-lines">
            <a href="tel:{{ config('etrust.phone_tel') }}"><small>Call us</small>{{ config('etrust.phone') }}</a>
            @if (config('etrust.contact.whatsapp'))
                <a href="https://wa.me/{{ config('etrust.contact.whatsapp') }}" target="_blank" rel="noopener noreferrer"><small>WhatsApp</small>Chat on WhatsApp</a>
            @endif
            <a href="mailto:{{ config('etrust.email') }}"><small>Email us</small>{{ config('etrust.email') }}</a>
            <p style="margin:0;font-size:16px"><small class="muted" style="display:block;font-size:14px">Office hours</small>{{ config('etrust.contact.hours') }}</p>
        </div>
    </div>
</section>

<section class="pad" id="message" data-k="form">
    <div class="wrap">
        <form method="POST" action="{{ route('contact.send') }}#message" class="form-card" novalidate>
            @csrf
            <h2 class="display mid">Send a message</h2>

            @if (session('contact_success'))
                <div class="alert ok" role="status">{{ session('contact_success') }}</div>
            @endif
            @if (session('contact_error'))
                <div class="alert bad" role="alert">{{ session('contact_error') }}</div>
            @endif

            <div class="hp" aria-hidden="true">
                <label for="website">Leave this empty</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="field">
                <label for="name">Your name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name" @class(['is-invalid' => $errors->has('name')])>
                @error('name')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
                <label for="email">Your email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="150" autocomplete="email" @class(['is-invalid' => $errors->has('email')])>
                @error('email')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
                <label for="phone">Phone or WhatsApp (optional)</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" maxlength="30" autocomplete="tel" @class(['is-invalid' => $errors->has('phone')])>
                @error('phone')<span class="err">{{ $message }}</span>@enderror
            </div>
            @php
                $picked = old('service', request('service'));
                $options = array_merge(array_column(config('etrust.services'), 'title'), ['DORKARI', 'Something else']);
            @endphp
            <div class="field">
                <label for="service">What do you need? (optional)</label>
                <select id="service" name="service" @class(['is-invalid' => $errors->has('service')])>
                    <option value="">Choose a service</option>
                    @foreach ($options as $opt)
                        <option value="{{ $opt }}" @selected($picked === $opt)>{{ $opt }}</option>
                    @endforeach
                </select>
                @error('service')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="field">
                <label for="message-text">Message</label>
                <textarea id="message-text" name="message" rows="6" required maxlength="5000" @class(['is-invalid' => $errors->has('message')])>{{ old('message') }}</textarea>
                @error('message')<span class="err">{{ $message }}</span>@enderror
            </div>
            <div class="actions"><button class="pill" type="submit">Send message <span>&rarr;</span></button></div>
        </form>
    </div>
</section>

<section class="pad right" data-k="visit" style="padding-bottom:16vh">
    <div class="wrap">
        <div class="col" style="max-width:560px">
            <div class="label">Visit Us</div>
            <p class="lead">{{ config('etrust.address') }}</p>
            <p class="body">Our office is in Moghbazar, Dhaka. We also work with clients in Sydney, Australia, online.</p>
            <iframe class="map-frame" title="e-Trust office location on Google Maps" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7303.476832652679!2d90.40558650601243!3d23.756705788272424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1772048692072!5m2!1sen!2sbd" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            <div class="actions"><a class="pill" href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer">Open in Google Maps <span>&rarr;</span></a></div>
        </div>
    </div>
</section>
@endsection
