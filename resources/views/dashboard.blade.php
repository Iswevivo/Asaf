@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Dashboard Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 content-center items-center text-center">

            <!-- Carte Statistiques - Posts -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Posts</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $posts->count() }}</p>
                    </div>
                    <i class="fas fa-newspaper text-4xl text-blue-400"></i>
                </div>
                <a href="{{ route('posts.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-newspaper mr-2"></i>Gérer Posts
                </a>
            </div>

            <!-- Carte Statistiques - Utilisateurs -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Utilisateurs</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ $users->count() }}</p>
                    </div>
                    <i class="fas fa-users text-4xl text-purple-400"></i>
                </div>
                <a href="#" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-users mr-2"></i>Gérer Utilisateurs
                </a>
            </div>

            <!-- Carte Statistiques - Centres de formation -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Centres de formation</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $centers->count() }}</p>
                    </div>
                    <i class="fas fa-building text-4xl text-red-400"></i>
                </div>
                <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-building mr-2"></i>Gérer Centres
                </a>
            </div>

            <!-- Ajoutez d'autres cartes avec des couleurs uniques et des icônes appropriées -->

            <!-- Carte Statistiques - Programmes -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Programmes</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $programs->count() }}</p>
                    </div>
                    <i class="fas fa-graduation-cap text-4xl text-yellow-400"></i>
                </div>
                <a href="#" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-graduation-cap mr-2"></i>Gérer Programmes
                </a>
            </div>

            <!-- Carte Statistiques - Evènements -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Evènements</h3>
                        <p class="text-3xl font-bold text-pink-600">{{ $events->count() }}</p>
                    </div>
                    <i class="fas fa-calendar-alt text-4xl text-pink-400"></i>
                </div>
                <a href="#" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-calendar-alt mr-2"></i>Gérer Evènements
                </a>
            </div>

            <!-- Carte Statistiques - Total commentaires -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Total commentaires</h3>
                        <p class="text-3xl font-bold text-teal-600">{{ $comments->count() }}</p>
                    </div>
                    <i class="fas fa-comments text-4xl text-teal-400"></i>
                </div>
                <a href="#" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-comments mr-2"></i>Gérer Commentaires
                </a>
            </div>

            <!-- Carte Statistiques - Images stockées -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Images stockées</h3>
                        <p class="text-3xl font-bold text-orange-600">{{ $images->count() }}</p>
                    </div>
                    <i class="fas fa-images text-4xl text-orange-400"></i>
                </div>
                <a href="#" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-images mr-2"></i>Archiver Images
                </a>
            </div>

            <!-- Carte Statistiques - Dons obtenus -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Dons obtenus</h3>
                        <p class="text-3xl font-bold text-indigo-600">{{ $donations->count() }}</p>
                    </div>
                    <i class="fas fa-hand-holding-heart text-4xl text-indigo-400"></i>
                </div>
                <a href="#" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-hand-holding-heart mr-2"></i>Voir Dons
                </a>
            </div>

            <!-- Carte Statistiques - Projets -->
            <div class="bg-white p-6 shadow-lg rounded-xl transition transform hover:scale-105 duration-300">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700">Projets</h3>
                        <p class="text-3xl font-bold text-cyan-600">{{ $projects->count() }}</p>
                    </div>
                    <i class="fas fa-comments text-4xl text-teal-400"></i>
                </div>
                <a href="#" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-images mr-2"></i>Gérer les projets
                </a>
            </div>
@endsection

@section('footer')
    le footer ici
@endsection