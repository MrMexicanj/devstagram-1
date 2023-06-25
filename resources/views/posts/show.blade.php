@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') .'/'. $post->imagen}}" alt="ImagendelPost {{$post->titulo}}">

            <div class="p-3 text-center">
                <p>0 likes</p>
            </div>

            <div>
                <p class="font-bold text-center"> {{ $post->user->username }} </p>
                <p class="text-sm text-gray-500 text-center">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5 text-center"> {{ $post->descripcion}} </p>
            </div>

            <div class="text-center">
                @auth
                    @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <input 
                            type="submit"
                            value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font -bold mt-4 cursor-pointer"
                        />
                    </form>
                    @endif
                @endauth
            </div>
        </div>

        <div class="md:w-1/2 p-5">
            <div class="bg-slate-300 p-6 rounded-lg shadow-xl">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un comentario</p>

                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>
                @endif

                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentarios
                        </label>
                        <textarea 
                        id="comentario" 
                        name="comentario" 
                        placeholder="Comentar" 
                        class="border p-3 w-full rounded-lg @error('name') border-red-500
                    @enderror"
                    ></textarea>

                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <input 
                     type="submit" 
                    value="Comentar" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg my-3" 
                    />
                </form>

                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll">
                    @if ($post->comentarios->count())
                        @foreach ( $post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route('posts.index', $comentario->user)}}" class="font-bold">
                                    {{$comentario->user->username}}
                                </a>
                                <p> {{ $comentario->comentario }} </p>
                                <p> {{ $post->created_at->diffForHumans() }} </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay Comentarios</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection

