{{-- Business details for Google (Knowledge panel / local search) --}}
<script type="application/ld+json">
{!! json_encode([
    '@' . 'context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ProfessionalService',
            '@id' => url('/') . '#organization',
            'name' => 'e-Trust',
            'alternateName' => 'e-trust.online',
            'url' => url('/'),
            'logo' => asset('img/logo-mark.png'),
            'image' => asset('img/carousel-1.jpg'),
            'description' => 'Web design and development company in Dhaka, Bangladesh, serving clients in Bangladesh and Sydney, Australia. Web design, web development, UI/UX, web security, SEO and digital marketing.',
            'email' => config('etrust.email'),
            'telephone' => config('etrust.phone_tel'),
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '250/1, Nowatola, Moghbazar',
                'addressLocality' => 'Dhaka',
                'postalCode' => '1217',
                'addressCountry' => 'BD',
            ],
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 23.7567, 'longitude' => 90.4056],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Dhaka'],
                ['@type' => 'Country', 'name' => 'Bangladesh'],
                ['@type' => 'City', 'name' => 'Sydney'],
                ['@type' => 'Country', 'name' => 'Australia'],
            ],
            'founder' => [
                ['@type' => 'Person', 'name' => 'Md Muktadir Anik', 'url' => 'https://mdportfolio.e-trust.online/'],
                ['@type' => 'Person', 'name' => 'Tamim Ahmed'],
            ],
            'knowsAbout' => ['Web Design', 'Web Development', 'UI/UX Design', 'Web Security', 'Search Engine Optimization', 'Digital Marketing', 'Laravel', 'PHP'],
            'sameAs' => [config('etrust.facebook')],
        ],
        [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => 'e-Trust',
            'publisher' => ['@id' => url('/') . '#organization'],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
