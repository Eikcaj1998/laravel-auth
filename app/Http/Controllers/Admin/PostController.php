<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at','DESC')
        ->orderBy('created_at','DESC')
        ->simplePaginate(10);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $post = new Post();
        $categories = Category::select('id','label')->get();
        return view('admin.posts.create', compact('post','categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:50|unique:posts',
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id'=>'nullable|exists:categories,id'
        ],
        [
            'title.required'=>'il Titolo e obbligatorio',
            'content.required'=>'il contenuto e obbligatorio',
            'title.min'=>'il Titolo deve avere almeno :min caratteri',
            'title.unique'=>"Esiste già un post dal titolo $request->title",
            'image.url'=>'Url dell\'immagine non valida',
            'categy_id.exists'=>'Non esiste una categoria associabile',
        ]);

        $data = $request->all();
        $post = new Post;
        $post->fill($data);
        $post->slug = Str::slug($post->title,'-');
        $post->is_published = array_key_exists('is_published',$data);
        $post->save();
        return redirect()->route('admin.posts.show', $post)
       ->with('message', 'Post creato con successo')
       ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return view('admin.posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::select('id','label')->get();
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post )
    {   
        $request->validate([
            'title' => ['required','string','min:5','max:50', Rule::unique('posts')->ignore($post->id)],
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id'=> 'nullable|exists:categories,id'
        ],
        [
            'title.required'=>'il Titolo e obbligatorio',
            'content.required'=>'il contenuto e obbligatorio',
            'title.min'=>'il Titolo deve avere almeno :min caratteri',
            'title.unique'=>"Esiste già un post dal titolo $request->title",
            'image.url'=>'Url dell\'immagine non valida',
            'category_id'=>'Non esiste una categoria associabile'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['titles'],'-');

        $data['is_published'] = array_key_exists('is_published',$data);

        $post->update($data);
        $post->save();
        return redirect()->route('admin.posts.show', $post)
       ->with('message', 'Post modificato con successo')
       ->with('type', 'success');
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
       return redirect()->route('admin.posts.index')
       ->with('message', 'il post e stato eliminato con successo')
       ->with('type', 'danger');
    }

    public function toggle(Post $post)
    {
       $post->is_published= !$post->is_published;
       $post->save();

        $status = $post->is_published ? 'pubblicato' : 'rimosso';
       return redirect()->route('admin.posts.index')
       ->with('message',"Post $post->title $status con successo")
       ->with('type','success');
    }
}
