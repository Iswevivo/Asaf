@extends('layouts.base')

@section('title', 'Show program')

@section('content')
    <div class="p-6 transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Intitule : <span class="text-xl font-semibold text-gray-700">{{ $program->title }}</span></p>
                </div>
                <div class="col-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Jours : <span class="text-xl font-semibold text-gray-700">{{ $program->days }}</span></p>
                </div>
            </div>
            <div class="grid grid-cols-12 border border-s-gray-950 p-1">
                <p class="text-xl font-semibold text-blue-500">Description  : <span class="text-xl font-semibold text-gray-700">{{ $program->description }}</span></p>
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Timing : <span class="text-xl font-semibold text-gray-700">{{ $program->timing }}</span></p>
                </div>
                <div class="col-span-6 border border-s-gray-950 p-1">
                    <p class="text-xl font-semibold text-blue-500">Centre organisateur : <span class="text-xl font-semibold text-gray-700">{{ $program->center->name ?? 'Centre inconnu' }}</span></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-3">
            <a href="{{ route('programs.edit', $program->slug) }}"
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
            <p>Êtes-vous sûr de vouloir supprimer ce programme ? Cette action est irréversible.</p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" 
                    class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-200">Annuler</button>
                <form action="{{ route('programs.destroy', $program) }}" method="post" class="ml-2">
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
