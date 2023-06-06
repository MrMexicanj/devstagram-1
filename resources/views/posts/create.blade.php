@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicación
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center">
        </form>
        </div>

        <div class="md:w-1/2 px-10 bg-slate-300 p-6 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="/crear-cuenta" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input 
                    id="titulo" 
                    name="titulo" 
                    type="text" 
                    placeholder="Titulo de publicacion" 
                    class="border p-3 w-full rounded-lg @error('name') border-red-500
                    @enderror"
                    value="{{ old('titulo') }}"/>
                </div>

                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
        
                <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripcion
                </label>
                <textarea 
                id="descripcion" 
                name="descripcion" 
                placeholder="Descripcion de la publicacion" 
                class="border p-3 w-full rounded-lg @error('name') border-red-500
                @enderror"
                >{{ old('titulo') }}</textarea>
                </div>

                @error('titulo')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

                <input 
                type="submit" 
                value="Crear Publicación" 
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" 
                />
            </div>
        </div>
    </form>
</div>
@endsection