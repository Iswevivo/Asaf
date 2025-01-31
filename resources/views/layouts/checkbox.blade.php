@php
    $name ??= '';
    $label ??= $name;
    $class ??= '';
    $value ??= '';
@endphp

<div class="mb-6 form-check {{ $class ?? '' }}">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" @checked(old($name, $value ?? false)) value="1" id="{{ $name }}"
           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
                  @error($name) border-red-500 ring-red-500 @enderror"
           role="switch">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</label>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
