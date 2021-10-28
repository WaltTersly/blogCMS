<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate before sendin to the database

        $this->validate($request, [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', ],
            'password' => ['string', 'min:8', 'confirmed'],
            'facebook' => ['required', 'url'],
            'youtube' => ['required', 'url'],
            'avatar' => 'mimes:jpg,jpeg,png',
            'about' => 'string|max:255',
        ]);

        try {
            
            //get authenticated user for the profile
            $user = Auth::user();
    
            //check if user has an existing avatar
    
            if ($request->hasFile('avatar')) {
                $avatar = $request->avatar;
    
                $avatar_new_name = time().$avatar->getClientOriginalName();
                $avatar->move('uploads/avatar', $avatar_new_name );
    
                $user->profile->avatar= 'uploads/avatar/' . $avatar_new_name;
    
                $user->profile->save();
            }
    
            //persist the rest of the data to the database
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile->facebook = $request->facebook;
            $user->profile->youtube = $request->youtube;
            $user->profile->about = $request->about;
    
            $user->save();
            $user->profile->save();
    
            //chcek for passords then save them
    
            if ($request->has('password')) {
                
                $user->password = bcrypt($request->password);
                $user->save();
            }

            return redirect()->back()->with('success', 'User profile successfully set');
        } catch (\Throwable $th) {
        
            Log::error('Error! Profile was not Set: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Profile was not set!' . $th->getMessage());
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
    }

    
}
