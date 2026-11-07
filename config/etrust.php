<?php

/*
|--------------------------------------------------------------------------
| e-Trust website content
|--------------------------------------------------------------------------
| Almost every piece of text on the website lives here: contact details,
| mission, vision, values, services, DORKARI products, projects, team, FAQ
| and AI settings. Change it here and every page updates.
| On the server, run: php artisan config:clear
*/

return [

    'name'    => 'e-Trust',
    'domain'  => 'e-trust.online',
    'motto'   => 'Your expert IT solution',
    'tagline' => 'Custom websites, software, security and AI, built in Dhaka for businesses in Bangladesh and Sydney.',

    // Flat keys used across the views
    'email'     => 'info@e-trust.online',
    'phone'     => '+880 1960 013601',
    'phone_tel' => '+8801960013601',
    'address'   => '250/1, Nowatola, Moghbazar, Dhaka-1217',
    'map_url'   => 'https://goo.gl/maps/Zd4BCynmTb98ivUJ6',
    'facebook'  => 'https://www.facebook.com/profile.php?id=61587896492797',

    'contact' => [
        'address'   => '250/1, Nowatola, Moghbazar, Dhaka-1217, Bangladesh',
        'email'     => 'info@e-trust.online',
        'phone'     => '+880 1960 013601',
        'phone_raw' => '+8801960013601',
        // Number for the WhatsApp button (country code, no +). Set to null to hide it.
        'whatsapp'  => '8801960013601',
        'hours'     => 'Saturday to Thursday, 10am to 7pm (GMT+6)',
    ],

    // Where contact-form messages are delivered
    'contact_to' => env('CONTACT_TO_ADDRESS', 'info@e-trust.online'),

    'mission' => 'To give every business, from a family shop in Dhaka to a growing company in Sydney, technology it can truly trust: fast, secure websites and software, built with honest pricing and clear communication.',
    'vision'  => 'To become a security-first technology partner, born in Bangladesh and trusted on both sides of the world, that businesses turn to first when they need to grow online.',

    'values' => [
        ['title' => 'Trust first',         'text' => 'We keep our word on scope, price and deadlines. Our name is a promise.'],
        ['title' => 'Security by default', 'text' => 'Backed by cyber security training, we harden every site and system from day one.'],
        ['title' => 'Built to last',       'text' => 'Clean, hand-written code, fast pages, and solutions that keep working as you grow.'],
        ['title' => 'Growing together',    'text' => 'We share what we know, from training entrepreneurs to explaining every decision in plain language.'],
    ],

    // 'shape' picks the 3D object on the Services page:
    // browser, phone, shield, spark, pen, chart, cloud
    'services' => [
        ['slug' => 'web', 'shape' => 'browser', 'title' => 'Website design & development',
         'short' => 'Fast, custom websites that turn visitors into customers.',
         'text' => 'Company websites, landing pages and e-commerce stores designed around your brand and written from scratch. Mobile-first, SEO-ready and easy for your team to update.',
         'points' => ['Custom design, no templates', 'Laravel, PHP, WordPress and modern JavaScript', 'Admin panel to manage content', 'Speed and SEO optimisation']],
        ['slug' => 'apps', 'shape' => 'phone', 'title' => 'Web & mobile applications',
         'short' => 'Business software shaped around how you actually work.',
         'text' => 'Dashboards, booking systems, POS, inventory, accounting and progressive web apps that work on any phone. We automate the repetitive work so your team can focus on customers.',
         'points' => ['Business apps and dashboards', 'Progressive web apps (PWA)', 'API and payment gateway integration', 'Role-based access for teams']],
        ['slug' => 'security', 'shape' => 'shield', 'title' => 'Cyber security',
         'short' => 'Protect your website, data and customers.',
         'text' => 'Security reviews, hardening and monitoring for websites and servers. We fix vulnerabilities, set up SSL, backups and safe login, and train your team to spot scams.',
         'points' => ['Website and server security audit', 'Malware clean-up and hardening', 'SSL, backups and access control', 'Staff awareness training']],
        ['slug' => 'ai', 'shape' => 'spark', 'title' => 'AI & automation',
         'short' => 'Put AI to work inside your business.',
         'text' => 'AI chat assistants for your website, smart document tools and workflow automation that answer customers in Bangla and English, around the clock.',
         'points' => ['Website AI assistants', 'Bangla and English chatbots', 'Document and data automation', 'Integration with your existing tools']],
        ['slug' => 'design', 'shape' => 'pen', 'title' => 'UI/UX & brand design',
         'short' => 'Interfaces people understand at first glance.',
         'text' => 'User research, wireframes and polished interface design for websites and apps, plus logos and brand kits that look consistent everywhere.',
         'points' => ['UX research and wireframes', 'Interface and prototype design', 'Logo and brand identity', 'Design systems']],
        ['slug' => 'growth', 'shape' => 'chart', 'title' => 'Digital marketing & SEO',
         'short' => 'Get found by the right customers, in Dhaka and Sydney.',
         'text' => 'Search engine optimisation, Google Business Profile, social media campaigns and analytics so you know exactly which marketing brings in sales.',
         'points' => ['Technical and local SEO', 'Facebook and Google ads', 'Content and social media', 'Analytics and reporting']],
        ['slug' => 'cloud', 'shape' => 'cloud', 'title' => 'Hosting, cloud & maintenance',
         'short' => 'We keep your systems online, updated and backed up.',
         'text' => 'Domain, hosting, Docker and cloud deployment, plus monthly care plans with updates, uptime monitoring and quick support when something goes wrong.',
         'points' => ['Domain, hosting and email setup', 'Docker and cloud deployment', 'Updates and uptime monitoring', 'Priority support plans']],
    ],

    'process' => [
        ['title' => 'Discover',      'text' => 'We meet, listen and write down exactly what you need, who it is for and what success looks like.'],
        ['title' => 'Design',        'text' => 'You see wireframes and visual designs before any code is written, and we refine them with you.'],
        ['title' => 'Build',         'text' => 'We develop in short steps with a live preview link, so you can follow progress every week.'],
        ['title' => 'Launch & care', 'text' => 'We test, secure and launch, then stay with you for updates, support and growth.'],
    ],

    'dorkari' => [
        'url'      => 'https://dorkari.e-trust.online/',
        'name'     => 'DORKARI',
        'name_bn'  => 'দরকারি',
        'tagline'  => 'Everyday tools. One DORKARI.',
        'text'     => 'Our own product: one account for the tools that small businesses and families in Bangladesh need every day. Ledgers, tailoring, websites, online shops, local services, rent, documents and personal budgets, with an AI helper built in.',
        'status'   => 'Launching soon',
        'products' => [
            ['name' => 'Khata',     'bn' => 'খাতা',       'color' => '#FFB547', 'text' => 'Digital ledger for sales, purchases, customer dues and reports.'],
            ['name' => 'Dorji',     'bn' => 'দর্জি',       'color' => '#FF7A59', 'text' => 'Tailoring management for measurements, orders, payments and delivery dates.'],
            ['name' => 'WebShilpo', 'bn' => 'ওয়েবশিল্প',   'color' => '#5BC0EB', 'text' => 'Website builder with admin panel and hosting. No coding needed.'],
            ['name' => 'Bikikini',  'bn' => 'বিকিকিনি',    'color' => '#00C389', 'text' => 'Online store with orders, payments and sales tracking.'],
            ['name' => 'Karigor',   'bn' => 'কারিগর',     'color' => '#B794F6', 'text' => 'Find and book trusted local service providers.'],
            ['name' => 'BariKhata', 'bn' => 'বাড়িখাতা',    'color' => '#F6C343', 'text' => 'Property and rent management for tenants, bills and maintenance.'],
            ['name' => 'Nothi',     'bn' => 'নথি',        'color' => '#7DD3FC', 'text' => 'Document and PDF tools, CV builder and ready templates.'],
            ['name' => 'TakaHisab', 'bn' => 'টাকা হিসাব',  'color' => '#F472B6', 'text' => 'Personal budget, savings goals and recurring bills.'],
        ],
        'audience' => [
            ['title' => 'Shop owners',              'text' => 'Track sales, dues and stock with Khata, and sell online with Bikikini.'],
            ['title' => 'Tailors',                  'text' => 'Save every customer\'s measurements, orders and delivery dates in Dorji.'],
            ['title' => 'Landlords',                'text' => 'Manage tenants, rent and bills from your phone with BariKhata.'],
            ['title' => 'Families',                 'text' => 'Plan the monthly budget and savings with TakaHisab.'],
            ['title' => 'Service providers',        'text' => 'Get found and booked by local customers on Karigor.'],
            ['title' => 'Anyone who needs a website', 'text' => 'Launch a site without code using WebShilpo, then grow with our team.'],
        ],
    ],

    // Shown on the Projects page; each one appears on the 3D laptop screen.
    'projects' => [
        ['title' => 'DORKARI', 'type' => 'Our own SaaS product', 'url' => 'https://dorkari.e-trust.online/', 'accent' => '#FFB547',
         'text' => 'A bilingual all-in-one platform with eight everyday tools for small businesses and families in Bangladesh.',
         'tags' => ['Product design', 'Web app', 'AI']],
        ['title' => 'Security & Cabling', 'type' => 'Client website, Sydney', 'url' => 'https://securityandcabling.com.au/', 'accent' => '#5BC0EB',
         'text' => 'Full redesign and ongoing development for a Sydney security and cabling installation company, with quote forms and service-area landing pages.',
         'tags' => ['Redesign', 'Web development', 'Local SEO']],
        ['title' => 'Aviation services website', 'type' => 'Corporate website, Dhaka', 'url' => 'https://savslbd.com/', 'accent' => '#00C389',
         'text' => 'Corporate website for an aviation services company in Dhaka, designed and built from scratch with responsive layouts.',
         'tags' => ['Corporate site', 'Custom build']],
        ['title' => 'e-Trust AI Assistant', 'type' => 'Free public tool', 'url' => '/assistant', 'accent' => '#F23A4C',
         'text' => 'A free AI chat assistant on this website that answers in Bangla and English for anyone who needs help.',
         'tags' => ['AI', 'Laravel', 'Chat']],
        ['title' => 'Founder portfolio', 'type' => 'Personal website', 'url' => 'https://mdportfolio.e-trust.online/', 'accent' => '#B794F6',
         'text' => 'Portfolio website of our founder, showing projects in web development and cyber security.',
         'tags' => ['Static site', 'Portfolio']],
    ],

    'team' => [
        ['name' => 'Md Muktadir Anik', 'role' => 'Managing Director & Founder', 'img' => 'team-1.jpg', 'profile' => 'https://mdportfolio.e-trust.online/',
         'bio' => 'Leads strategy and engineering. Full stack developer with 3+ years building websites and business software in PHP, Laravel, JavaScript, Python and .NET, now studying a Master of IT (Cyber Security) in Australia.',
         'social' => ['facebook' => 'https://www.facebook.com/normalone98', 'instagram' => 'https://www.instagram.com/i_am_anik_1', 'linkedin' => 'https://www.linkedin.com/in/md-muktadir-anik-432390214']],
        ['name' => 'Tamim Ahmed', 'role' => 'CEO & Co-Founder', 'img' => 'team-2.jpg', 'profile' => null,
         'bio' => 'Runs operations and client partnerships, and keeps every project on time.',
         'social' => ['facebook' => 'https://www.facebook.com/tamim.ahmed.593671']],
        ['name' => 'Md Abdul Alim', 'role' => 'HR Administrator', 'img' => 'team-3.jpg', 'profile' => null,
         'bio' => 'Looks after our people, hiring and the day-to-day running of the office.',
         'social' => ['facebook' => 'https://www.facebook.com/md.abdul.alim.783523']],
        ['name' => 'Zubayer Farazi', 'role' => 'IT Team Lead', 'img' => 'team-zubayer.jpg', 'profile' => null,
         'bio' => 'Guides the IT and delivery team and makes sure every launch meets our quality bar.',
         'social' => ['facebook' => 'https://www.facebook.com/zubayerfarazi']],
    ],

    // [question, answer]
    'faqs' => [
        ['How much does a website cost?', 'It depends on the pages, features and design you need. Tell us about your project and we will send a clear, fixed quote within one working day.'],
        ['How long does a project take?', 'A business website usually takes two to four weeks. Larger web applications are planned in phases, and you can follow progress on a live preview link.'],
        ['Do you work with clients outside Bangladesh?', 'Yes. We already build and maintain websites for clients in Sydney, Australia, and we work comfortably across time zones over email, WhatsApp and video calls.'],
        ['Is the AI assistant really free?', 'Yes. Anyone can use the e-Trust AI assistant free of charge, in Bangla or English. There is a fair-use limit per visitor so it stays fast for everyone.'],
        ['Will I be able to update my website myself?', 'Yes. We can include an easy admin panel so you can change text, images, products and blog posts without any coding.'],
        ['What technology do you use?', 'We build with Laravel, PHP, WordPress and modern JavaScript, and custom business software with MySQL, Python and .NET. We choose what fits your project best.'],
        ['Do you provide support after launch?', 'Yes. We offer care plans with security updates, SSL, backups, uptime monitoring, fixes and new features as your business grows.'],
    ],

    /*
    |--------------------------------------------------------------------------
    | AI assistant: many AI providers
    |--------------------------------------------------------------------------
    | Add an API key for any provider in Render > Environment and it switches on
    | automatically (keys stay on the server, never in the browser). Visitors can
    | pick which AI answers; "Auto" tries them in AI_ORDER and falls back to the
    | next one if a provider fails. With no keys, built-in answers still work.
    |
    | Cheapest way to get almost every AI with ONE key: OPENROUTER_API_KEY
    | (Claude, GPT, Gemini, Hermes, Llama, DeepSeek and hundreds more).
    | Free tiers: GROQ_API_KEY (console.groq.com), GEMINI_API_KEY (aistudio.google.com).
    | Model names change often: override any of them with the *_MODEL variables.
    */
    'ai' => [
        'order'        => env('AI_ORDER', 'groq,gemini,openrouter,claude,chatgpt,hermes,deepseek,mistral,grok,custom'),
        'max_attempts' => (int) env('AI_MAX_ATTEMPTS', 2),
        'max_tokens'   => (int) env('AI_MAX_TOKENS', 700),
        'timeout'      => (int) env('AI_TIMEOUT', 20),
        // Fair-use limits per visitor (IP address) and for the whole site per day
        'per_minute'     => (int) env('AI_LIMIT_PER_MINUTE', 8),
        'per_day'        => (int) env('AI_LIMIT_PER_DAY', 150),
        'global_per_day' => (int) env('AI_LIMIT_GLOBAL_PER_DAY', 2500),

        'providers' => [
            'groq' => ['label' => 'Llama (Groq)', 'type' => 'openai',
                'base_url' => 'https://api.groq.com/openai/v1',
                'api_key' => env('GROQ_API_KEY', env('AI_API_KEY', '')), // AI_API_KEY kept for older setups
                'model' => env('GROQ_MODEL', env('AI_MODEL', 'llama-3.3-70b-versatile'))],
            'gemini' => ['label' => 'Gemini (Google)', 'type' => 'openai',
                'base_url' => 'https://generativelanguage.googleapis.com/v1beta/openai',
                'api_key' => env('GEMINI_API_KEY', ''),
                'model' => env('GEMINI_MODEL', 'gemini-flash-latest')],
            'openrouter' => ['label' => 'OpenRouter (any model)', 'type' => 'openai',
                'base_url' => 'https://openrouter.ai/api/v1',
                'api_key' => env('OPENROUTER_API_KEY', ''),
                'model' => env('OPENROUTER_MODEL', 'openrouter/auto')],
            'claude' => ['label' => 'Claude (Anthropic)', 'type' => 'anthropic',
                'base_url' => env('ANTHROPIC_BASE_URL', 'https://api.anthropic.com/v1'),
                'api_key' => env('ANTHROPIC_API_KEY', ''),
                'model' => env('ANTHROPIC_MODEL', 'claude-haiku-5-5')],
            'chatgpt' => ['label' => 'ChatGPT (OpenAI)', 'type' => 'openai',
                'base_url' => 'https://api.openai.com/v1',
                'api_key' => env('OPENAI_API_KEY', ''),
                'model' => env('OPENAI_MODEL', 'gpt-5.4-mini')],
            'hermes' => ['label' => 'Hermes (Nous Research)', 'type' => 'openai',
                'base_url' => env('NOUS_BASE_URL', 'https://inference-api.nousresearch.com/v1'),
                'api_key' => env('NOUS_API_KEY', ''),
                'model' => env('NOUS_MODEL', 'Hermes-4-70B')],
            'deepseek' => ['label' => 'DeepSeek', 'type' => 'openai',
                'base_url' => 'https://api.deepseek.com/v1',
                'api_key' => env('DEEPSEEK_API_KEY', ''),
                'model' => env('DEEPSEEK_MODEL', 'deepseek-chat')],
            'mistral' => ['label' => 'Mistral', 'type' => 'openai',
                'base_url' => 'https://api.mistral.ai/v1',
                'api_key' => env('MISTRAL_API_KEY', ''),
                'model' => env('MISTRAL_MODEL', 'mistral-small-latest')],
            'grok' => ['label' => 'Grok (xAI)', 'type' => 'openai',
                'base_url' => 'https://api.x.ai/v1',
                'api_key' => env('XAI_API_KEY', ''),
                'model' => env('XAI_MODEL', '')], // set XAI_MODEL to a current Grok model name
            // Any other OpenAI-compatible API (Together, Fireworks, Cerebras, Perplexity, a local server...)
            'custom' => ['label' => env('CUSTOM_AI_LABEL', 'Custom AI'), 'type' => 'openai',
                'base_url' => env('CUSTOM_AI_BASE_URL', ''),
                'api_key' => env('CUSTOM_AI_API_KEY', ''),
                'model' => env('CUSTOM_AI_MODEL', '')],
        ],
    ],
];
