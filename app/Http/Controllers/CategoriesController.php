<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
        $validatedata = $this->validateRequest($request);

        try {
            $category = new Category();
            $category = Category::create($validatedata);
            



            return redirect()->route('categories')->with('success', 'Category added!');
        } catch (\Throwable $th) {
            Category::destroy($category->id);
            Log::error('Error! Category was not Created: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Category was not Created!');
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

        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));


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

        $validatedata = $this->validateRequest($request);
        $category = Category::find($id);

        try {
           $category->update($validatedata);

            return redirect()->route('categories')->with('success', 'Category updated!');
        } catch (\Throwable $th) {
            Log::error('Error! Category was not updated: ' . $th->getMessage());
            return redirect()-route('categories')->with('error', 'Category was not updated!');
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
        $category = Category::find($id); 

        try {
            foreach ($category->posts as $post) {
                $post->forceDelete();
            }
            
            $category->delete();
            return redirect()->route('categories')->with('success', 'Category deleted!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to delete category: ' . $th->getMessage());
            return redirect()->route('categories')->with('error', 'Error while deleting category!');
        }
    }

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            
        ]);
    }
}
