<div class="container-fluid py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 700px;">
            <h5 class="text-primary">Our Mission &amp; Vision</h5>
            <h2 class="h1">Why e-Trust Exists</h2>
            <p class="mb-0">We started e-Trust with a simple belief: every business deserves technology it can trust. Our name is our promise.</p>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                <div class="mv-card">
                    <div class="mv-icon"><i class="fas fa-bullseye fa-2x"></i></div>
                    <h3 class="mb-3">Our Mission</h3>
                    <p class="mb-0">Our mission is to give every business, from a family shop in Dhaka to a growing company in Sydney, technology it can truly trust. We build fast, secure websites and custom business software, put security in from the first line of code, and explain every step in plain language, with honest pricing and no surprises. Along the way, we help business owners understand and use digital tools, so they can grow with confidence.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                <div class="mv-card">
                    <div class="mv-icon"><i class="fas fa-eye fa-2x"></i></div>
                    <h3 class="mb-3">Our Vision</h3>
                    <p class="mb-0">Our vision is for e-Trust to become a security-first technology partner, born in Bangladesh and trusted on both sides of the world: the team businesses in Bangladesh and Australia turn to first when they need a website, software, or protection online. We want to prove that world-class digital work can come from Dhaka, and to grow alongside every client we serve.</p>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4 justify-content-center">
            @foreach ([
                ['fas fa-handshake', 'Trust first', 'We keep our word on scope, price and deadlines. Our name is a promise.'],
                ['fas fa-shield-alt', 'Security by default', 'Backed by cyber security training, we harden every site and system from day one.'],
                ['fas fa-cubes', 'Built to last', 'Clean code, fast pages, and solutions that keep working as your business grows.'],
                ['fas fa-seedling', 'Growing together', 'We share what we know, from training entrepreneurs in digital skills to explaining every decision in plain language.'],
            ] as [$icon, $title, $text])
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay=".3s">
                    <div class="value-item d-flex">
                        <i class="{{ $icon }} fa-lg text-secondary mt-1 me-3"></i>
                        <div>
                            <h5 class="mb-1">{{ $title }}</h5>
                            <p class="mb-0 small">{{ $text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
