<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Comment;
use App\Models\Categories;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // return Post::orderBy('updated_at','DESC')->get();
        return view('blog.index')
        ->with('posts',Post::orderBy('updated_at','DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.create')
        ->with('categorylist',Categories::Where('user_id',auth()->user()->id)->get('cat_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cat_name' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'

        ]);

        $img = uniqid().'-'.$request->title.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$img);
       Post::create([
        'title' => $request->input('title'),
        'cat_name' => $request->input('cat_name'),
        'description' => $request->input('description'),
        'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
        'image_path' => $img,
        'user_id' => auth()->user()->id
    ]);

    return redirect('/blog')
        ->with('message', 'Your post has been added!');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('blog.show')
        ->with('post', Post::where('slug', $id)->first())
        ->with('comments', Comment::where('post_id', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        return view('blog.edit')
        ->with('post',Post::where('slug',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
  
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::where('slug', $id)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'user_id' => auth()->user()->id
            ]);

        return redirect('/blog')
            ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::where('slug', $id);
        $post->delete();

        return redirect('/blog')
            ->with('message', 'Your post has been deleted!');
    }

    public function add_comment(Request $request, $slug)
    {
        //

        
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'comment' => 'required'
        ]);

    

        Comment::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'comment' => $request->input('comment'),
            'post_id' => $slug,
            'users_id' => 0,
            'status' => '0'
        ]);

        return redirect('/blog/'.$slug)
            ->with('message', 'Your comment has been added!');
    }
}
