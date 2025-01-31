@extends('layouts.base')

@section('title')
    @if (Route::currentRouteName() === 'posts.create')
        New post
    @else
        Edit post
    @endif
@endsection

@section('content')
    <div class="container mx-auto my-4">
        <div class="max-w-lg mx-auto overflow-hidden bg-white rounded shadow-md md:max-w-xl">
            <div class="p-6">
                @if (session('success'))
                    <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                <h2 class="mb-6 text-2xl font-bold">
                    @if (Route::currentRouteName() === 'posts.create')
                        Créer un nouveau post
                    @else
                        Mettre à jour le post
                    @endif
                </h2>
                <form action="@if (Route::currentRouteName() === 'posts.create') {{ route('posts.store') }} @else {{ route('posts.update', $post) }} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(Route::currentRouteName() !== 'posts.create')
                        @method('PUT')
                    @endif

                    @include('layouts.error')
                    @include('layouts.input', ['label'=> 'Titre', 'name'=> 'title', 'value'=> old('title', $post->title ?? '')])

                    <div class="grid grid-cols-12 gap-4 mb-6">
                        <div class="col-span-8">
                            @include('layouts.select', ['label' => 'Catégorie', 'name' => 'category_id', 'options' => $categories, 'value' => old('category_id', $post->category_id ?? '')])
                        </div>
                        <div class="col-span-4 mb-6 mt-10">
                            <div class="col-span-4">
                                <a href="{{ route('categories.create') }}"
                                   class="w-full px-6 py-3 font-bold text-center text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg shadow hover:bg-blue-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Ajouter
                                </a>
                            </div>
                        </div>
                    </div>
                    @include('layouts.trix-editor', ['label'=> 'Contenu du post', 'name'=> 'content', 'value'=> old('content', $post->content ?? '')])
                    <div class="grid grid-cols-12 gap-4 mb-6">
                        <div class="col-span-8">
                            @include('layouts.select', ['label'=> 'Choisir les tags', 'name'=> 'tags', 'options'=> $tags, 'multiple' => true, 'value' => old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []), 'class' => 'form-select'])
                        </div>
                        <div class="col-span-4 mb-6 mt-10">
                            <div class="col-span-4 mt-10">
                                <a href="{{ route('tags.create') }}" 
                                   class="w-full px-6 py-3 font-bold text-center text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-lg shadow hover:bg-green-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                    Ajouter
                                </a>    
                            </div>            
                        </div>
                    </div>
                    @include('layouts.select', ['label'=> 'Statut', 'name'=> 'status', 'options'=> ['draft' => 'Draft', 'published' => 'Publie', 'archived' => 'Archive'], 'value' => old('status', $post->status ?? '')])
                    @include('layouts.input', ['type' => 'file', 'label'=> 'Choisir les images d\'illustration', 'name'=> 'images', 'value'=> old('images'), 'multiple' => true])

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @if (Route::currentRouteName() === 'posts.create')
                            Creer
                        @else
                            Appliquer les modifications
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection