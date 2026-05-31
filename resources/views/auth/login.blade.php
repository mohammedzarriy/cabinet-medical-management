<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">{{ __('Connexion') }}</h2>
        <p class="text-sm text-slate-500 mt-1">{{ __('Heureux de vous revoir !') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Email') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="exemple@email.com" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-semibold text-slate-700">{{ __('Mot de passe') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-teal-600 hover:text-teal-800" href="{{ route('password.request') }}">
                        {{ __('Oublié ?') }}
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-800 transition-colors">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center pt-4 gap-4">
            <button type="submit" class="w-full med-gradient text-white py-3 rounded-xl font-bold text-sm tracking-wide hover:shadow-lg hover:shadow-teal-500/30 transform hover:-translate-y-0.5 transition-all">
                {{ __('SE CONNECTER') }}
            </button>
            
            @if (Route::has('register'))
                <p class="text-sm text-slate-500">
                    {{ __('Nouveau patient ?') }}
                    <a class="text-teal-600 font-bold hover:text-teal-800 transition-colors ml-1" href="{{ route('register') }}">
                        {{ __('Créer un compte') }}
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
