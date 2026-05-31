<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                    {{ __('Gestion des Rendez-vous') }}
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ __('Gérez et suivez tous vos rendez-vous médicaux') }}</p>
            </div>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-rendezvous')"
                class="inline-flex items-center gap-2 med-gradient text-white font-semibold py-2.5 px-5 rounded-xl text-sm shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <i class="fas fa-plus"></i>
                {{ __('Nouveau Rendez-vous') }}
            </button>
        </div>
    </x-slot>

    <div class="space-y-5">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm animate-fadeIn">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm">
                <i class="fas fa-exclamation-circle text-red-500 text-lg mt-0.5"></i>
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Search Bar --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4">
            <form id="search-form" action="{{ route('rendezvous.index') }}" method="GET" class="flex gap-3" onsubmit="return false;">
                <div class="relative flex-1 max-w-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" id="search-input" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('Rechercher...') }}"
                        class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:border-teal-400 focus:ring-teal-400 focus:outline-none transition-colors" />
                </div>
                <button type="button" id="search-btn"
                    class="inline-flex items-center gap-2 med-gradient text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:-translate-y-0.5 transition-all shadow-sm">
                    <i class="fas fa-search text-xs"></i>
                    {{ __('Rechercher...') }}
                </button>
                <a href="{{ route('rendezvous.index') }}" id="clear-btn" style="display: none;"
                    class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors">
                    <i class="fas fa-times text-xs"></i>
                    {{ __('Fermer') }}
                </a>
            </form>
        </div>

        {{-- Table --}}
        <div id="table-container" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden relative min-h-[200px]">
            @include('rendezvous.partials.table')
        </div>
    </div>

    {{-- Create Modal --}}
    <x-modal name="create-rendezvous" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('rendezvous.store') }}" class="p-6">
            @csrf
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 med-gradient rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-slate-800">{{ __('Nouveau Rendez-vous') }}</h2>
            </div>

            <div class="space-y-4">
                @if(auth()->user()->isAdmin())
                    <div>
                        <x-input-label for="new_patient_id" :value="__('Patient')" />
                        <select id="new_patient_id" name="patient_id"
                            class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                            <option value="">{{ __('Sélectionner un patient') }}</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                    </div>
                @endif

                <div>
                    <x-input-label for="new_medecin_id" :value="__('Médecin')" />
                    <select id="new_medecin_id" name="medecin_id"
                        class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                        <option value="">{{ __('Sélectionner un médecin') }}</option>
                        @foreach($medecins as $medecin)
                            <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>Dr. {{ $medecin->name }} ({{ $medecin->specialite }})</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('medecin_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="new_service_id" :value="__('Service')" />
                    <select id="new_service_id" name="service_id"
                        class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                        <option value="">{{ __('Sélectionner un service') }}</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->nom }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="new_date_heure" :value="__('Date & Heure')" />
                    <x-text-input id="new_date_heure" name="date_heure" type="datetime-local"
                        class="mt-1 block w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500"
                        :value="old('date_heure')" required />
                    <x-input-error :messages="$errors->get('date_heure')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Annuler') }}</x-secondary-button>
                <button type="submit" class="inline-flex items-center gap-2 med-gradient text-white px-5 py-2 rounded-xl font-semibold text-sm hover:-translate-y-0.5 transition-all shadow-sm">
                    <i class="fas fa-plus"></i>
                    {{ __('Créer') }}
                </button>
            </div>
        </form>
    </x-modal>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const searchBtn = document.getElementById('search-btn');
        const clearBtn = document.getElementById('clear-btn');
        const tableContainer = document.getElementById('table-container');
        
        let timeout = null;

        function fetchResults(query) {
            // Show loading state implicitly or via skeleton if preferred
            tableContainer.style.opacity = '0.5';

            axios.get('{{ route("rendezvous.index") }}', {
                params: { search: query },
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(response) {
                tableContainer.innerHTML = response.data;
                tableContainer.style.opacity = '1';
                if(query.trim() !== '') {
                    clearBtn.style.display = 'inline-flex';
                } else {
                    clearBtn.style.display = 'none';
                }
            })
            .catch(function(error) {
                console.error("Error fetching data: ", error);
                tableContainer.style.opacity = '1';
            });
        }

        searchInput.addEventListener('input', function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchResults(this.value);
            }, 300); // 300ms debounce
        });

        searchBtn.addEventListener('click', function() {
            fetchResults(searchInput.value);
        });

        clearBtn.addEventListener('click', function(e) {
            e.preventDefault();
            searchInput.value = '';
            fetchResults('');
            clearBtn.style.display = 'none';
        });

        // Intercept pagination clicks to use Axios as well
        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                let url = new URL(e.target.closest('a').href);
                let query = searchInput.value;
                url.searchParams.set('search', query);

                tableContainer.style.opacity = '0.5';
                axios.get(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(response) {
                    tableContainer.innerHTML = response.data;
                    tableContainer.style.opacity = '1';
                });
            }
        });
    });
</script>
