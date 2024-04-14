@php
    $hasError = $errors->isNotEmpty();
@endphp

<div class="mt-2">
    <textarea id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
    @style(['border-color: red' => $hasError])
    class="p-2 block w-full rounded-md  py-1.5 text-gray-900 border resize-none h-80 border-slate-300" >{{ ($old) ? old($name) : "" }}
    </textarea>
</div>
@error($name)
    <p class="text-red-600">{{ $message }}</p>
@enderror