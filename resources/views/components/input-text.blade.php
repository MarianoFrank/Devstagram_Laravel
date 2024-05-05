<div class="mt-2">
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        value="@if($old && $value === ''){{ old($name) }}@else{{ $value }}@endif"
        class="p-2 block w-full rounded-md  text-gray-900 border border-slate-300 @error($name) border-red-600 @enderror"/>
</div>
@error($name)
    <p class="text-red-600">{{ $message }}</p>
@enderror
