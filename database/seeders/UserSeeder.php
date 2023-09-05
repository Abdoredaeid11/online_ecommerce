<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       User::create([
            'fname'=>'abdulrahman',
            'lname'=>'eid',
            'email'=>'abdoredaeid905@gmail.com',
            'password'=>Hash::make('password'),
            'is_admin'=>1,





        ]);
    }
}
