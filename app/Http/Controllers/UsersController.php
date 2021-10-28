<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    /**
     * the admin middleware 
     */

     public function __construct()
     {
         $this->middleware('admin');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valiadte and send to database

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        try {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password')
            ]);
    
            $profile = Profile::create([
                'user_id' => $user->id,
                'avatar' => 'uploads/avatar/default-avatar.png',
            ]);

            return redirect()->back()->with('success', 'User added successfully!');
        } catch (\Throwable $th) {
            //User::destroy($user->id);
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

        try {
            $user = User::find($id);

            $user->profile->delete();
            $user->delete();
            return redirect()->back()->with('success', 'User and UserProfile successfully removed!!');
        } catch (\Throwable $th) {
            Log::error('Error! Unable to delete User and profile: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Error while deleting User!');
        }
    }

    //setting  and unsetting admin privellegges
    public function admin($id)
    {
        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        return redirect()->back()->with('success', 'User is now an admin!');

    }

    public function notAdmin($id)
    {
        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        return redirect()->back()->with('success', 'User is not an admin! Anymore');

    }
}
