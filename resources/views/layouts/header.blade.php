@if (!isset($header) || $header)
    <header class="flex justify-between items-center py-10 mx-auto max-w-screen-xl w-[90%]">

        <a href="/" class="flex gap-2 items-center">
            <img src="{{ asset('img/logo-icon.svg') }}" class="max-w-12 max-h-12 ">
            <style>
                /* Definición de clase de gradiente de texto */
                .text-gradient {
                    background: linear-gradient(to right, #1e3a8a, #93c5fd);
                    -webkit-background-clip: text;
                    background-clip: text;
                    color: transparent;
                }
            </style>
            <p class="text-xl font-bold flex uppercase">Dev<span class="text-gradient">Stagram</span></p>
        </a>


        <div>
            <form action="{{ route('find.index') }}" method="GET" class="border-b">
                <input placeholder="Busca un usuario..." type="text" name="user" class=" border-none p-2 outline-none">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <nav class="flex gap-5  items-center ">


            @auth

                <a class="rounded px-2 py-1 hover:bg-slate-100 border border-slate-200"
                    href="{{ route('posts.create') }}"><i class="bi bi-camera"></i> Crear</a>

                <a href="{{ route('posts.index', Auth::user()->username) }}" class="hover:text-primario-300">Hola,
                    {{ auth()->user()->name }}</a>

                <div class="flex items-center gap-2 text-red-600 py-1 px-3 rounded hover:text-red-300">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">LogOut</button>
                    </form>

                    <i class="bi bi-arrow-bar-right"></i>
                </div>
            @endauth

            @guest
                <div class="flex items-center gap-2 text-primario-700 py-1 px-3 rounded hover:text-primario-300">
                    <a class="" href="{{ route('login') }}">LogIn</a>
                    <i class="bi bi-arrow-right"></i>
                </div>
                <a class="rounded-full hover:text-primario-300" href="{{ route('register') }}">Register Now</a>

            @endguest

        </nav>

    </header>
@endif
