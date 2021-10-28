<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

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

        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        if ($categories->count() == 0 || $tags->count() == 0) {
            return redirect()->route('home')->with('info', 'create some categories and tags indorder to create posts');
        } else {
            return view('admin.posts.create',compact('categories', 'tags'));
        }
        

        
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'image'=> 'required|image|mimes:jpg,jpeg,png',
            'content' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
            'tags' => 'required'
            
        ]);
        
        

        try {
            $post = new Post;
            $image = $request->image;

            $image_new_name = time().$image->getClientOriginalName();
            $image->move('uploads/posts', $image_new_name );
            $post = Post::create([

                'title' => $request->title,
                'image'=> 'uploads/posts/' . $image_new_name,
                'content' => $request->content,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'slug' => Str::slug($request->title),
                'user_id' => Auth::id()         
             ]);
            
                //utelizing the many to many relationship using the pivot table
            $post->tags()->attach($request->tags);


            return redirect()->back()->with('success', 'Post added!');
        } catch (\Throwable $th) {
            Post::destroy($post->id);
            Log::error('Error! Post was not Created: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Post was not Created!' . $th->getMessage());
        }
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

        $tags = Tag::all();
        $post = Post::find($id);
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        //valiadate first
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required'
            
        ]);

        try {
        
            $post = Post::find($id);
    
            if ($request->hasFile('image')) {
                $image = $request->image;
    
                $image_new_name = time().$image->getClientOriginalName();
                $image->move('uploads/posts', $image_new_name );
    
                $post->image= $image_new_name;
            }
    
             
                 $post->title = $request->title;
                 $post->content = $request->content;
                 $post->description = $request->description;
                 $post->category_id = $request->category_id;
                 $post->slug = Str::slug($request->title);

                 $post->save();
                 //deletes previsos tags and reassigns them
                 $post->tags()->sync($request->tags);

                 return redirect()->route('posts')->with('success', 'post updated successfully!');
        } catch (\Throwable $th) {
            Post::destroy($post->id);
            Log::error('Error! Post was not updated: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Post was not updated!' . $th->getMessage());
        }



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

        $post = Post::find($id); 

        try {
            $post->delete();
            return redirect()->route('posts')->with('success', 'Post trashed!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to trash post: ' . $th->getMessage());
            return redirect()->route('posts')->with('error', 'Error while trashing category!' . $th->getMessage() );
        }
    }

    public function trashed()
    {
        //get only trashed posts
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed', compact('posts'));

    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first(); 

        try {
            $post->forceDelete();
            return redirect()->route('posts.trashed')->with('success', 'Post Permanently deleted!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to trash post: ' . $th->getMessage());
            return redirect()->route('posts.trashed')->with('error', 'Error while deleting post!');
        }
    }

    public function restore($id) 
    {
        //$post = Post::withTrashed()->where('id',$id)->restore();

        try {
            $post = Post::withTrashed()->where('id',$id)->restore();

            //$post->restore();
            return redirect()->route('posts')->with('success', 'Post restored!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to restore post: ' . $th->getMessage());
            return redirect()->route('posts.trashed')->with('error', 'Error while restoring post!' . $th->getMessage());
        }
    }

    // public function validateRequest(Request $request)
    // {
    //     return $request->validate([
    //         'title' => 'required|max:255',
    //         'image'=> 'required|image|mimes:jpg,jpeg,png',
    //         'content' => 'required',
    //         'description' => 'required',
    //         'category_id' => 'required'
            
    //     ]);
    // }
}
