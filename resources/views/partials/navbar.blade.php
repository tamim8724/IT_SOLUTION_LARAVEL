<div class="container-fluid bg-primary">
    <div class="container">
        <nav class="navbar navbar-dark navbar-expand-lg py-0">
            <a href="{{ url('/') }}" class="navbar-brand site-logo my-3" aria-label="e-trust.online home">
                <span class="site-logo-ink" aria-hidden="true"></span>
                <img src="{{ asset('img/logo-green.png') }}" alt="e-trust.online logo" width="900" height="210">
            </a>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                <div class="navbar-nav ms-auto mx-xl-auto p-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>
                    <a href="{{ url('/services') }}" class="nav-item nav-link {{ Request::is('services') ? 'active' : '' }}">Services</a>
                    <a href="{{ url('/projects') }}" class="nav-item nav-link {{ Request::is('projects') ? 'active' : '' }}">Projects</a>
                    <a href="{{ url('/team') }}" class="nav-item nav-link {{ Request::is('team') ? 'active' : '' }}">Team</a>
                    <a href="{{ url('/contact') }}" class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                </div>
            </div>

            <!-- Call box -->
            <div class="d-none d-xl-flex flex-shrink-0">
                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                    <a href="tel:{{ config('etrust.phone_tel') }}" class="position-relative animated tada infinite" aria-label="Call us">
                        <i class="fa fa-phone-alt text-white fa-2x"></i>
                        <div class="position-absolute" style="top: -7px; left: 20px;">
                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-column pe-4">
                    <span class="text-white-50">Have any questions?</span>
                    <a href="tel:{{ config('etrust.phone_tel') }}" class="text-secondary">Call: {{ config('etrust.phone') }}</a>
                </div>
            </div>
        </nav>
    </div>
</div>
