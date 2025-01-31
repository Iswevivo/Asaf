@extends('layouts.base')

@section('title')
    @if (Route::currentRouteName() === 'tags.create')
        New tag
    @else
        Edit tag
    @endif
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <div class="max-w-md mx-auto overflow-hidden bg-white rounded shadow-md md:max-w-xl">
            <div class="p-6">
                <h2 class="mb-6 text-2xl font-bold">
                    @if (Route::currentRouteName() === 'tags.create')
                        Créer une nouvelle etiquette
                    @else
                        Mettre à jour laa etiquette
                    @endif
                </h2>

                <form action="{{ route('tags.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('layouts.error')
                    @include('layouts.input', ['label'=> 'Nom de l\'etiquette', 'name'=> 'name', 'value'=> old('name')])
                    
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @if (Route::currentRouteName() === 'tags.create')
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
