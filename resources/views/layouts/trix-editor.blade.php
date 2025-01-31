@php
    $label ??= null;
    $type ??= 'text';
    $name ??= $label;
    $class ??= '';
    $value ??= '';
@endphp

<div class="mb-6">
    <label for="content" class="block mb-2 text-sm font-medium text-gray-700">Contenu</label>
    <input type="hidden" id="{{$name}}" name="{{$name}}" value="{{old($name, $value)}}">

    <trix-editor input="content" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
    @error($name) border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"></trix-editor>

    @error($name)
        <p class="text-red-500 text-sm mt-1">  {{ $message }} </p>
    @enderror
</div>