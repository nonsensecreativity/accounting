<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->text('avatar')->nullable();
            $table->boolean('active')->default(true);
            $table->text('contact');
            $table->text('notes')->nullable();
            $table->integer('branch');
            $table->boolean('branch_specific')->default(true);
            $table->integer('permission');
            $table->string('job');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
