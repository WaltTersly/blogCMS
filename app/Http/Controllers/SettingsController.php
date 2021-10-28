<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    //

     /**
     * the admin middleware 
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){

        $setting = Setting::first();

        return view('admin.settings.settings', compact('setting'));
    }


    public function update(){

        $this->validate(request(),[
            'site_name' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
            'address' => 'required'
        ]);

        $setting = Setting::first();

        $setting->site_name = request()->site_name;
        $setting->address = request()->address;
        $setting->contact_email = request()->contact_email;
        $setting->contact_number = request()->contact_number;

        $setting->save();

        return redirect()->back()->with('success', 'The Blog settings have been set');


    }
}
