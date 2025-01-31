@extends('layouts.base')

@section('title')
    @if (Route::currentRouteName() === 'categories.create')
        New category
    @else
        Edit category
    @endif
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <div class="max-w-md mx-auto overflow-hidden bg-white rounded shadow-md md:max-w-xl">
            <div class="p-6">
                <h2 class="mb-6 text-2xl font-bold">
                    @if (Route::currentRouteName() === 'categories.create')
                        Créer une nouvelle categorie
                    @else
                        Mettre à jour laa categorie
                    @endif
                </h2>

                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('layouts.error')
                    @include('layouts.input', ['label'=> 'Nom de la categorie', 'name'=> 'name', 'value'=> old('name')])
                    
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @if (Route::currentRouteName() === 'categories.create')
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
