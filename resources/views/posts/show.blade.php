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
            <h2 class="font-extrabold text-center m-4 text-gray-700">{{ $post->title }}</h2>
            <p>{{ ucfirst($post->created_at->translatedFormat('l j F Y')) }}</p>
        </div>
        <div class="text-gray-500 trix-content mb-8">
            {!! $post->content !!}
        </div>

        <div class="grid grid-cols-6 gap-3 mb-4">
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
        
    <hr>
    <div class="w-full mb-5 mt-4 flex flex-col">
        @include('layouts.error')
        <h2 class="font-bold mb-2">Commentaires sur ce post ({{$post->comments()->count()}})</h2>
    
        @foreach ($post->comments->sortByDesc('created_at') as $comment)
            <div class="flex items-start mb-4 w-full">
                <div class="relative w-10 h-10 mr-2">
                    @if (isset($comment->user->photo_url))
                        <img src="{{ asset('storage/' . $comment->user->photo_url) }}" alt="user profile" class="rounded-full w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gray-300 rounded-full text-gray-600">
                            <span>No profile</span>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <p class="font-semibold">{{ isset($comment->author->name) ? $comment->author->name : 'Incognito' }}</p>
                    <p>{{ $comment->content }}</p>
                </div>
                <div class="flex flex-col"><p class="text-green-600 font-semibold">Il y a {{$comment->created_at->diffForHumans()}}</p></div>
            </div>
            <hr>
        @endforeach
    
        <form action="{{ route('post.add_comment', $post) }}" method="POST" class="ml-2 w-full">
            @csrf
            @include('layouts.input', ['name' => 'content', 'label' => 'Ajouter un commentaire', 'isTextarea' => true, 'value' => old('comment'), 'class' => 'mb-4 mt-4'])            
            <button type="submit" class="mt-2 px-4 py-2 text-white bg-orange-600 rounded-md hover:bg-orange-700 w-full">Commenter</button>
        </form>
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
