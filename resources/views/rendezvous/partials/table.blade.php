@if($rendezvous->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    @if(!auth()->user()->isPatient())
                        <th class="py-3.5 px-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <i class="fas fa-user mr-1.5 text-slate-400"></i>{{ __('Patient') }}
                        </th>
                    @endif
                    @if(!auth()->user()->isMedecin())
                        <th class="py-3.5 px-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <i class="fas fa-user-md mr-1.5 text-slate-400"></i>{{ __('Médecin') }}
                        </th>
                    @endif
                    <th class="py-3.5 px-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <i class="fas fa-stethoscope mr-1.5 text-slate-400"></i>{{ __('Service') }}
                    </th>
                    <th class="py-3.5 px-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <i class="fas fa-calendar mr-1.5 text-slate-400"></i>{{ __('Date & Heure') }}
                    </th>
                    <th class="py-3.5 px-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Statut') }}</th>
                    <th class="py-3.5 px-5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($rendezvous as $rdv)
                    <tr class="hover:bg-teal-50/30 transition-colors duration-150 group">
                        @if(!auth()->user()->isPatient())
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs flex-shrink-0">
                                        {{ strtoupper(substr($rdv->patient->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-slate-800">{{ $rdv->patient->name ?? '-' }}</span>
                                </div>
                            </td>
                        @endif
                        @if(!auth()->user()->isMedecin())
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 flex-shrink-0">
                                        <i class="fas fa-user-md text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-800">Dr. {{ $rdv->medecin->name ?? '-' }}</p>
                                        @if(isset($rdv->medecin->specialite))
                                            <p class="text-xs text-slate-400">{{ $rdv->medecin->specialite }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        @endif
                        <td class="py-3.5 px-5">
                            <span class="text-sm text-slate-700 font-medium">{{ $rdv->service->nom ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-5">
                            <div class="text-sm text-slate-700">
                                <p class="font-medium">{{ $rdv->date_heure ? $rdv->date_heure->format('d/m/Y') : '-' }}</p>
                                <p class="text-xs text-slate-400"><i class="fas fa-clock mr-1"></i>{{ $rdv->date_heure ? $rdv->date_heure->format('H:i') : '-' }}</p>
                            </div>
                        </td>
                        <td class="py-3.5 px-5">
                            @if($rdv->statut === 'en_attente')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    {{ __('en_attente') }}
                                </span>
                            @elseif($rdv->statut === 'confirme')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('confirme') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    {{ __('annule') }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-5">
                            <div class="flex items-center justify-center gap-1.5">
                                @if($rdv->statut === 'en_attente')
                                    @if(auth()->user()->isAdmin())
                                        <form action="{{ route('rendezvous.confirm', $rdv) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                title="{{ __('Confirmer') }}"
                                                class="inline-flex items-center gap-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all hover:-translate-y-0.5 shadow-sm hover:shadow-emerald-500/30">
                                                <i class="fas fa-check text-[10px]"></i>
                                                {{ __('Confirmer') }}
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('rendezvous.cancel', $rdv) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                            title="{{ __('Annuler') }}"
                                            class="inline-flex items-center gap-1.5 bg-amber-400 hover:bg-amber-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all hover:-translate-y-0.5 shadow-sm">
                                            <i class="fas fa-ban text-[10px]"></i>
                                            {{ __('Annuler') }}
                                        </button>
                                    </form>

                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-rendezvous-{{ $rdv->id }}')"
                                        title="{{ __('Modifier') }}"
                                        class="inline-flex items-center gap-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-all hover:-translate-y-0.5 shadow-sm">
                                        <i class="fas fa-pen text-[10px]"></i>
                                        {{ __('Modifier') }}
                                    </button>
                                @endif

                                {{-- Trigger Delete Modal instead of confirm() --}}
                                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-rendezvous-{{ $rdv->id }}')"
                                    title="{{ __('Supprimer') }}"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white rounded-lg transition-all hover:-translate-y-0.5 border border-red-200 hover:border-red-500">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <x-modal name="edit-rendezvous-{{ $rdv->id }}" :show="false" focusable>
                        <form method="post" action="{{ route('rendezvous.update', $rdv) }}" class="p-6">
                            @csrf @method('PUT')
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 med-gradient rounded-xl flex items-center justify-center">
                                    <i class="fas fa-calendar-edit text-white"></i>
                                </div>
                                <h2 class="text-lg font-bold text-slate-800">{{ __('Modifier') }} #{{ $rdv->id }}</h2>
                            </div>

                            <div class="space-y-4">
                                @if(auth()->user()->isAdmin())
                                    <div>
                                        <x-input-label for="patient_id_{{ $rdv->id }}" :value="__('Patient')" />
                                        <select id="patient_id_{{ $rdv->id }}" name="patient_id"
                                            class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}" {{ $rdv->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div>
                                    <x-input-label for="medecin_id_{{ $rdv->id }}" :value="__('Médecin')" />
                                    <select id="medecin_id_{{ $rdv->id }}" name="medecin_id"
                                        class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                                        @foreach($medecins as $medecin)
                                            <option value="{{ $medecin->id }}" {{ $rdv->medecin_id == $medecin->id ? 'selected' : '' }}>Dr. {{ $medecin->name }} ({{ $medecin->specialite }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="service_id_{{ $rdv->id }}" :value="__('Service')" />
                                    <select id="service_id_{{ $rdv->id }}" name="service_id"
                                        class="border-slate-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm block mt-1 w-full text-sm" required>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ $rdv->service_id == $service->id ? 'selected' : '' }}>{{ $service->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="date_heure_{{ $rdv->id }}" :value="__('Date & Heure')" />
                                    <x-text-input id="date_heure_{{ $rdv->id }}" name="date_heure" type="datetime-local"
                                        class="mt-1 block w-full rounded-xl border-slate-200 focus:border-teal-500 focus:ring-teal-500"
                                        :value="optional($rdv->date_heure)->format('Y-m-d\TH:i')" required />
                                </div>
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Annuler') }}</x-secondary-button>
                                <button type="submit" class="inline-flex items-center gap-2 med-gradient text-white px-5 py-2 rounded-xl font-semibold text-sm hover:-translate-y-0.5 transition-all shadow-sm">
                                    <i class="fas fa-save"></i>
                                    {{ __('Enregistrer') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>

                    {{-- Delete Modal --}}
                    <x-modal name="delete-rendezvous-{{ $rdv->id }}" :show="false" focusable>
                        <form method="post" action="{{ route('rendezvous.destroy', $rdv) }}" class="p-6">
                            @csrf @method('DELETE')
                            <div class="flex items-center justify-center mb-4 text-red-500">
                                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center text-2xl">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800 text-center mb-2">{{ __('Confirmer la suppression') }}</h2>
                            <p class="text-sm text-slate-500 text-center mb-6">
                                {{ __('Êtes-vous sûr de vouloir supprimer ce rendez-vous ? Cette action est irréversible.') }}
                            </p>
                            <div class="flex justify-center gap-3">
                                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Annuler') }}</x-secondary-button>
                                <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl font-semibold text-sm transition-all shadow-sm">
                                    <i class="fas fa-trash-alt"></i>
                                    {{ __('Oui, supprimer') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>

                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-5 py-4 border-t border-slate-100">
        {{ $rendezvous->links() }}
    </div>
@else
    <div class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4 text-3xl">
            <i class="fas fa-calendar-times"></i>
        </div>
        <p class="text-slate-500 font-medium">{{ __('Aucun rendez-vous trouvé.') }}</p>
    </div>
@endif
