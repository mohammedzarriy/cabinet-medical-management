<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Cabinet Médical') }} | {{ __('Excellence & Santé') }}</title>
    
    <!-- Scripts & Styles -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="text-slate-800 antialiased relative font-sans overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300 py-3" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 med-gradient rounded-xl flex items-center justify-center text-white shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <i class="fas fa-heartbeat text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-heading font-bold text-xl text-slate-800 tracking-tight">Medi<span class="text-primary-600">Care</span></h1>
                        <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">{{ __('Centre Médical') }}</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8 rtl:space-x-reverse">
                    <a href="#accueil" class="text-sm font-semibold text-primary-600 border-b-2 border-primary-600 pb-1">{{ __('Accueil') }}</a>
                    <a href="#services" class="text-sm font-medium text-slate-500 hover:text-primary-600 transition-colors">{{ __('Spécialités') }}</a>
                    <a href="#about" class="text-sm font-medium text-slate-500 hover:text-primary-600 transition-colors">{{ __('À Propos') }}</a>
                </div>

                <!-- Right Side (Lang & Auth) -->
                <div class="flex items-center gap-4">
                    <!-- Language Dropdown -->
                    @php
                        $locales = ['fr' => 'FR', 'en' => 'EN', 'ar' => 'AR'];
                        $current = app()->getLocale();
                    @endphp
                    <div class="relative group">
                        <button class="flex items-center gap-1.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 px-3 py-2 rounded-lg transition">
                            <i class="fas fa-globe text-primary-600"></i>
                            <span>{{ $locales[$current] ?? strtoupper($current) }}</span>
                        </button>
                        <div class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-32 bg-white rounded-xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            @foreach($locales as $code => $label)
                                <a href="{{ route('locale.switch', $code) }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-primary-50 hover:text-primary-700 {{ $current === $code ? 'font-bold text-primary-600 bg-primary-50/50' : '' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Auth -->
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="med-gradient text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-user-circle mx-1.5"></i> {{ __('Mon Espace') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-slate-600 hover:text-primary-600 transition">{{ __('Connexion') }}</a>
                            <a href="{{ route('register') }}" class="med-gradient text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:-translate-y-0.5 transition-all flex items-center">
                                {{ __('Rendez-vous') }} <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left mr-1.5' : 'fa-arrow-right ml-1.5' }} text-xs"></i>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="accueil" class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden bg-white bg-grid">
        <div class="absolute top-0 {{ app()->getLocale() === 'ar' ? 'left-0 rounded-br-[100px]' : 'right-0 rounded-bl-[100px]' }} w-full lg:w-1/2 h-full bg-primary-50/50 -z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                
                <!-- Hero Content -->
                <div class="w-full lg:w-1/2 relative z-10 text-center lg:text-start">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-bold mb-6 border border-primary-200 shadow-sm mx-auto lg:mx-0">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-primary-500"></span>
                        </span>
                        {{ __('Ouvert et à votre écoute') }}
                    </div>
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-extrabold text-slate-800 leading-tight mb-6">
                        {{ __('Votre santé mérite') }} <br>
                        <span class="med-gradient-text relative inline-block">
                            {{ __('l\'excellence') }}
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-primary-400 opacity-50" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,10 Q50,20 100,10" stroke="currentColor" stroke-width="4" fill="none"/></svg>
                        </span>
                    </h1>
                    
                    <p class="text-lg text-slate-600 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        {{ __('Des médecins spécialistes dévoués, des équipements de pointe et un accompagnement personnalisé. Prenez le contrôle de votre santé dès aujourd\'hui.') }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto med-gradient text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                            <i class="far fa-calendar-check text-xl"></i>
                            {{ __('Réserver en ligne') }}
                        </a>
                        <div class="flex items-center gap-4 text-sm font-medium text-slate-500 mt-4 sm:mt-0">
                            <div class="flex -space-x-3 rtl:space-x-reverse">
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-primary-100 flex items-center justify-center text-primary-600 relative z-30"><i class="fas fa-user-md"></i></div>
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-secondary-100 flex items-center justify-center text-secondary-600 relative z-20"><i class="fas fa-stethoscope"></i></div>
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-100 flex items-center justify-center text-blue-600 relative z-10"><i class="fas fa-heartbeat"></i></div>
                            </div>
                            <p>+25 <br><span class="text-slate-800 font-bold">{{ __('Spécialistes') }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Hero Visuals -->
                <div class="w-full lg:w-1/2 relative">
                    <!-- Blob Background -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 lg:w-96 lg:h-96 bg-gradient-to-tr from-primary-200 to-secondary-100 animate-blob opacity-70 blur-3xl -z-10 rounded-full"></div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10">
                        <!-- Card 1 -->
                        <div class="glass-card rounded-3xl p-6 lg:mt-12 animate-float">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mb-4 text-xl">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2 font-heading text-lg">{{ __('Soins Sécurisés') }}</h3>
                            <p class="text-sm text-slate-500">{{ __('Protocoles médicaux stricts et dossiers confidentiels.') }}</p>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="glass-card rounded-3xl p-6 animate-float-delayed">
                            <div class="w-12 h-12 bg-secondary-100 text-secondary-600 rounded-2xl flex items-center justify-center mb-4 text-xl">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2 font-heading text-lg">{{ __('Gain de Temps') }}</h3>
                            <p class="text-sm text-slate-500">{{ __('Zéro salle d\'attente grâce à nos créneaux précis.') }}</p>
                        </div>

                        <!-- Info Badge -->
                        <div class="sm:col-span-2 glass-card rounded-3xl p-5 flex flex-col sm:flex-row items-center gap-4 sm:-translate-y-6 lg:mx-8">
                            <div class="w-14 h-14 shrink-0 med-gradient rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="text-center sm:text-start">
                                <div class="flex justify-center sm:justify-start text-yellow-400 text-sm mb-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="font-bold text-slate-800">{{ __('Note de 4.8/5') }}</p>
                                <p class="text-xs text-slate-500">{{ __('Basé sur 10,000+ avis patients') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-[calc(100%+1.3px)] h-[60px]">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="py-12 bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-slate-200 rtl:divide-x-reverse">
                <div class="text-center px-4">
                    <p class="text-4xl font-black text-primary-600 mb-1 font-heading">+25</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Spécialistes') }}</p>
                </div>
                <div class="text-center px-4">
                    <p class="text-4xl font-black text-primary-600 mb-1 font-heading">10K+</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Patients') }}</p>
                </div>
                <div class="text-center px-4">
                    <p class="text-4xl font-black text-primary-600 mb-1 font-heading">4.8<span class="text-2xl text-yellow-400">★</span></p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Évaluation') }}</p>
                </div>
                <div class="text-center px-4">
                    <p class="text-4xl font-black text-primary-600 mb-1 font-heading">24/7</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Support Dédié') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Real Database Services Section -->
    <section id="services" class="py-24 relative bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl text-center md:text-start">
                    <span class="text-primary-600 font-bold tracking-wider uppercase text-sm mb-2 block">{{ __('Spécialités') }}</span>
                    <h2 class="text-4xl md:text-5xl font-heading font-extrabold text-slate-800">{{ __('Nos Services Médicaux') }}</h2>
                </div>
                <div class="hidden md:block">
                    <a href="{{ route('register') }}" class="text-primary-600 font-bold hover:text-primary-800 flex items-center gap-2 group">
                        {{ __('Voir tous les médecins') }} <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left group-hover:-translate-x-2' : 'fa-arrow-right group-hover:translate-x-2' }} transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $index => $service)
                    <!-- Dynamic Service Card -->
                    <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100 hover:bg-white hover:border-primary-100 hover:shadow-2xl hover:shadow-primary-500/10 transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-16 h-16 rounded-2xl bg-white shadow-sm text-primary-600 flex items-center justify-center text-2xl group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                                @php
                                    $icons = ['fa-stethoscope', 'fa-lungs', 'fa-heartbeat', 'fa-brain', 'fa-bone', 'fa-eye', 'fa-tooth', 'fa-vials'];
                                    $icon = $icons[$index % count($icons)];
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="bg-primary-50 text-primary-700 px-3 py-1 rounded-full text-sm font-bold" dir="ltr">
                                {{ $service->prix ? $service->prix . ' DH' : __('Sur devis') }}
                            </div>
                        </div>
                        
                        <h3 class="text-2xl font-bold font-heading text-slate-800 mb-3">{{ $service->nom }}</h3>
                        <p class="text-slate-500 mb-8 line-clamp-3 leading-relaxed">
                            {{ $service->description }}
                        </p>
                        
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-slate-800 font-semibold group-hover:text-primary-600 transition-colors">
                            {{ __('Prendre RDV') }} <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-chevron-left' : 'fa-chevron-right' }} text-xs"></i>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full bg-slate-50 rounded-3xl p-12 text-center border border-slate-100">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-slate-300 mx-auto mb-4 text-3xl shadow-sm">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h3 class="text-xl font-bold font-heading text-slate-800 mb-2">{{ __('Aucun service disponible') }}</h3>
                        <p class="text-slate-500">{{ __('Les spécialités seront affichées ici prochainement.') }}</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Mobile Link -->
            <div class="mt-10 text-center md:hidden">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-primary-600 font-bold hover:text-primary-800">
                    {{ __('Voir tous les médecins') }} <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }}"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Us Section (Minimalist & Clean) -->
    <section class="py-24 bg-slate-50 relative overflow-hidden" id="about">
        <div class="absolute {{ app()->getLocale() === 'ar' ? 'left-0 rounded-r-[100px]' : 'right-0 rounded-l-[100px]' }} top-0 w-full lg:w-1/3 h-full bg-white -z-10 opacity-50 lg:opacity-100"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2 text-center lg:text-start">
                    <h2 class="text-4xl lg:text-5xl font-heading font-extrabold text-slate-800 mb-6 leading-tight">{{ __('Pourquoi choisir notre centre médical ?') }}</h2>
                    <p class="text-slate-600 mb-12 text-lg">{{ __('Nous combinons l\'expertise humaine à la technologie médicale de pointe pour vous offrir la meilleure expérience de soin possible.') }}</p>
                    
                    <div class="space-y-8 text-start">
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5">
                            <div class="w-14 h-14 shrink-0 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="text-center sm:text-start">
                                <h4 class="text-xl font-bold font-heading text-slate-800 mb-2">{{ __('Expertise Reconnue') }}</h4>
                                <p class="text-slate-500">{{ __('Nos médecins sont sélectionnés parmi les meilleurs de leur domaine.') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5">
                            <div class="w-14 h-14 shrink-0 bg-secondary-100 text-secondary-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                                <i class="fas fa-laptop-medical"></i>
                            </div>
                            <div class="text-center sm:text-start">
                                <h4 class="text-xl font-bold font-heading text-slate-800 mb-2">{{ __('Dossier Numérique') }}</h4>
                                <p class="text-slate-500">{{ __('Retrouvez tout votre historique médical sécurisé en un seul clic.') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5">
                            <div class="w-14 h-14 shrink-0 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="text-center sm:text-start">
                                <h4 class="text-xl font-bold font-heading text-slate-800 mb-2">{{ __('Support Dédié') }}</h4>
                                <p class="text-slate-500">{{ __('Une équipe administrative à votre écoute pour faciliter vos démarches.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 mt-12 lg:mt-0">
                    <!-- Image Placeholder / Composition -->
                    <div class="aspect-square bg-white rounded-[3rem] relative overflow-hidden flex items-center justify-center shadow-2xl border border-slate-100 group">
                        <i class="fas fa-hospital text-[10rem] text-slate-100 group-hover:scale-110 transition-transform duration-700"></i>
                        <div class="absolute inset-0 med-gradient opacity-[0.03]"></div>
                        
                        <!-- Floating Badge -->
                        <div class="absolute bottom-8 {{ app()->getLocale() === 'ar' ? 'right-8' : 'left-8' }} bg-white/90 backdrop-blur-md p-6 rounded-3xl shadow-xl border border-white flex items-center gap-4 animate-float">
                            <div class="w-16 h-16 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-2xl">
                                <i class="fas fa-award"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">{{ __('Certifié') }}</p>
                                <p class="text-2xl font-black font-heading text-slate-800" dir="ltr">ISO 9001</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="py-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="med-gradient rounded-[3rem] p-10 lg:p-20 text-center text-white relative overflow-hidden shadow-2xl shadow-primary-600/30">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
                
                <h2 class="text-4xl md:text-5xl font-heading font-extrabold mb-6 relative z-10">{{ __('N\'attendez plus pour votre santé') }}</h2>
                <p class="text-primary-100 text-lg mb-10 max-w-2xl mx-auto relative z-10">
                    {{ __('Rejoignez notre plateforme dès aujourd\'hui et réservez votre première consultation en moins de 2 minutes.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
                    <a href="{{ route('register') }}" class="bg-white text-primary-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-slate-50 hover:scale-105 transition-all shadow-lg flex items-center justify-center gap-2">
                        {{ __('Créer un compte') }}
                    </a>
                    <a href="{{ route('login') }}" class="bg-primary-700/50 backdrop-blur border border-primary-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-primary-700/80 transition-all flex items-center justify-center gap-2">
                        {{ __('Espace Patient') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-20 pb-10 border-t-4 border-primary-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 med-gradient rounded-xl flex items-center justify-center text-white">
                            <i class="fas fa-heartbeat text-xl"></i>
                        </div>
                        <h2 class="font-heading font-bold text-2xl text-white">Medi<span class="text-primary-500">Care</span></h2>
                    </div>
                    <p class="text-slate-400 mb-6 leading-relaxed">
                        {{ __('L\'innovation numérique au service de votre santé. Un centre d\'excellence médicale pluridisciplinaire.') }}
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 text-slate-400 flex items-center justify-center hover:bg-primary-500 hover:text-white transition-colors"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h3 class="text-white font-bold font-heading text-lg mb-6">{{ __('Plateforme') }}</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Prendre RDV') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Nos Spécialités') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Notre Équipe') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Tarifs') }}</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h3 class="text-white font-bold font-heading text-lg mb-6">{{ __('Légal') }}</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Mentions Légales') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Politique de Confidentialité') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('CGU') }}</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-primary-400 transition-colors">{{ __('Contactez-nous') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-bold font-heading text-lg mb-6">{{ __('Contact') }}</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-400">
                            <i class="fas fa-map-marker-alt mt-1 text-primary-500 shrink-0"></i>
                            <span>{{ __('123 Avenue de la Santé, Quartier Médical, Ville') }}</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-400" dir="ltr">
                            <i class="fas fa-phone-alt text-primary-500 shrink-0"></i>
                            <span>+212 5 00 00 00 00</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-400">
                            <i class="fas fa-envelope text-primary-500 shrink-0"></i>
                            <span>contact@medicare.test</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} MediCare. {{ __('Tous droits réservés. Réalisé pour OFPPT.') }}
                </p>
                <div class="flex items-center gap-2 text-slate-500 text-sm">
                    Made with <i class="fas fa-heart text-primary-500"></i> & Laravel
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple scroll effect for navbar
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 10) {
                nav.classList.add('shadow-sm');
                nav.classList.replace('py-3', 'py-2');
            } else {
                nav.classList.remove('shadow-sm');
                nav.classList.replace('py-2', 'py-3');
            }
        });
    </script>
</body>
</html>
