<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
   
    public function index()
    {
        return Inertia::render('Blogs/Index',[
            
        ]);
    }

   
    public function store(Request $request)
    {
        //validamos los datos ingresados en el formulario para crear el posts
        $validate = $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:255',
        ]);

        // se establece una relación uno a muchos
        $request->user()->posts()->create($validate);

        // si todo esta bien se guardan los datos y se redirige a la vista establecida en el método index
        return redirect(route('posts.index'));
    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
