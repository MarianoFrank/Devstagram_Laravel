@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <img src="{{ asset('img/login.jpg') }}" alt="" class="md:w-2/3 md:block hidden  object-cover">
        <div class="flex flex-col justify-center item-center m-20 md:w-1/3 w-full">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Ingresa a tu cuenta
                    👋
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email">Email</label>
                        <x-input-text name="email" placeholder="Tu email" type="email" />
                      

                    </div>


                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password">Password</label>
                            <div class="text-sm">
                                <a href="#" class="font-semibold text-primario-600 hover:text-primario-500">¿
                                    Olvidaste tu
                                    password ?</a>
                            </div>
                        </div>
                        <x-input-text name="password" placeholder="Tu password" type="password" />
                       
                    </div>

                    <div class="mb-5 flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="cursor-pointer">
                        <label for="remember" class="cursor-pointer"> Mantener sesión abierta</label>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-primario-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primario-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primario-600">Ingresar</button>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('register') }}" class="font-semibold text-primario-600 hover:text-primario-500">¿
                            Aún no tienes cuenta ?</a>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
