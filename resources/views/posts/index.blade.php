@extends('layouts.base')

@section('title', 'Posts')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <h1 class="mb-8 text-4xl font-extrabold text-gray-800">Liste des Posts</h1>
        @if (session('success'))
            <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">{{session('success')}}</span>
            </div>
        @endif

        <a href="{{ route('posts.create') }}"
            class="px-6 py-3 font-bold text-white transition duration-300 ease-in-out transform bg-green-500 rounded-lg hover:bg-green-800 hover:scale-105">
            Nouveau post
        </a>
    </div>
    
    <table class="min-w-full bg-white border border-gray-300 shadow-lg">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Catégorie</th>
                <th class="px-4 py-2 border">Titre</th>
                <th class="px-4 py-2 border">Contenu</th>
                <th class="px-4 py-2 border">Tags</th>
                <th class="px-4 py-2 border">Auteur</th>
                <th class="px-4 py-2 border">Commentaires</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="hover:bg-gray-100 transition duration-300">
                    <td class="border px-4 py-2">{{ $post->id }}</td>
                    <td class="border px-4 py-2">{{ $post->category->name }}</td>
                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ \Illuminate\Support\Str::limit($post->content, 50) }}</td>
                    <td class="border px-4 py-2">
                        @foreach ($post->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2"> {{ $post->author ? $post->author->name : 'Inconnu' }}</td>
                    <td class="border px-4 py-2">{{ $post->comments->count() }}</td>
                    <td class="border border-b-0 px-4 py-2 flex space-x-2">
                        <a href="{{ route('post.images', $post->slug) }}" class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded">Images <sup>{{$post->images()->count()}}</sup></a>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 ">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endsection
