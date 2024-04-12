@if (!isset($footer) || $footer)
    <footer class="bg-slate-50 m-t-10 text-center py-3 m-t-auto text-sm">
        <p><span class="text-primario-700">Devstagram</span> &#169 Todos los derechos reservados.
            {{ now()->year }}
        </p>
    </footer>
@endif
