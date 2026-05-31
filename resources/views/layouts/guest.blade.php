<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cabinet Médical') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased text-slate-800 bg-slate-50 font-sans">
        
        <!-- Top Navigation with Language Switcher -->
        <div class="absolute top-4 right-4 z-50">
            <div class="flex items-center gap-2 bg-white/80 backdrop-blur-md px-3 py-1.5 rounded-full shadow-sm border border-slate-100">
                <i class="fas fa-globe text-teal-600 text-sm"></i>
                <a href="{{ route('locale.switch', 'fr') }}" class="text-xs font-bold {{ app()->getLocale() === 'fr' ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }} transition-colors">FR</a>
                <span class="text-slate-300 text-xs">|</span>
                <a href="{{ route('locale.switch', 'en') }}" class="text-xs font-bold {{ app()->getLocale() === 'en' ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }} transition-colors">EN</a>
                <span class="text-slate-300 text-xs">|</span>
                <a href="{{ route('locale.switch', 'ar') }}" class="text-xs font-bold {{ app()->getLocale() === 'ar' ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }} transition-colors">AR</a>
            </div>
        </div>

        <div class="min-h-screen flex flex-col justify-center items-center py-10 relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0 med-gradient bg-grid opacity-90 -z-10"></div>
            
            <!-- Floating Circles -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-teal-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob -z-10"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000 -z-10"></div>
            <div class="absolute -bottom-32 left-20 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000 -z-10"></div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-xl shadow-2xl sm:rounded-[2rem] border border-white/50 relative z-10">
                <div class="flex flex-col items-center justify-center mb-8">
                    <a href="/" class="flex flex-col items-center gap-3 group">
                        <div class="w-16 h-16 med-gradient rounded-2xl flex items-center justify-center text-white shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-heartbeat text-3xl"></i>
                        </div>
                        <div class="text-center">
                            <h1 class="font-heading font-extrabold text-2xl text-slate-800 tracking-tight">Medi<span class="text-primary-600">Care</span></h1>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">{{ __('Espace Patient') }}</p>
                        </div>
                    </a>
                </div>

                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-white/80 text-xs">
                &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('Tous droits réservés.') }}
            </div>
        </div>
    </body>
</html>
