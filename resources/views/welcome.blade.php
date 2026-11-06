@php
    $site = config('mdrrmo');
    $title = $site['name'].' | Disaster Risk Reduction & Emergency Response';
    $canonical = url('/');
    $ogImage = asset('images/og-image.jpg');
    $primaryHotline = $site['hotlines'][0];
    $tel = fn ($n) => 'tel:'.preg_replace('/[^0-9+]/', '', $n);

    $services = [
        ['title' => 'Early Warning', 'text' => 'Timely weather, flood and tsunami advisories relayed from PAGASA and PHIVOLCS to every barangay.', 'icon' => 'M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0'],
        ['title' => 'Emergency Response', 'text' => '24/7 rescue, medical first response and patient transport for residents and visitors.', 'icon' => 'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z'],
        ['title' => 'Preparedness Training', 'text' => 'Community drills, Basic Life Support and water search-and-rescue trainings for schools and barangays.', 'icon' => 'M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5'],
        ['title' => 'Risk Assessment', 'text' => 'Hazard mapping and vulnerability assessment of coastal, riverside and upland communities.', 'icon' => 'M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z'],
        ['title' => 'Evacuation Management', 'text' => 'Pre-emptive evacuation and coordinated management of evacuation centers during disasters.', 'icon' => 'm2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'],
        ['title' => 'Rehabilitation & Recovery', 'text' => 'Damage assessment, relief coordination and support to help families recover and build back better.', 'icon' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z'],
    ];

    $hazards = [
        'typhoon' => [
            'label' => 'Typhoon',
            'before' => ['Monitor PAGASA bulletins and MDRRMO advisories.', 'Secure your roof, windows and loose objects.', 'Prepare your Go-Bag and charge phones and power banks.', 'Know the nearest evacuation center in your barangay.'],
            'during' => ['Stay indoors, away from windows.', 'Evacuate immediately when advised by authorities.', 'Turn off the main power switch if water enters your home.', 'Keep updated through radio or official pages.'],
            'after' => ['Return home only when declared safe.', 'Stay away from fallen power lines and damaged structures.', 'Boil drinking water and check food for spoilage.', 'Report damages and injuries to your barangay or MDRRMO.'],
        ],
        'flood' => [
            'label' => 'Flood & Storm Surge',
            'before' => ['Know if your area is flood- or storm-surge-prone.', 'Store important documents in waterproof bags.', 'Move valuables and appliances to higher ground.', 'Plan a route to higher ground for your family.'],
            'during' => ['Move to higher ground immediately.', 'Never walk, swim or drive through floodwater.', 'Stay away from the shoreline and riverbanks.', 'Watch out for snakes and debris in the water.'],
            'after' => ['Avoid floodwater — it may be contaminated.', 'Clean and disinfect everything that got wet.', 'Watch for symptoms of leptospirosis and see a doctor.', 'Check your house for structural damage before entering.'],
        ],
        'earthquake' => [
            'label' => 'Earthquake',
            'before' => ['Anchor heavy furniture and appliances to walls.', 'Identify safe spots: under sturdy tables, away from glass.', 'Participate in barangay and school earthquake drills.', 'Agree on a family meeting place.'],
            'during' => ['DUCK, COVER and HOLD.', 'If outdoors, move to an open area away from buildings.', 'If near the coast, move to higher ground right away.', 'Do not use elevators or stairs while shaking.'],
            'after' => ['Expect aftershocks — stay alert.', 'Check yourself and others for injuries.', 'Check for gas leaks, fire and electrical damage.', 'Follow PHIVOLCS and MDRRMO tsunami advisories.'],
        ],
        'fire' => [
            'label' => 'Fire',
            'before' => ['Never leave cooking or candles unattended.', 'Unplug appliances that are not in use.', 'Keep a fire extinguisher and know how to use it.', 'Keep matches and lighters away from children.'],
            'during' => ['Stay calm and alert others — shout “Fire!”', 'Crawl low under the smoke to the nearest exit.', 'Stop, drop and roll if your clothes catch fire.', 'Call the BFP or MDRRMO once you are safe.'],
            'after' => ['Do not re-enter until declared safe by the BFP.', 'Seek medical help for burns and smoke inhalation.', 'Document losses for assistance claims.', 'Coordinate with your barangay for relief support.'],
        ],
    ];

    $goBag = ['Drinking water (3 days)', 'Ready-to-eat food', 'First aid kit & medicines', 'Flashlight & batteries', 'Whistle', 'Battery-powered radio', 'Power bank & charger', 'Copies of IDs & documents', 'Cash in small bills', 'Extra clothes & blanket', 'Hygiene kit & face masks', 'Emergency contact list'];

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'GovernmentOrganization',
        'name' => $site['full_name'],
        'alternateName' => $site['name'],
        'description' => $site['description'],
        'url' => $canonical,
        'logo' => asset('images/logo.png'),
        'image' => $ogImage,
        'telephone' => $primaryHotline['number'],
        'email' => $site['email'],
        'areaServed' => ['@type' => 'City', 'name' => 'Gitagum, Misamis Oriental'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $site['address']['street'],
            'addressLocality' => $site['address']['locality'],
            'addressRegion' => $site['address']['region'],
            'postalCode' => $site['address']['postal_code'],
            'addressCountry' => $site['address']['country'],
        ],
        'sameAs' => [$site['facebook']],
        'contactPoint' => collect($site['hotlines'])->filter(fn ($h) => str_starts_with($h['label'], 'MDRRMO'))->map(fn ($h) => [
            '@type' => 'ContactPoint',
            'contactType' => $h['label'],
            'telephone' => $h['number'],
            'areaServed' => 'PH',
            'availableLanguage' => ['en', 'fil', 'ceb'],
        ])->values()->all(),
    ];
    $schema = array_filter($schema, fn ($v) => $v !== null);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary SEO --}}
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $site['description'] }}">
    <meta name="keywords" content="{{ $site['keywords'] }}">
    <meta name="author" content="{{ $site['full_name'] }}">
    <meta name="robots" content="{{ app()->isProduction() ? 'index, follow, max-image-preview:large' : 'noindex, nofollow' }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#ea580c">
    <meta name="geo.region" content="PH-MSR">
    <meta name="geo.placename" content="Gitagum, Misamis Oriental">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $site['name'] }}">
    <meta property="og:locale" content="en_PH">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $site['description'] }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $site['name'] }} — {{ $site['tagline'] }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $site['description'] }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Icons --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('images/icon-192.png') }}" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">

    {{-- Preload the hero banner (largest contentful paint) --}}
    <link rel="preload" as="image" type="image/webp" href="{{ asset('images/hero-960.webp') }}" media="(max-width: 767px)" fetchpriority="high">
    <link rel="preload" as="image" type="image/webp" href="{{ asset('images/hero.webp') }}" media="(min-width: 768px)" fetchpriority="high">

    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-md focus:bg-brand-600 focus:px-4 focus:py-2 focus:text-white">Skip to content</a>

    {{-- Emergency bar --}}
    <div class="bg-brand-600 text-white">
        <div class="mx-auto flex max-w-6xl items-center justify-center gap-2 px-4 py-2 text-center text-xs sm:text-sm">
            <span class="relative flex size-2"><span class="absolute inline-flex size-full animate-ping rounded-full bg-white opacity-75"></span><span class="relative inline-flex size-2 rounded-full bg-white"></span></span>
            <span>In case of emergency, call
                <a href="{{ $tel($primaryHotline['number']) }}" class="font-bold underline decoration-white/50 underline-offset-2 hover:decoration-white">{{ $primaryHotline['number'] }}</a>
                or <a href="tel:911" class="font-bold underline decoration-white/50 underline-offset-2 hover:decoration-white">911</a>
            </span>
        </div>
    </div>

    {{-- Header --}}
    <header data-header class="sticky top-0 z-50 border-b border-stone-100 bg-white/90 backdrop-blur transition-shadow">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6" aria-label="Main navigation">
            <a href="#top" class="flex items-center gap-3" aria-label="{{ $site['name'] }} home">
                <img src="{{ asset('images/logo-160.webp') }}" alt="" width="40" height="40" class="size-10">
                <span class="leading-tight">
                    <span class="block text-base font-extrabold tracking-tight text-stone-900">MDRRMO</span>
                    <span class="block text-xs font-medium text-brand-600">Gitagum, Misamis Oriental</span>
                </span>
            </a>

            <ul class="hidden items-center gap-8 text-sm font-medium text-stone-600 md:flex">
                <li><a href="#about" class="transition hover:text-brand-600">About</a></li>
                <li><a href="#services" class="transition hover:text-brand-600">Services</a></li>
                <li><a href="#preparedness" class="transition hover:text-brand-600">Preparedness</a></li>
                <li><a href="#hotlines" class="transition hover:text-brand-600">Hotlines</a></li>
                <li><a href="#contact" class="transition hover:text-brand-600">Contact</a></li>
            </ul>

            <a href="{{ $tel($primaryHotline['number']) }}" class="btn-primary hidden !py-2.5 md:inline-flex">
                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                Emergency Call
            </a>

            <button type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-menu" class="rounded-lg p-2 text-stone-700 hover:bg-brand-50 md:hidden">
                <span class="sr-only">Toggle menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
            </button>
        </nav>

        <div id="mobile-menu" data-nav-menu class="hidden border-t border-stone-100 bg-white md:hidden">
            <ul class="space-y-1 px-4 py-4 text-sm font-medium text-stone-700">
                <li><a href="#about" class="block rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">About</a></li>
                <li><a href="#services" class="block rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Services</a></li>
                <li><a href="#preparedness" class="block rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Preparedness</a></li>
                <li><a href="#hotlines" class="block rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Hotlines</a></li>
                <li><a href="#contact" class="block rounded-lg px-3 py-2 hover:bg-brand-50 hover:text-brand-700">Contact</a></li>
                <li class="pt-2"><a href="{{ $tel($primaryHotline['number']) }}" class="btn-primary w-full">Emergency Call</a></li>
            </ul>
        </div>
    </header>

    <main id="main">
        {{-- Hero --}}
        <section id="top" class="relative isolate overflow-hidden bg-stone-900" aria-label="Welcome">
            {{-- Banner photo --}}
            <picture>
                <source type="image/webp" media="(max-width: 767px)" srcset="{{ asset('images/hero-960.webp') }}">
                <source type="image/webp" srcset="{{ asset('images/hero.webp') }}">
                <img src="{{ asset('images/hero.jpg') }}" alt="Gitagum Municipal Hall, home of the MDRRMO, Gitagum, Misamis Oriental"
                    width="1920" height="1080" fetchpriority="high" decoding="async"
                    class="absolute inset-0 -z-20 size-full object-cover object-center">
            </picture>
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-stone-950/90 via-stone-950/65 to-brand-900/30" aria-hidden="true"></div>
            <div class="absolute inset-x-0 bottom-0 -z-10 h-40 bg-gradient-to-t from-stone-950/70 to-transparent" aria-hidden="true"></div>

            <div class="mx-auto grid min-h-[calc(100svh-6.5rem)] max-w-6xl items-center gap-12 px-4 py-20 sm:px-6 lg:grid-cols-12 lg:py-28">
                <div class="lg:col-span-7">
                    <p class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold text-white backdrop-blur">
                        <span class="size-1.5 rounded-full bg-brand-400"></span>
                        Municipality of Gitagum · Misamis Oriental
                    </p>
                    <h1 class="mt-6 text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">
                        A safer, <span class="text-brand-400">disaster-resilient</span> Gitagum.
                    </h1>
                    <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/80">
                        The {{ $site['full_name'] }} protects lives and property through preparedness, early warning, rapid response, and recovery — together with every barangay.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ $tel($primaryHotline['number']) }}" class="btn-primary">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            Call {{ $primaryHotline['number'] }}
                        </a>
                        <a href="#preparedness" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur transition hover:bg-white hover:text-stone-900">Be Prepared &rarr;</a>
                    </div>
                    <dl class="mt-12 grid max-w-md grid-cols-3 gap-6 border-t border-white/15 pt-8">
                        <div><dt class="text-xs text-white/60">Barangays</dt><dd class="text-2xl font-bold text-white">{{ count($site['barangays']) }}</dd></div>
                        <div><dt class="text-xs text-white/60">Response</dt><dd class="text-2xl font-bold text-white">24/7</dd></div>
                        <div><dt class="text-xs text-white/60">Casualty Goal</dt><dd class="text-2xl font-bold text-white">Zero<span class="text-brand-400">.</span></dd></div>
                    </dl>
                </div>

                <div class="lg:col-span-5">
                    <div class="rounded-3xl bg-white/95 p-7 shadow-2xl shadow-black/30 backdrop-blur sm:p-8">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('images/logo-160.webp') }}" alt="Gitagum Rescue emblem" width="72" height="72" class="size-[72px]">
                            <div>
                                <p class="text-sm font-medium text-stone-500">24/7 Emergency Hotline</p>
                                @foreach (array_slice($site['hotlines'], 0, 2) as $hotline)
                                    <a href="{{ $tel($hotline['number']) }}" class="block text-xl font-extrabold tracking-tight text-brand-600 hover:text-brand-700 sm:text-2xl">{{ $hotline['number'] }}</a>
                                @endforeach
                            </div>
                        </div>
                        <ul class="mt-7 space-y-3">
                            @foreach (['Monitor official advisories', 'Prepare your family Go-Bag', 'Know your evacuation center'] as $i => $step)
                                <li class="flex items-center gap-4 rounded-2xl bg-stone-50 p-3.5">
                                    <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-brand-600 text-sm font-bold text-white">{{ $i + 1 }}</span>
                                    <span class="font-medium text-stone-800">{{ $step }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="mt-6 text-center text-sm font-semibold tracking-wide text-brand-700">{{ $site['tagline'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- About --}}
        <section id="about" class="border-y border-stone-100 bg-stone-50/60 py-20" aria-labelledby="about-title">
            <div class="mx-auto grid max-w-6xl gap-12 px-4 sm:px-6 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <span class="section-eyebrow">About Us</span>
                    <h2 id="about-title" class="section-title">Serving the people of Gitagum</h2>
                    <p class="mt-5 leading-relaxed text-stone-600">
                        Established under Republic Act No. 10121, the Philippine Disaster Risk Reduction and Management Act of 2010, the MDRRMO leads the planning, coordination and implementation of disaster risk reduction programs in the Municipality of Gitagum.
                    </p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:col-span-3">
                    <article class="rounded-2xl border border-stone-100 bg-white p-7">
                        <div class="mb-4 h-1 w-10 rounded-full bg-brand-500"></div>
                        <h3 class="text-lg font-bold text-stone-900">Our Vision</h3>
                        <p class="mt-3 leading-relaxed text-stone-600">A safe, adaptive and disaster-resilient Gitagum where every family is prepared and every barangay is empowered.</p>
                    </article>
                    <article class="rounded-2xl border border-stone-100 bg-white p-7">
                        <div class="mb-4 h-1 w-10 rounded-full bg-brand-500"></div>
                        <h3 class="text-lg font-bold text-stone-900">Our Mission</h3>
                        <p class="mt-3 leading-relaxed text-stone-600">To reduce disaster risks and save lives through preparedness, timely warning, efficient response and sustainable recovery.</p>
                    </article>
                </div>

                <figure class="lg:col-span-5">
                    <img src="{{ asset('images/informative.webp') }}" width="1600" height="800" loading="lazy" decoding="async"
                        alt="Gitagum Rescue — Local Government Unit of Gitagum, Municipal Disaster Risk Reduction and Management Office. Hotline: 0981 136 8638, 0975 840 3809"
                        class="w-full rounded-3xl border border-stone-100 shadow-xl shadow-brand-900/5">
                    <figcaption class="sr-only">Gitagum Rescue, the response team of the MDRRMO Gitagum.</figcaption>
                </figure>
            </div>
        </section>

        {{-- Services --}}
        <section id="services" class="py-20" aria-labelledby="services-title">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="max-w-2xl">
                    <span class="section-eyebrow">What We Do</span>
                    <h2 id="services-title" class="section-title">Programs &amp; Services</h2>
                    <p class="mt-4 text-stone-600">Following the four thematic areas of DRRM: prevention &amp; mitigation, preparedness, response, and rehabilitation &amp; recovery.</p>
                </div>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($services as $service)
                        <article class="group rounded-2xl border border-stone-100 bg-white p-7 transition hover:-translate-y-1 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-900/5">
                            <div class="flex size-12 items-center justify-center rounded-xl bg-brand-50 text-brand-600 transition group-hover:bg-brand-600 group-hover:text-white">
                                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/></svg>
                            </div>
                            <h3 class="mt-5 text-lg font-bold text-stone-900">{{ $service['title'] }}</h3>
                            <p class="mt-2 leading-relaxed text-stone-600">{{ $service['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Preparedness --}}
        <section id="preparedness" class="bg-stone-50/60 py-20" aria-labelledby="prep-title">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="max-w-2xl">
                    <span class="section-eyebrow">Be Ready</span>
                    <h2 id="prep-title" class="section-title">Disaster Preparedness Guide</h2>
                    <p class="mt-4 text-stone-600">Know what to do before, during and after common hazards in our municipality.</p>
                </div>

                <div class="mt-10 flex flex-wrap gap-2" role="tablist" aria-label="Hazard type">
                    @foreach ($hazards as $key => $hazard)
                        <button type="button" role="tab" id="tab-{{ $key }}" aria-controls="panel-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? 0 : -1 }}"
                            class="tab-btn rounded-full border border-stone-200 bg-white px-5 py-2 text-sm font-semibold text-stone-700 transition hover:border-brand-300">
                            {{ $hazard['label'] }}
                        </button>
                    @endforeach
                </div>

                @foreach ($hazards as $key => $hazard)
                    <div id="panel-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}" class="mt-8 grid gap-6 md:grid-cols-3" @unless ($loop->first) hidden @endunless>
                        @foreach (['before' => 'Before', 'during' => 'During', 'after' => 'After'] as $phase => $phaseLabel)
                            <div class="rounded-2xl border border-stone-100 bg-white p-7">
                                <h3 class="flex items-center gap-3 text-base font-bold text-stone-900">
                                    <span class="rounded-md bg-brand-50 px-2 py-0.5 text-xs font-bold uppercase tracking-wider text-brand-700">{{ $phaseLabel }}</span>
                                    {{ $hazard['label'] }}
                                </h3>
                                <ul class="mt-5 space-y-3">
                                    @foreach ($hazard[$phase] as $tip)
                                        <li class="flex gap-3 text-sm leading-relaxed text-stone-600">
                                            <svg class="mt-0.5 size-4 shrink-0 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                            {{ $tip }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                {{-- Go-Bag --}}
                <div class="mt-12 overflow-hidden rounded-3xl bg-gradient-to-br from-brand-500 to-brand-700 p-8 text-white sm:p-10">
                    <div class="grid gap-8 lg:grid-cols-3">
                        <div>
                            <h3 class="text-2xl font-bold">Emergency Go-Bag Checklist</h3>
                            <p class="mt-3 text-white/85">Keep one ready for every member of the family, good for at least 72 hours.</p>
                        </div>
                        <ul class="grid gap-x-6 gap-y-3 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-3">
                            @foreach ($goBag as $item)
                                <li class="flex items-center gap-2 text-sm font-medium">
                                    <span class="flex size-5 shrink-0 items-center justify-center rounded-full bg-white/20">
                                        <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    </span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Hotlines --}}
        <section id="hotlines" class="py-20" aria-labelledby="hotlines-title">
            <div class="mx-auto max-w-6xl px-4 sm:px-6">
                <div class="mx-auto max-w-2xl text-center">
                    <span class="section-eyebrow">Save These Numbers</span>
                    <h2 id="hotlines-title" class="section-title">Emergency Hotlines</h2>
                    <p class="mt-4 text-stone-600">Tap a number to call directly from your phone.</p>
                </div>
                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                    @foreach ($site['hotlines'] as $hotline)
                        <a href="{{ $tel($hotline['number']) }}" class="group rounded-2xl border border-stone-100 bg-white p-6 text-center transition hover:border-brand-300 hover:shadow-lg hover:shadow-brand-900/5">
                            <span class="mx-auto flex size-12 items-center justify-center rounded-full bg-brand-50 text-brand-600 transition group-hover:bg-brand-600 group-hover:text-white">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            </span>
                            <p class="mt-4 text-sm font-medium text-stone-500">{{ $hotline['label'] }}</p>
                            <p class="mt-1 text-xl font-extrabold tracking-tight text-stone-900 group-hover:text-brand-600">{{ $hotline['number'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Barangays --}}
        <section class="border-y border-stone-100 bg-stone-50/60 py-16" aria-labelledby="brgy-title">
            <div class="mx-auto max-w-6xl px-4 text-center sm:px-6">
                <h2 id="brgy-title" class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">Barangays We Serve</h2>
                <ul class="mt-6 flex flex-wrap justify-center gap-2">
                    @foreach ($site['barangays'] as $barangay)
                        <li class="rounded-full border border-stone-200 bg-white px-4 py-1.5 text-sm font-medium text-stone-700">{{ $barangay }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- Contact --}}
        <section id="contact" class="py-20" aria-labelledby="contact-title">
            <div class="mx-auto grid max-w-6xl gap-12 px-4 sm:px-6 lg:grid-cols-2">
                <div>
                    <span class="section-eyebrow">Get in Touch</span>
                    <h2 id="contact-title" class="section-title">Visit or contact our office</h2>
                    <p class="mt-4 text-stone-600">For reports, requests for assistance, trainings, or coordination, reach us through any of the channels below.</p>

                    <address class="mt-8 space-y-5 not-italic">
                        <div class="flex gap-4">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-stone-900">Office Address</p>
                                <p class="text-stone-600">{{ $site['address']['street'] }}, {{ $site['address']['locality'] }}, {{ $site['address']['region'] }} {{ $site['address']['postal_code'] }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-stone-900">24/7 Hotline</p>
                                <a href="{{ $tel($primaryHotline['number']) }}" class="text-stone-600 hover:text-brand-600">{{ $primaryHotline['number'] }}</a>
                            </div>
                        </div>
                        @if ($site['email'])
                            <div class="flex gap-4">
                                <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-stone-900">Email</p>
                                    <a href="mailto:{{ $site['email'] }}" class="text-stone-600 hover:text-brand-600">{{ $site['email'] }}</a>
                                </div>
                            </div>
                        @endif
                        <div class="flex gap-4">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                                <svg class="size-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.52 1.49-3.91 3.78-3.91 1.1 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.78-1.63 1.57v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.43-4.92 8.43-9.94Z"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-stone-900">Facebook</p>
                                <a href="{{ $site['facebook'] }}" target="_blank" rel="noopener" class="text-stone-600 hover:text-brand-600">Follow MDRRMO Gitagum for live updates</a>
                            </div>
                        </div>
                    </address>
                </div>

                <div class="overflow-hidden rounded-3xl border border-stone-100 shadow-xl shadow-brand-900/5">
                    <iframe
                        title="Map of Gitagum, Misamis Oriental"
                        src="https://maps.google.com/maps?q=Gitagum%20Municipal%20Hall%2C%20Misamis%20Oriental&z=15&output=embed"
                        class="h-full min-h-[380px] w-full grayscale-[30%]"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="border-t border-stone-100 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-6 px-4 py-10 sm:px-6 md:flex-row">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-160.webp') }}" alt="" width="36" height="36" class="size-9" loading="lazy">
                <div class="text-sm">
                    <p class="font-bold text-stone-900">{{ $site['name'] }}</p>
                    <p class="text-stone-500">{{ $site['tagline'] }}</p>
                </div>
            </div>
            <p class="text-center text-sm text-stone-500">
                &copy; <span data-year>{{ date('Y') }}</span> {{ $site['full_name'] }}. All rights reserved.
            </p>
            <a href="{{ $site['facebook'] }}" target="_blank" rel="noopener" class="text-stone-400 transition hover:text-brand-600" aria-label="MDRRMO Gitagum on Facebook">
                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.52 1.49-3.91 3.78-3.91 1.1 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.78-1.63 1.57v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.43-4.92 8.43-9.94Z"/></svg>
            </a>
        </div>
    </footer>
</body>
</html>
