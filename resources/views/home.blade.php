@extends('layouts.base')

@section('title', 'Home')

@section('content')
    <div class="grid items-center content-center grid-cols-1 gap-6 text-center md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <div class="p-6 transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105">
                <!-- Carrousel d'images -->
                <div class="relative w-full mb-5 overflow-hidden carousel-container">
                    <div class="flex transition-transform duration-500 ease-in-out carousel-slide">
                        @foreach ($post->images as $image)
                            <div class="flex-shrink-0 w-full carousel-item">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $post->title }}"
                                    class="object-cover w-full h-64 rounded-lg">
                            </div>
                        @endforeach
                    </div>
                    <button
                        class="absolute left-0 px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 prev top-1/2">Prev</button>
                    <button
                        class="absolute right-0 px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 next top-1/2">Next</button>
                </div>

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">{{ $post->title }}</h3>
                        <p class="text-gray-500">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                    </div>
                </div>

                <a href="{{ route('posts.show', $post->slug) }}"
                    class="px-6 py-3 font-bold text-center text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg hover:bg-blue-700 hover:scale-105">
                    Voir Détails
                </a>
            </div>
        @endforeach
    </div>
@endsection
