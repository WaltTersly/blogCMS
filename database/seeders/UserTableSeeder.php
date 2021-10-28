<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([

            'name' => 'Walt Tersly',
            'email' => 'walt@tersly.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);


        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatar/20201216093915_IMG_0611.jpg',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius nobis mollitia voluptates at tenetur modi perspiciatis sed, nam aliquam? Impedit sequi minima illo quos, nihil culpa nisi labore repellendus cum?',
            'facebook' => 'http://facebook.com/',
            'youtube' => 'http://youtube.com/'
        ]);
    }

}
