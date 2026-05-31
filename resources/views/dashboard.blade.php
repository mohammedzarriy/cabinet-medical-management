<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome message -->
            <div class="glass-card sm:rounded-3xl p-8 border border-white/50 flex items-center justify-between med-gradient relative overflow-hidden shadow-xl shadow-primary-500/20">
                <div class="absolute right-0 top-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-heading font-extrabold text-white mb-2">{{ __('Bienvenue') }}, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-primary-50 font-medium">{{ __('Voici un aperçu de vos activités aujourd\'hui.') }}</p>
                </div>
                <div class="hidden sm:block relative z-10">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm text-white rounded-2xl flex items-center justify-center shadow-inner border border-white/30 rotate-3 hover:rotate-6 transition-transform">
                        <i class="fas fa-heartbeat text-4xl"></i>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total -->
                <div class="glass-card sm:rounded-2xl p-6 border border-white/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-xl flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-calendar-alt text-xl"></i>
                        </div>
                        <div class="text-slate-500 text-sm font-bold uppercase tracking-wider">{{ __('Total Rendez-vous') }}</div>
                    </div>
                    <div class="text-4xl font-black font-heading text-slate-800">{{ $totalRendezvous ?? 0 }}</div>
                </div>

                <!-- Pending -->
                <div class="glass-card sm:rounded-2xl p-6 border border-white/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="text-slate-500 text-sm font-bold uppercase tracking-wider">{{ __('En Attente') }}</div>
                    </div>
                    <div class="text-4xl font-black font-heading text-slate-800">{{ $enAttente ?? 0 }}</div>
                </div>

                <!-- Confirmed -->
                <div class="glass-card sm:rounded-2xl p-6 border border-white/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-secondary-50 text-secondary-600 rounded-xl flex items-center justify-center group-hover:bg-secondary-500 group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div class="text-slate-500 text-sm font-bold uppercase tracking-wider">{{ __('Confirmés') }}</div>
                    </div>
                    <div class="text-4xl font-black font-heading text-slate-800">{{ $confirmes ?? 0 }}</div>
                </div>

                <!-- Cancelled -->
                <div class="glass-card sm:rounded-2xl p-6 border border-white/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-times-circle text-xl"></i>
                        </div>
                        <div class="text-slate-500 text-sm font-bold uppercase tracking-wider">{{ __('Annulés') }}</div>
                    </div>
                    <div class="text-4xl font-black font-heading text-slate-800">{{ $annules ?? 0 }}</div>
                </div>
            </div>

            <!-- Admin Extra Stats -->
            @if(auth()->user()->isAdmin())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-indigo-600 overflow-hidden shadow-lg sm:rounded-2xl p-6 text-white flex items-center justify-between">
                    <div>
                        <div class="text-indigo-200 text-sm font-medium mb-1">{{ __('Patients') }}</div>
                        <div class="text-3xl font-bold">{{ $totalPatients ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="bg-teal-600 overflow-hidden shadow-lg sm:rounded-2xl p-6 text-white flex items-center justify-between">
                    <div>
                        <div class="text-teal-200 text-sm font-medium mb-1">{{ __('Médecins') }}</div>
                        <div class="text-3xl font-bold">{{ $totalMedecins ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
                <div class="bg-cyan-600 overflow-hidden shadow-lg sm:rounded-2xl p-6 text-white flex items-center justify-between">
                    <div>
                        <div class="text-cyan-200 text-sm font-medium mb-1">{{ __('Services') }}</div>
                        <div class="text-3xl font-bold">{{ $totalServices ?? 0 }}</div>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
            </div>
            @endif

            <!-- Charts & Recent Rendezvous -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Chart Section -->
                <div class="glass-card sm:rounded-3xl border border-white/50 shadow-xl overflow-hidden p-6 lg:col-span-1">
                    <h3 class="text-xl font-heading font-extrabold text-slate-800 flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        {{ __('Répartition des MDI') }}
                    </h3>
                    <div class="relative h-64 w-full">
                        <canvas id="rdvChart"></canvas>
                    </div>
                </div>

                <!-- Recent Rendezvous -->
                <div class="glass-card sm:rounded-3xl border border-white/50 shadow-xl overflow-hidden lg:col-span-2">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-heading font-extrabold text-slate-800 flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            {{ __('Derniers Rendez-vous') }}
                        </h3>
                        <a href="{{ route('rendezvous.index') }}" class="text-sm font-bold text-primary-600 hover:text-primary-800 transition-colors bg-primary-50 px-4 py-2 rounded-lg">{{ __('Voir tout') }} &rarr;</a>
                    </div>
                    
                    @if(isset($derniers) && $derniers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm whitespace-nowrap">
                                <thead class="uppercase tracking-wider border-b-2 border-gray-100 text-gray-500 font-semibold bg-gray-50/50">
                                    <tr>
                                        @if(!auth()->user()->isPatient())
                                            <th class="px-4 py-3">{{ __('Patient') }}</th>
                                        @endif
                                        @if(!auth()->user()->isMedecin())
                                            <th class="px-4 py-3">{{ __('Médecin') }}</th>
                                        @endif
                                        <th class="px-4 py-3">{{ __('Service') }}</th>
                                        <th class="px-4 py-3">{{ __('Date & Heure') }}</th>
                                        <th class="px-4 py-3 text-center">{{ __('Statut') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($derniers as $rdv)
                                        <tr class="hover:bg-gray-50 transition">
                                            @if(!auth()->user()->isPatient())
                                                <td class="px-4 py-4 font-medium text-gray-900">{{ $rdv->patient->name }}</td>
                                            @endif
                                            @if(!auth()->user()->isMedecin())
                                                <td class="px-4 py-4 font-medium text-gray-900">Dr. {{ $rdv->medecin->name }}</td>
                                            @endif
                                            <td class="px-4 py-4 text-gray-600">{{ $rdv->service->nom }}</td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ $rdv->date_heure->format('d/m/Y') }}
                                                    <span class="text-gray-400">|</span>
                                                    {{ $rdv->date_heure->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-center">
                                                @if($rdv->statut === 'en_attente')
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                                        {{ __('en_attente') }}
                                                    </span>
                                                @elseif($rdv->statut === 'confirme')
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                        {{ __('confirme') }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                        {{ __('annule') }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500 flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            {{ __('Aucun rendez-vous trouvé.') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('rdvChart').getContext('2d');
            
            // Retrieve PHP variables, default to 0 if null
            const enAttente = {{ $enAttente ?? 0 }};
            const confirmes = {{ $confirmes ?? 0 }};
            const annules = {{ $annules ?? 0 }};

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['En attente', 'Confirmés', 'Annulés'],
                    datasets: [{
                        data: [enAttente, confirmes, annules],
                        backgroundColor: [
                            '#f59e0b', // Amber (En attente)
                            '#10b981', // Emerald (Confirmés)
                            '#ef4444'  // Red (Annulés)
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    family: "'Plus Jakarta Sans', sans-serif",
                                    size: 12
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</x-app-layout>
