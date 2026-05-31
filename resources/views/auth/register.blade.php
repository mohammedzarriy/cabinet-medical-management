<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">{{ __('Créer un compte') }}</h2>
        <p class="text-sm text-slate-500 mt-1">{{ __('Rejoignez-nous et prenez soin de votre santé') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Nom complet') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-user"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Ex: Jean Dupont" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Email') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="exemple@email.com" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Mot de passe') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1">{{ __('Confirmer le mot de passe') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fas fa-check-circle"></i>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" 
                       class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl transition-all text-sm" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center pt-4 gap-4">
            <button type="submit" class="w-full med-gradient text-white py-3 rounded-xl font-bold text-sm tracking-wide hover:shadow-lg hover:shadow-teal-500/30 transform hover:-translate-y-0.5 transition-all">
                {{ __('S\'INSCRIRE') }}
            </button>
            
            <a class="text-sm text-slate-500 hover:text-teal-600 font-medium transition-colors" href="{{ route('login') }}">
                {{ __('Déjà inscrit ? Connectez-vous ici') }}
            </a>
        </div>
    </form>
</x-guest-layout>
