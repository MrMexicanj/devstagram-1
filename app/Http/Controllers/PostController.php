<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{   
    //autenticación para todas las rutas excepto 'show' e 'index'
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    // Recibe un objeto User como parámetro de ruta, metodo index para mostrar las publicaciones de un usuario especifico
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(6);

        // Devuelve la vista 'dashboard' con los datos del usuario y las publicaciones
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //creando metodo "create" para publicaciones
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Crea una nueva instancia del modelo Post con los datos proporcionados y guarda la publicación en la base de datos
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);
        // Redirige al indice de publicaciones del usuario actual
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        // Devuelve la vista 'posts.show' con los datos de la publicación y el usuario
        return view('posts.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        // Verifica si el usuario actual tiene permiso para eliminar la publicacion
       $this->authorize('delete', $post);
       // Elimina la publicación de la base de datos
       $post->delete();

       //Eliminar imagen
       $imagen_path = public_path('uploads/' . $post->imagen);

       if(File::exists($imagen_path)){
            unlink($imagen_path);
       }
       //redirecciona al muro principal
       return redirect()->route('posts.index', auth()->user()->username);
    }
}

