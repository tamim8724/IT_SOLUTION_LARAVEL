<div class="container-fluid footer bg-dark wow fadeIn" data-wow-delay=".3s">
    <div class="container pt-5 pb-4">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}" class="site-logo" aria-label="e-trust.online home">
                    <span class="site-logo-ink" aria-hidden="true"></span>
                    <img src="{{ asset('img/logo-green.png') }}" alt="e-trust.online logo" width="900" height="210" loading="lazy">
                </a>
                <p class="mt-4 text-light">e-Trust is a Dhaka-based IT solutions firm offering web design, development, security, and digital marketing services that help businesses grow.</p>
                <div class="d-flex hightech-link">
                    <a href="{{ config('etrust.facebook') }}" target="_blank" rel="noopener noreferrer" class="btn-light nav-fill btn btn-square rounded-circle me-0" aria-label="e-Trust on Facebook"><i class="fab fa-facebook-f text-primary"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <span class="h3 text-secondary">Quick Links</span>
                <div class="mt-4 d-flex flex-column short-link">
                    <a href="{{ url('/about') }}" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>About Us</a>
                    <a href="{{ url('/services') }}" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Our Services</a>
                    <a href="{{ url('/projects') }}" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Our Projects</a>
                    <a href="{{ url('/team') }}" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Our Team</a>
                    <a href="{{ url('/contact') }}" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Contact Us</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <span class="h3 text-secondary">Contact</span>
                <div class="mt-4 d-flex flex-column short-link">
                    <a href="{{ config('etrust.map_url') }}" target="_blank" rel="noopener noreferrer" class="mb-2 text-white"><i class="fas fa-map-marker-alt text-secondary me-2"></i>{{ config('etrust.address') }}</a>
                    <a href="tel:{{ config('etrust.phone_tel') }}" class="mb-2 text-white"><i class="fas fa-phone-alt text-secondary me-2"></i>{{ config('etrust.phone') }}</a>
                    <a href="mailto:{{ config('etrust.email') }}" class="mb-2 text-white"><i class="fas fa-envelope text-secondary me-2"></i>{{ config('etrust.email') }}</a>
                </div>
            </div>
        </div>
        <hr class="text-light mt-5 mb-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-light">&copy; {{ date('Y') }} <a href="{{ url('/') }}" class="text-secondary">e-trust.online</a>. All rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="text-light">Developed by <span class="text-secondary">Md Muktadir Anik &amp; Tamim Ahmed</span></span>
            </div>
        </div>
    </div>
</div>
