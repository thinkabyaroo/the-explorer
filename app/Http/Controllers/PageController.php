<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;


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

    public function filter($category_id){

            $posts = Post::join('category_posts', 'posts.id', '=', 'category_posts.post_id')
                ->where('category_posts.category_id', '=',$category_id)
                ->select('posts.*')
                ->get();

//        $posts = DB::table("SELECT * FROM posts
//                                 JOIN category_posts on posts.id = category_posts.post_id
//                                 WHERE category_posts.category_id = 1");
        $categories = Category::latest("id")->get();
        return view("index",compact('posts'),["categories"=>$categories]);
    }
}
