<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => "Jamal Admin",
        //     'email' => "admin@admin.com",
        //     'password' => Hash::make('admin'),
        // ]);
       $user = User::create([
            'name' => "Mostofa Shahid",
            'phone' => "01728839989",
            'email' => "mostofa@admin.com",
            'password' => Hash::make('test@123'),
            'role'=>'admin'
        ]);
    }
}