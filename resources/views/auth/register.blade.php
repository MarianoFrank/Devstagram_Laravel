@extends('layouts.app')

@section('content')
    <div class="flex h-screen">

        <div class="flex flex-col justify-center item-center m-20 md:w-1/3 w-full">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Registra una cuenta
                    📋
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nombre">Nombre</label>
                        <x-input-text name="nombre" placeholder="Tu nombre" />
                      
                    </div>

                    <div>
                        <label for="username">UserName</label>
                        <x-input-text name="username" placeholder="Nombre de usuario" />
                        
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <x-input-text name="email" placeholder="Tu email" type="email" />
                       
                    </div>

                    <div>

                        <label for="password">Password</label>
                        <x-input-text name="password" type="password" />
                        

                    </div>

                    <div>
                        <label for="password_confirmation">Repite Password</label>
                        <x-input-text name="password_confirmation" type="password" :old=false />
                     
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-primario-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primario-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primario-600">Registrar</button>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('login') }}" class="font-semibold text-primario-600 hover:text-primario-500">¿ Ya
                            tienes cuenta
                            ?</a>
                    </div>
                </form>


            </div>
        </div>

        <img src="{{ asset('img/registrar.jpg') }}" alt="" class="md:w-2/3 md:block hidden object-cover">
    </div>
@endsection
