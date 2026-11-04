@php
    $faqs = [
        ['What services does e-Trust offer?',
         'We offer web design, web development, UI/UX design, web security, digital marketing (including SEO), and custom programming. We build business websites, web applications, and e-commerce websites, and look after them after launch.'],
        ['Do you work with businesses outside Bangladesh, such as in Sydney?',
         'Yes. Our office is in Dhaka, Bangladesh, and we also work with businesses in Sydney, Australia. For example, we redesigned and continue to develop the website of Security & Cabling, a Sydney security installation company.'],
        ['How much does a website cost?',
         'It depends on the number of pages and the features you need. After we understand your requirements, we give you a clear quote before any work starts, with no hidden charges.'],
        ['How long does it take to build a website?',
         'It depends on the size of the project. We agree on a timeline with you before we start and keep you updated at every stage.'],
        ['Will my website work on mobile and be ready for Google?',
         'Yes. Every website we build is mobile-friendly, fast, and built with SEO basics in place: page titles, descriptions, clean structure, and a sitemap, so Google can find and understand it.'],
        ['What technology do you use?',
         'We build websites with Laravel, PHP and WordPress, and custom business software, such as accounting systems, with MySQL, Python and .NET. We choose what fits your project best.'],
        ['Do you provide support after the website goes live?',
         'Yes. We offer ongoing support, including security updates, SSL, backups, fixes, and new features as your business grows.'],
    ];
@endphp

<div class="container-fluid py-5 mb-5 faq">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 700px;">
            <h5 class="text-primary">FAQ</h5>
            <h2 class="h1">Frequently Asked Questions</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 wow fadeIn" data-wow-delay=".3s">
                <div class="accordion" id="faqAccordion">
                    @foreach ($faqs as $i => [$q, $a])
                        <div class="accordion-item mb-3 border rounded">
                            <h3 class="accordion-header" id="faq-h{{ $i }}">
                                <button class="accordion-button {{ $i ? 'collapsed' : '' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-c{{ $i }}" aria-expanded="{{ $i ? 'false' : 'true' }}" aria-controls="faq-c{{ $i }}">{{ $q }}</button>
                            </h3>
                            <div id="faq-c{{ $i }}" class="accordion-collapse collapse {{ $i ? '' : 'show' }}" aria-labelledby="faq-h{{ $i }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Structured data so Google can show these questions directly in search results --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($f) => [
        '@type' => 'Question',
        'name' => $f[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
    ], $faqs),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
