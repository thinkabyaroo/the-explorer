<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Mail\PostMail;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except(["index","show"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest("id")->get();
        return view('post.create',["categories"=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([
            "title"=> "required|min:3|max:100",
            "description" => "required",
            "category" => "required",
            "category.*" => "exists:categories,id",
        ]);
        $newName = "cover_".uniqid()."_".$request->file('cover')->extension();
        $request->file('cover')->storeAs("public/cover",$newName);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50);
        $post->cover = $newName;
        $post->user_id = Auth::id();
        $post->save();

//        $post->categories()->attach($request->categories);

        foreach ($request->category as $category){
            $cp = new CategoryPost();
            $cp->category_id = $category;
            $cp->post_id = $post->id;
            $cp->save();
        }
        return redirect()->route("index");
//        $postMail=new PostMail($request->title,$request->description);
//        $postMail ->from('tko@mms-student.online',"Example Department");

        $mailArr=['thinkabyaroo2911@gmail.com','thinkabyaroo29@gmail.com'];
        foreach ($mailArr as $mail){
            Mail::to($mail)->send(new PostMail($post->title,$post->description));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect()->route('post.detail',$post->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        $categories = Category::latest("id")->get();
        return view('post.edit',compact('post'),["categories"=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([
            "title"=> "required|min:3|max:100",
            "description" => "required",
            "category" => "required",
            "category.*" => "exists:categories,id",
        ]);
        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,50);

        if($request->hasFile('cover')){
            //delete old cover
            Storage::delete("public/cover/".$post->cover);
            //upload new cover
            $newName = "cover_".uniqid()."_".$request->file('cover')->extension();
            $request->file('cover')->storeAs("public/cover",$newName);
            // save to table
            $post->cover = $newName;
        }
        $post->update();
        $post->categories()->detach();
        foreach ($request->category as $category){
            $cp = new CategoryPost();
            $cp->category_id = $category;
            $cp->post_id = $post->id;
            $cp->save();
        }
        return redirect()->route("post.detail",$post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);

        //delete pivot records
        $post->categories()->detach();

        Storage::delete("public/cover/".$post->cover);
        $post->delete();

        return redirect()->route('index');
    }
}
