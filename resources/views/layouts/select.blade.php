@php
    $multiple ??= false;
    $name ??= '';
    $label ??= $name;
    $class ??= '';
    $value ??= old($name, $value ?? ($multiple ? [] : ''));
@endphp

<div @class(['mb-6', $class])>
    <label for="{{$name}}" class="block mb-2 text-sm font-bold">{{$label}}</label>
    <select name="{{$name}}@if($multiple != false)[]@endif" id="{{$name}}" @if($multiple != false) multiple @endif class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error($name) border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">
        @if($multiple == false)
            <option value="">-----------------------------</option>
        @endif

        @foreach ($options as $k => $v)
            <option value="{{$k}}"
                @if($multiple != false)
                    {{ in_array($k, (array)$value) ? 'selected' : '' }}
                @else
                    {{ $value == $k ? 'selected' : '' }}
                @endif>
                {{$v}}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
