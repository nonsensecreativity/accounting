<?php

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
        DB::table('users')->insert([
            'email'     =>      'liamdemafelix.n@gmail.com',
            'password'  =>      bcrypt('admin'),
            'first_name'=>      'Liam',
            'last_name' =>      'Demafelix',
            'address'   =>      '25-I Callejon Rosas Street, Kapasigan, Pasig City',
            'contact'   =>      '09773257613',
            'branch'    =>      1,
            'permission'=>      1,
            'job'       =>      'Developer'
        ]);
    }
}
