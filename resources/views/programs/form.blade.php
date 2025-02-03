@extends('layouts.base')

@section('title')
    @if (Route::currentRouteName() === 'programs.create')
        New program
    @else
        Edit program
    @endif
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <div class="max-w-md mx-auto overflow-hidden bg-white rounded shadow-md md:max-w-xl">
            <div class="p-6">
                <h2 class="mb-6 text-2xl font-bold">
                    @if (Route::currentRouteName() === 'programs.create')
                        Ajouter un programme
                    @else
                        Mettre à jour le programme
                    @endif
                </h2>

                <form action="@if (Route::currentRouteName() === 'programs.create') {{ route('programs.store') }} @else {{ route('programs.update', $program) }} @endif" method="POST">
                    @csrf
                    @if(Route::currentRouteName() !== 'programs.create')
                        @method('PUT')
                    @endif

                    @include('layouts.error')
                    @include('layouts.input', ['label'=> 'Nom du programme', 'name'=> 'title', 'value'=> old('title', $program->title ?? '')])
                    @include('layouts.input', ['label'=> 'Description', 'isTextarea' => true, 'name'=> 'description', 'value'=> old('description', $program->description ?? '')])
                    @include('layouts.input', ['label'=> 'Jours concernes', 'name'=> 'days', 'value'=> old('days', $program->days ?? '')])
                    @include('layouts.input', ['label'=> 'Heures de programme', 'name'=> 'timing', 'value'=> old('timing', $program->timing ?? '')])
                    @include('layouts.select', ['label'=> 'Centre organisateur', 'name'=> 'center_id', 'options' => $centers, 'value'=> old('center_id', $program->center_id ?? '')])

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @if (Route::currentRouteName() === 'programs.create')
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
