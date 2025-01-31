@extends('layouts.base')

@section('title', 'Show post images')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        @foreach ($post->images as $image)
            <div class="p-2 transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105">
                <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $post->title }}" class="object-cover w-full h-64 rounded-lg">
            </div>
        @endforeach
    </div>
    @endsection