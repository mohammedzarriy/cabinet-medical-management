<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Services') }}
            </h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-service')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                {{ __('Nouveau Service') }}
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
                <form action="{{ route('services.index') }}" method="GET" class="flex gap-2">
                    <x-text-input name="search" value="{{ request('search') }}" class="w-full md:w-1/3" placeholder="{{ __('Rechercher...') }}" />
                    <x-primary-button>{{ __('Rechercher...') }}</x-primary-button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    @if($services->count() > 0)
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase">{{ __('Nom du Service') }}</th>
                                    <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase">{{ __('Description') }}</th>
                                    <th class="py-3 px-4 border-b text-left text-xs font-semibold text-gray-600 uppercase">{{ __('Prix') }}</th>
                                    <th class="py-3 px-4 border-b text-center text-xs font-semibold text-gray-600 uppercase">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($services as $service)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 font-medium">{{ $service->nom }}</td>
                                        <td class="py-3 px-4 text-sm text-gray-500">{{ $service->description }}</td>
                                        <td class="py-3 px-4">{{ $service->prix ? $service->prix . ' DH' : '-' }}</td>
                                        <td class="py-3 px-4 flex justify-center gap-2">
                                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-service-{{ $service->id }}')" class="text-blue-600 hover:text-blue-900 text-sm" title="{{ __('Modifier') }}">✏️</button>
                                            
                                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ?') }}');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" title="{{ __('Supprimer') }}">🗑️</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <x-modal name="edit-service-{{ $service->id }}" :show="false" focusable>
                                        <form method="post" action="{{ route('services.update', $service) }}" class="p-6">
                                            @csrf @method('PUT')
                                            <h2 class="text-lg font-medium text-gray-900">{{ __('Modifier') }}</h2>
                                            
                                            <div class="mt-6 space-y-4">
                                                <div>
                                                    <x-input-label for="nom_{{ $service->id }}" :value="__('Nom du Service')" />
                                                    <x-text-input id="nom_{{ $service->id }}" name="nom" type="text" class="mt-1 block w-full" :value="$service->nom" required />
                                                </div>
                                                <div>
                                                    <x-input-label for="description_{{ $service->id }}" :value="__('Description')" />
                                                    <textarea id="description_{{ $service->id }}" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ $service->description }}</textarea>
                                                </div>
                                                <div>
                                                    <x-input-label for="prix_{{ $service->id }}" :value="__('Prix')" />
                                                    <x-text-input id="prix_{{ $service->id }}" name="prix" type="number" step="0.01" class="mt-1 block w-full" :value="$service->prix" />
                                                </div>
                                            </div>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Annuler') }}</x-secondary-button>
                                                <x-primary-button class="ms-3">{{ __('Enregistrer') }}</x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $services->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('Aucun service trouvé.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <x-modal name="create-service" :show="$errors->isNotEmpty()" focusable>
        <form method="post" action="{{ route('services.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">{{ __('Nouveau Service') }}</h2>
            
            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="new_nom" :value="__('Nom du Service')" />
                    <x-text-input id="new_nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom')" required />
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="new_description" :value="__('Description')" />
                    <textarea id="new_description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="new_prix" :value="__('Prix')" />
                    <x-text-input id="new_prix" name="prix" type="number" step="0.01" class="mt-1 block w-full" :value="old('prix')" />
                    <x-input-error :messages="$errors->get('prix')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Annuler') }}</x-secondary-button>
                <x-primary-button class="ms-3">{{ __('Créer') }}</x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
