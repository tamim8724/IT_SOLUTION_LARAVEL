<footer class="footer panel" data-k="footer">
    <div class="wrap">
        <a class="foot-brand" href="{{ url('/') }}" aria-label="e-trust.online home">
            @include('partials3d.mark')
            <span>e-trust<b>.</b>online<small>e-Trust IT Solutions</small></span>
        </a>
        <div class="foot-grid">
            <div>
                <a href="tel:{{ config('etrust.phone_tel') }}">{{ config('etrust.phone') }}</a>
                <a class="sub" href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer">{{ config('etrust.address') }}</a>
                <a class="sub" href="mailto:{{ config('etrust.email') }}">{{ config('etrust.email') }}</a>
            </div>
            <div>
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/services') }}">Services</a>
                <a href="{{ url('/projects') }}">Projects</a>
                <a href="{{ url('/dorkari') }}">DORKARI</a>
                <a href="{{ url('/team') }}">Team</a>
                <a href="{{ url('/assistant') }}">AI Assistant</a>
                <a href="{{ url('/contact') }}">Contact</a>
            </div>
            <div>
                <a href="{{ config('etrust.facebook') }}" target="_blank" rel="noopener noreferrer">Facebook</a>
                @if (config('etrust.contact.whatsapp'))
                    <a href="https://wa.me/{{ config('etrust.contact.whatsapp') }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                @endif
                <a href="{{ config('etrust.dorkari.url') }}" target="_blank" rel="noopener noreferrer">dorkari.e-trust.online</a>
                <p class="sub hours">{{ config('etrust.contact.hours') }}</p>
            </div>
        </div>
        <p class="fine">&copy; {{ date('Y') }} e-trust.online. All rights reserved. Developed by Md Muktadir Anik &amp; Tamim Ahmed.</p>
    </div>
</footer>
