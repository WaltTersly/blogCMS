<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating data

        $validatedata = $this->validateRequest($request);

        try {
            $tag = new Tag();
            $tag = Tag::create($validatedata);
            



            return redirect()->route('tags')->with('success', 'Tag created!');
        } catch (\Throwable $th) {
            Tag::destroy($tag->id);
            Log::error('Error! Tag was not Created: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Tag was not Created!');
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
        //finding tah by id then display it

        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));

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
        //perform validation then save the edited tag with the corresponding id

        $validatedata = $this->validateRequest($request);
        $tag = Tag::find($id);

        try {
           $tag->update($validatedata);

            return redirect()->route('tags')->with('success', 'Tag updated!');
        } catch (\Throwable $th) {
            Log::error('Error! Tag was not updated: ' . $th->getMessage());
            return redirect()-route('tags')->with('error', 'Tag was not updated!');
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
        //find the selected tag by id then delete it completely

        $tag = Tag::find($id); 

        try {
            Tag::destroy($id);
            return redirect()->route('tags')->with('success', 'Tag deleted!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to delete tag$tag: ' . $th->getMessage());
            return redirect()->route('tags')->with('error', 'Error while deleting Tag!');
        }

    }

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'tag' => 'required',
            
        ]);
    }
}
