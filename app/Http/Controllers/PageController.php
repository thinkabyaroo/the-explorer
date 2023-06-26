<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest("id")->get();
        $categories = Category::latest("id")->get();
        return view("index",["posts"=>$posts,"categories"=>$categories]);
    }

    public function detail($slug){
        $post = Post::where("slug",$slug)->firstOrFail();
        return view("post.detail",compact('post'));
    }

    public function search(){
        $search_text = $_GET['search'];
        $posts = Post::where('title','LIKE','%'.$search_text.'%')->get();
        $categories = Category::latest("id")->get();
        return view("index",compact('posts'),["categories"=>$categories]);
    }
}
