<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Setting::create([
            'site_name' => "Tersly's Blog",
            'address' => 'Nairobi, Kenya',
            'contact_number' => '+254745637844',
            'contact_email' => 'tersly@gmail.com'
        ]);
    }
}
