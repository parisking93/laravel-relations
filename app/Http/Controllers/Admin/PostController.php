<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// lo importo per poetr usare slug 
use Illuminate\Support\Str;

// collego i model 
use App\Category;
use App\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id'
            ]
        );



        $data = $request->all();
        $new_post = new Post();
        // non funzione con new_post->title  dobbiamo usare $data

        $slug_creato = Str::slug($data['title'], '-');

        // controllo se c'è un duplicato
        
        //vedo se è presente uno slug uguale a quello digitato
        $slug_database = Post::where('slug', $slug_creato)->first();
        $contatore = 1;
        while($slug_database) {
            $slug_creato .= '-' . $contatore;

            // ricontrollo che non ci sia sul database 
            $slug_database = Post::where('slug', $slug_creato)->first();

            $contatore++;
        }

        // dd( $slug_database );
        // alla fine del controllo lo aggiungo
        $new_post->slug = $slug_creato;

        $new_post->fill($data);
        $new_post->save();
        
        return redirect()->route('admin.posts.index')->with('add', 'Hai aggiunto con successo l\'elemento ' . $new_post->id);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id'
            ]
        );
        $data =$request->all();
        if($data['title'] != $post->title) {

            $slug_creato = Str::slug($data['title'], '-');

            // controllo se c'è un duplicato
            
            //vedo se è presente uno slug uguale a quello digitato
            $slug_database = Post::where('slug', $slug_creato)->first();
            $contatore = 1;
            while($slug_database) {
                $slug_creato .= '-' . $contatore;
    
                // ricontrollo che non ci sia sul database 
                $slug_database = Post::where('slug', $slug_creato)->first();
    
                $contatore++;
            }

            // inserisco lo slug generato in data 
            $data['slug'] = $slug_creato;
            
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('changed', 'Hai modificato con successo l\'elemento ' . $post->id);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', 'Hai cancellato con successo l\'elemento ' . $post->id);
    }
}
