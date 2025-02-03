@extends('layouts.base')

@section('title', 'Show center')

@section('content')
    <div class="p-6 transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-col-12 gap-4">
                <div class="cols-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Nom du centre : <span class="text-xl font-semibold text-gray-700">{{ $center->name }}</span></p>
                </div>
                <div class="cols-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Actif : <span class="text-xl font-semibold text-gray-700">{{ $center->is_active == true ? 'Oui' : 'Non' }}</span></p>
                </div>
            </div>
            <div class="grid grid-col-12 border border-s-gray-950 p-1">
                <p class="text-xl font-semibold text-blue-500">Description du centre : <span class="text-xl font-semibold text-gray-700">{{ $center->description }}</span></p>
            </div>
            <div class="grid grid-col-12">
                <div class="cols-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Adresse : <span class="text-xl font-semibold text-gray-700">{{ $center->address }}</span></p>
                </div>
                <div class="cols-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Email : <span class="text-xl font-semibold text-gray-700">{{ $center->email }}</span></p>
                </div>
                
                <div class="cols-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Telephone : <span class="text-xl font-semibold text-gray-700">{{ $center->phone}}</span></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-3">
            <a href="{{ route('centres.edit', $center->name) }}"
                class="px-6 py-3 font-bold text-center text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg hover:bg-blue-700 hover:scale-105">
                Mettre à jour 
            </a>
            <!-- Bouton pour ouvrir le modal -->
            <button onclick="openModal()" 
                class="px-6 py-3 font-bold text-center text-white transition duration-300 ease-in-out transform bg-red-500 rounded-lg hover:bg-red-700 hover:scale-105">
                Supprimer
            </button>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-lg font-semibold">Confirmer la suppression</h2>
            <p>Êtes-vous sûr de vouloir supprimer ce centre ? Cette action est irréversible.</p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" 
                    class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-200">Annuler</button>
                <form action="{{ route('centres.destroy', $center) }}" method="post" class="ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
