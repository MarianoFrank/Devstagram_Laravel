<button type="{{ $type }}" id="{{ $id }}" class=" block rounded px-3 py-1 text-base
@if($style === 1)
bg-primario-600 text-zinc-50 
@elseif ($style === 2)
border border-slate-200
@endif
">
    {{ $value }}
</button>
