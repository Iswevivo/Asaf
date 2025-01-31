@extends('layouts.base')

@section('title', 'Show post')

@section('content')
    <div class="p-6 transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105">
        <!-- Carrousel d'images -->
        @if ($post->images)
            <div class="relative w-full mb-5 overflow-hidden carousel-container">
                <div class="flex transition-transform duration-500 ease-in-out carousel-slide">
                    @foreach ($post->images as $image)
                        <div class="flex-shrink-0 w-full carousel-item">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $post->title }}"
                                class="object-cover w-full h-64 rounded-lg">
                        </div>
                    @endforeach
                </div>
                <button class="absolute left-0 px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 prev top-1/2">Prev</button>
                <button class="absolute right-0 px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 next top-1/2">Next</button>
            </div>
        @endif

        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-xl font-semibold text-gray-700">{{ $post->title }}</h3>
                <p class="text-gray-500 trix-content">{!! $post->content !!}</p>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-3">
            <a href="{{ route('posts.edit', $post->slug) }}"
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
            <p>Êtes-vous sûr de vouloir supprimer ce post ? Cette action est irréversible.</p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" 
                    class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-200">Annuler</button>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="ml-2">
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
