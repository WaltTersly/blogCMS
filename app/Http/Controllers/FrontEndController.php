<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;



class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $title = Setting::first()->site_name;
        $categories  = Category::all()->take(5);
        $first_post = Post::orderBy('created_at', 'desc')->first();
        $second_post = Post::orderBy('created_at', 'desc')->get()->skip(1)->take(1)->first();
        $third_post = Post::orderBy('created_at', 'desc')->get()->skip(2)->take(1)->first();
        $setting = Setting::first();

        return view ('welcome', compact('title', 'categories', 'first_post', 'second_post', 'third_post', 'setting','posts'));
    }

   

    
    public function searchForm()
    {
        //
        
        $posts = Post::where('title', 'LIKE', '%' . request('tafuta') . '%')->get();
        $title = 'Search results:' . request('tafuta') ;
        $categories = Category::all()->take(5);
        $setting = Setting::first();
        $tafuta = request('tafuta');
       
        return view('results', compact('posts', 'title', 'categories', 'setting', 'tafuta'));
    }
   
    public function singlePost($slug)
    {

        $post = Post::where('slug', $slug)->first();
        $title = $post->title;
        $categories = Category::all()->take(5);
        $setting = Setting::first();

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');

        $nexxt = Post::find($next_id);
        $prev = Post::find($prev_id);
        $tags = Tag::all();

        return view('singlepost', compact('post','title', 'categories', 'setting', 'nexxt', 'prev', 'tags'));
    }

    public function category($id)
    {
        
        $category = Category::find($id);
        $title = $category->name;
        $categories = Category::all()->take(5);
        $setting = Setting::first();
        $tags = Tag::all();

        return view('category', compact('category','title', 'categories', 'setting','tags'));
    }

    public function tag($id)
    {
        
        $tag = Tag::find($id);
        $title = $tag->tag;
        $categories = Category::all()->take(5);
        $setting = Setting::first();
        $tags = Tag::all();

        return view('tag', compact('tag','title', 'categories', 'setting','tags'));
    }

}
