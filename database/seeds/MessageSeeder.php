<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')
            ->insert([
                'sender'        =>      1,
                'recipient'     =>      1,
                'subject'       =>      'Welcome to the Accounting System!',
                'message'       =>      'Welcome to the Accounting System for A-1 Driving School.

This system is part of the requirements for completing a Bachelor\'s Degree in Information Technology at the University of the East, College of Computer Studies and Systems.'
            ]);
    }
}
