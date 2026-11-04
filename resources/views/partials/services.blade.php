@php
    $services = [
        ['icon' => 'fa fa-code', 'title' => 'Web Design', 'text' => 'Clean, modern, and mobile-friendly designs that reflect your brand and make a strong first impression on every visitor.'],
        ['icon' => 'fa fa-file-code', 'title' => 'Web Development', 'text' => 'Fast, reliable websites and web applications built with modern technology and designed to grow with your business.'],
        ['icon' => 'fa fa-external-link-alt', 'title' => 'UI/UX Design', 'text' => 'Simple, intuitive interfaces based on how real people think and behave, so visitors find what they need with ease.'],
        ['icon' => 'fas fa-user-secret', 'title' => 'Web Security', 'text' => 'Protection for your website and data, including SSL setup, secure coding, regular updates, and vulnerability checks.'],
        ['icon' => 'fa fa-envelope-open', 'title' => 'Digital Marketing', 'text' => 'SEO, social media, and online campaigns that bring the right customers to your business and turn visits into sales.'],
        ['icon' => 'fas fa-laptop', 'title' => 'Programming', 'text' => "Custom business software, such as accounting systems, plus scripts and automation tailored to your workflow."],
    ];
@endphp
<div class="container-fluid services py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Our Services</h5>
            <h2 class="h1">Services Built Specifically For Your Business</h2>
            <p class="mt-3 mb-0">From website design and development to web security, SEO, and custom software, everything your business needs online, done by one trusted team in Dhaka for clients in Bangladesh and Sydney.</p>
        </div>
        <div class="row g-5 services-inner">
            @foreach ($services as $i => $service)
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".{{ ($i % 3) * 2 + 3 }}s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="{{ $service['icon'] }} fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">{{ $service['title'] }}</h4>
                                <p class="mb-4">{{ $service['text'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
