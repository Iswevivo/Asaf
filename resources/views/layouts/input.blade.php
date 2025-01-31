@php
    $type ??= 'text';
    $name ??= '';
    $label ??= $name;
    $class ??= '';
    $value ??= '';
    $multiple ??= false;
    $isTextarea ??= false; // Nouvelle variable pour déterminer si c'est un textarea
@endphp

<div @class(['mb-6', $class])>
    <label for="{{$name}}" class="block mb-2 text-sm font-bold">{{$label}}</label>

    @if($isTextarea)
        <textarea id="{{$name}}" name="{{$name}}@if($multiple != false)[]@endif" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
            @error($name) border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">{{ old($name, $value) }}</textarea>
    @else
        <input type="{{$type}}" id="{{$name}}" @if($multiple != false) multiple @endif name="{{$name}}@if($multiple != false)[]@endif" value="{{ old($name, $value) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
            @error($name) border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
    @endif

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    <!-- Affichage des erreurs spécifiques aux fichiers d'images -->
    @if($multiple != false)
        @foreach ($errors->get("{$name}.*") as $key => $messages)
            @foreach ($messages as $message)
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @endforeach
        @endforeach
    @endif
</div>
