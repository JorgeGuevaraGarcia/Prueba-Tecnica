@extends('layouts.app')

@section('titulo')
    Formulario
@endsection

@push('styles')


@section('contenido')
    <div class="md:flex  md:justify-center md:gap-10 md:items-center" style="margin-top: 1cm;">
        <div class="md:w-5/12 bg-white p-6 rounded-1g shadow-xl">
            {{-- no validate para validar cosas del lado del serivdor --}}
            <form action="{{route('formulario.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                {{-- csrf sirve para evitar ataques de bots y evitar llenar la tabla de datos basura --}}    
                @csrf
                {{-- Tambien crea un token seguro --}}
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif

                {{-- Nombre del archivo --}}
                <div class="mb-5">
                    <label for="nombre" class="mb-2 block uppercase text-cyan-700 font-bold">Nombre del archivo</label>
                    <input id="nombre" name="nombre" type="text" placeholder="Nombre del archivoo"
                        class="border p-3 w-full rounded-lg @error('nombre') border-red-500 @enderror" value="{{old('nombre')}} " required/>
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('nombre')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>
                {{-- Subir archvio --}}
                <div class="mb-5">
                    <label for="nombre_archivo" class="mb-2 block uppercase text-cyan-700 font-bold">Cargar archivo</label>
                    <input id="nombre_archivo" name="nombre_archivo" type="file" accept=".pdf"
                        class="border p-3 w-full rounded-lg @error('nombre_archivo') border-red-500 @enderror" value="{{old('nombre_archivo')}}" required/>
                    {{-- Directiva para mostrar mensaje de error--}}
                    @error('nombre_archivo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="Subir"
                    class="bg-gray-800 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection


