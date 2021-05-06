<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        for ($i=0; $i < 3; $i++) { 
	    	User::insert([
	            'name' => 'John Joe'.$i,
	            'email' => 'john_joe00'.$i.'@mail.com',
                'email_verified_at' => now(),
	            'password' => bcrypt('123456'),
                'remember_token' => Str::random(10),
	        ]);
    	}
    }
}
