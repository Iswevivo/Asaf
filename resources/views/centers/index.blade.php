@extends('layouts.base')

@section('title', 'centers')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <h1 class="mb-8 text-4xl font-extrabold text-gray-800">Liste des centres</h1>
        @if (session('success'))
            <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">{{session('success')}}</span>
            </div>
        @endif

        <a href="{{ route('centres.create') }}"
            class="px-6 py-3 font-bold text-white transition duration-300 ease-in-out transform bg-green-500 rounded-lg hover:bg-green-800 hover:scale-105">
            Nouveau centre
        </a>
    </div>
    
    <table class="min-w-full bg-white border border-gray-300 shadow-lg">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Nom du centre</th>
                <th class="px-4 py-2 border">Description</th>
                <th class="px-4 py-2 border">Adresse</th>
                <th class="px-4 py-2 border">Contacts</th>
                <th class="px-4 py-2 border">Statut</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($centers as $center)
                <tr class="hover:bg-gray-100 transition duration-300">
                    <td class="border px-4 py-2">{{ $center->id }}</td>
                    <td class="border px-4 py-2">{{ $center->name }}</td>
                    <td class="border px-4 py-2">{{ \Illuminate\Support\Str::limit($center->description, 100) }}</td>
                    <td class="border px-4 py-2">{{ $center->address }}</td>
                    <td class="border px-4 py-2">
                        <p class="text-blue-300">{{ $center->phone }}</p>
                        <p class="text-black-500">{{ $center->email }}</p>
                    </td>
                    <td class="border px-4 py-2">{{ $center->is_active ==1 ? "Actif" : "Inactif" }}</td>
                    <td class="border border-b-0 px-4 py-2 flex space-x-2">
                        <a href="{{ route('centres.show', $center->name) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 ">Voir plus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <div class="mt-6">
        {{ $centers->links() }}
    </div>
@endsection
