@php
    $hasError = $errors->isNotEmpty();
@endphp
<div class="mt-2">
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        value="@if ($old) {{ old($name) }} @endif"
        @style(['border-color: red' => $hasError])
        class="p-2 block w-full rounded-md  py-1.5 text-gray-900 border border-slate-300">
</div>
@error($name)
    <p class="text-red-600">{{ $message }}</p>
@enderror
