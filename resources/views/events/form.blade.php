@extends('layouts.base')

@section('title')
    @if (Route::currentRouteName() === 'centres.create')
        New center
    @else
        Edit center
    @endif
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <div class="max-w-md mx-auto overflow-hidden bg-white rounded shadow-md md:max-w-xl">
            <div class="p-6">
                <h2 class="mb-6 text-2xl font-bold">
                    @if (Route::currentRouteName() === 'centres.create')
                        Ajouter un centre
                    @else
                        Mettre à jour le centre
                    @endif
                </h2>

                <form action="@if (Route::currentRouteName() === 'centres.create') {{ route('centres.store') }} @else {{ route('centres.update', $center->id) }} @endif" method="POST">
                    @csrf
                    @if(Route::currentRouteName() !== 'centres.create')
                        @method('PUT')
                    @endif

                    @include('layouts.error')
                    @include('layouts.input', ['label'=> 'Nom du centre', 'name'=> 'name', 'value'=> old('name', $center->name ?? '')])
                    @include('layouts.input', ['label'=> 'Description', 'isTextarea' => true, 'name'=> 'description', 'value'=> old('description', $center->description ?? '')])
                    @include('layouts.input', ['label'=> 'Adresse du centre', 'type' => 'address', 'name'=> 'address', 'value'=> old('address', $center->address ?? '')])
                    @include('layouts.input', ['label'=> 'Adresse electronique du centre', 'type' => 'email',  'name'=> 'email', 'value'=> old('email', $center->email ?? '')])
                    @include('layouts.input', ['label'=> 'Numero de telephone', 'name'=> 'phone', 'type' => 'phone',  'value'=> old('phone', $center->phone ?? '')])
                    @include('layouts.checkbox', ['label'=> 'Actif', 'name'=> 'is_active', 'value'=> old('is_active', $center->is_active ?? '')])

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @if (Route::currentRouteName() === 'centres.create')
                            Ajouter
                        @else
                            Appliquer les modifications
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
