<div class="mt-2">
    <textarea id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        class="@error($name) border-red-400 @enderror p-2 block w-full rounded-md  py-1.5 text-gray-900 border resize-none h-80" >{{ ($old) ? old($name) : "" }}</textarea>
</div>
@error($name)
    <p class="text-red-600">{{ $message }}</p>
@enderror