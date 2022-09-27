<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->name = "jackie";
        $user->email = "jw220998@gmail.com";
        $user->password = bcrypt("password");

        $user->save();
    }
}
