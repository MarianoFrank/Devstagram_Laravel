<div class="mt-2">
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        value="@if($old){{ old($name) }}@endif"
        class="@error($name) border-red-400 @enderror p-2 block w-full rounded-md border py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primario-600 sm:text-sm sm:leading-6">
</div>
