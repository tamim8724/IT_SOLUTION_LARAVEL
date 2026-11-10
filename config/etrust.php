<?php

// A key left as the placeholder "API key here" counts as not set.
$aiKey = static function (string $name): string {
    $v = trim((string) env($name, ''));
    return strcasecmp($v, 'API key here') === 0 ? '' : $v;
};

/*
|--------------------------------------------------------------------------
| e-Trust website content
|--------------------------------------------------------------------------
| Almost every piece of text on the website lives here: contact details,
| mission, vision, values, services, projects, team, FAQ
| and AI settings. Change it here and every page updates.
| On the server, run: php artisan config:clear
*/

return [

    'name'    => 'e-Trust',
    'domain'  => 'e-trust.online',
    'motto'   => 'Your expert IT solution',
    'tagline' => 'Custom websites, software, security and AI, built in Dhaka for businesses in Bangladesh and Sydney.',

    // Bump to refresh cached CSS/JS after a deploy
    'asset_version' => env('ASSET_VERSION', '2026-11-10'),

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
        // Sydney: WhatsApp messages only, 7 days, 10am-4pm Sydney time
        'sydney_whatsapp' => '+61 422 757 090',
        'sydney_hours'    => '7 days, 10am-4pm (Sydney time), WhatsApp messages only',
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
        ['slug' => 'seo', 'shape' => 'chart', 'title' => 'Digital marketing & SEO',
         'short' => 'Get found by the right customers, in Dhaka and Sydney.',
         'text' => 'Search engine optimisation, Google Business Profile, social media campaigns and analytics so you know exactly which marketing brings in sales.',
         'points' => ['Technical and local SEO', 'Facebook and Google ads', 'Content and social media', 'Analytics and reporting']],
        ['slug' => 'hosting', 'shape' => 'cloud', 'title' => 'Hosting, cloud & maintenance',
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

    // Shown on the Projects page; each one appears on the 3D laptop screen.
    'projects' => [
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
        ['name' => 'Md Muktadir Anik', 'role' => 'Managing Director & Founder', 'img' => 'team-1.webp', 'profile' => 'https://mdportfolio.e-trust.online/',
         'bio' => 'Leads strategy and engineering. Full stack developer with 3+ years building websites and business software in PHP, Laravel, JavaScript, Python and .NET, now studying a Master of IT (Cyber Security) in Australia.',
         'social' => ['facebook' => 'https://www.facebook.com/normalone98', 'instagram' => 'https://www.instagram.com/i_am_anik_1', 'linkedin' => 'https://www.linkedin.com/in/md-muktadir-anik-432390214']],
        ['name' => 'Tamim Ahmed', 'role' => 'CEO & Co-Founder', 'img' => 'team-2.webp', 'profile' => null,
         'bio' => 'Runs operations and client partnerships, and keeps every project on time.',
         'social' => ['facebook' => 'https://www.facebook.com/tamim.ahmed.593671']],
        ['name' => 'Md Abdul Alim', 'role' => 'HR Administrator', 'img' => 'team-3.webp', 'profile' => null,
         'bio' => 'Looks after our people, hiring and the day-to-day running of the office.',
         'social' => ['facebook' => 'https://www.facebook.com/md.abdul.alim.783523']],
        ['name' => 'Zubayer Farazi', 'role' => 'IT Team Lead', 'img' => 'team-zubayer.webp', 'profile' => null,
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
    | automatically (keys stay on the server, never in the browser). The site tries
    | them in AI_ORDER and falls back to the next one if a provider fails or runs out
    | of free quota. Visitors see one assistant. With no keys, built-in answers work.
    |
    | Cheapest way to get almost every AI with ONE key: OPENROUTER_API_KEY
    | (Claude, GPT, Gemini, Hermes, Llama, DeepSeek and hundreds more).
    | Free tiers: GROQ_API_KEY (console.groq.com), GEMINI_API_KEY (aistudio.google.com).
    | Model names change often: override any of them with the *_MODEL variables.
    */
    // AI chat leads: check that the email's domain can receive mail (turn off only for local testing)
    'lead_email_dns' => (bool) env('LEAD_EMAIL_DNS_CHECK', true),

    'ai' => [
        // Free providers first. Add a key in Render > Environment and that provider switches on.
        // If one is busy or out of free quota, the next one answers; the visitor never sees which.
        'order'        => env('AI_ORDER', 'gemini,groq,cerebras,mistral,openrouter,cloudflare,nvidia,hetzner,cohere,sambanova,claude,chatgpt,deepseek,grok,custom'),
        'max_attempts' => (int) env('AI_MAX_ATTEMPTS', 5),
        'max_tokens'   => (int) env('AI_MAX_TOKENS', 800),
        'timeout'      => (int) env('AI_TIMEOUT', 15),
        // A provider that hits its limit (HTTP 429/402) is skipped for this many seconds
        'cooldown'     => (int) env('AI_COOLDOWN', 300),
        // Fair-use limits per visitor (IP address) and for the whole site per day
        'per_minute'     => (int) env('AI_LIMIT_PER_MINUTE', 8),
        'per_day'        => (int) env('AI_LIMIT_PER_DAY', 150),
        'global_per_day' => (int) env('AI_LIMIT_GLOBAL_PER_DAY', 2500),

        'providers' => [
            // ---- Free, no card needed ----
            // aistudio.google.com/apikey
            'gemini' => ['label' => 'Gemini (Google)', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://generativelanguage.googleapis.com/v1beta/openai',
                'api_key' => $aiKey('GEMINI_API_KEY'),
                'model' => env('GEMINI_MODEL', 'gemini-flash-latest')],
            // console.groq.com/keys
            'groq' => ['label' => 'Groq', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://api.groq.com/openai/v1',
                'api_key' => $aiKey('GROQ_API_KEY') ?: $aiKey('AI_API_KEY'),
                'model' => env('GROQ_MODEL', 'openai/gpt-oss-120b')],
            // cloud.cerebras.ai (now a trial: needs a card, $5 credit for 30 days)
            'cerebras' => ['label' => 'Cerebras', 'type' => 'openai', 'free' => false,
                'base_url' => 'https://api.cerebras.ai/v1',
                'api_key' => $aiKey('CEREBRAS_API_KEY'),
                'model' => env('CEREBRAS_MODEL', 'gpt-oss-120b')],
            // console.mistral.ai (Experiment / free plan)
            'mistral' => ['label' => 'Mistral', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://api.mistral.ai/v1',
                'api_key' => $aiKey('MISTRAL_API_KEY'),
                'model' => env('MISTRAL_MODEL', 'mistral-small-latest')],
            // openrouter.ai/keys - ":free" models, about 50 requests a day
            'openrouter' => ['label' => 'OpenRouter', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://openrouter.ai/api/v1',
                'api_key' => $aiKey('OPENROUTER_API_KEY'),
                'model' => env('OPENROUTER_MODEL', 'openrouter/free')],
            // dash.cloudflare.com > AI > Workers AI (needs your account ID too)
            'cloudflare' => ['label' => 'Cloudflare Workers AI', 'type' => 'openai', 'free' => true,
                'base_url' => $aiKey('CLOUDFLARE_ACCOUNT_ID') ? 'https://api.cloudflare.com/client/v4/accounts/' . $aiKey('CLOUDFLARE_ACCOUNT_ID') . '/ai/v1' : '',
                'api_key' => $aiKey('CLOUDFLARE_API_TOKEN'),
                'model' => env('CLOUDFLARE_MODEL', '@cf/meta/llama-3.3-70b-instruct-fp8-fast')],
            // build.nvidia.com (free for prototyping)
            'nvidia' => ['label' => 'NVIDIA', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://integrate.api.nvidia.com/v1',
                'api_key' => $aiKey('NVIDIA_API_KEY'),
                'model' => env('NVIDIA_MODEL', 'meta/llama-3.3-70b-instruct')],
            // Hetzner Inference API (experimental, free account)
            'hetzner' => ['label' => 'Hetzner', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://inference.hetzner.com/api/v1',
                'api_key' => $aiKey('HETZNER_API_KEY'),
                'model' => env('HETZNER_MODEL', 'Qwen/Qwen3.6-35B-A3B-FP8')],
            // dashboard.cohere.com (trial key: 1,000 calls a month, not for commercial use)
            'cohere' => ['label' => 'Cohere', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://api.cohere.ai/compatibility/v1',
                'api_key' => $aiKey('COHERE_API_KEY'),
                'model' => env('COHERE_MODEL', 'command-a-plus-05-2026')],
            // cloud.sambanova.ai (very small free limit)
            'sambanova' => ['label' => 'SambaNova', 'type' => 'openai', 'free' => true,
                'base_url' => 'https://api.sambanova.ai/v1',
                'api_key' => $aiKey('SAMBANOVA_API_KEY'),
                'model' => env('SAMBANOVA_MODEL', 'Meta-Llama-3.3-70B-Instruct')],

            // ---- Paid (optional; only used if you add a key) ----
            'claude' => ['label' => 'Claude (Anthropic)', 'type' => 'anthropic',
                'base_url' => env('ANTHROPIC_BASE_URL', 'https://api.anthropic.com/v1'),
                'api_key' => $aiKey('ANTHROPIC_API_KEY'),
                'model' => env('ANTHROPIC_MODEL', 'claude-haiku-5-5')],
            'chatgpt' => ['label' => 'ChatGPT (OpenAI)', 'type' => 'openai',
                'base_url' => 'https://api.openai.com/v1',
                'api_key' => $aiKey('OPENAI_API_KEY'),
                'model' => env('OPENAI_MODEL', 'gpt-5.4-mini')],
            'deepseek' => ['label' => 'DeepSeek', 'type' => 'openai',
                'base_url' => 'https://api.deepseek.com/v1',
                'api_key' => $aiKey('DEEPSEEK_API_KEY'),
                'model' => env('DEEPSEEK_MODEL', 'deepseek-flash')],
            'grok' => ['label' => 'Grok (xAI)', 'type' => 'openai',
                'base_url' => 'https://api.x.ai/v1',
                'api_key' => $aiKey('XAI_API_KEY'),
                'model' => env('XAI_MODEL', '')],
            // Any other OpenAI-compatible API
            'custom' => ['label' => env('CUSTOM_AI_LABEL', 'Custom AI'), 'type' => 'openai',
                'base_url' => env('CUSTOM_AI_BASE_URL', ''),
                'api_key' => $aiKey('CUSTOM_AI_API_KEY'),
                'model' => env('CUSTOM_AI_MODEL', '')],
        ],
    ],
];
