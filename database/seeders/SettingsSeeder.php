<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'email' => 'megalimedinfo@gmail.com',
            'address' => 'Plovdiv, Bulgaria, Carevets 2',
            'phone' => '089 988 9486',
            'facebook' => 'https://www.facebook.com/MegaliMed',
            'instagram' => 'https://www.instagram.com/megalimed',
        ]);
    }
}
