<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            /**
            $table->string('name')->unique();
            $table->boolean('accounting')->default(true);
            $table->boolean('reports')->default(true);
            $table->boolean('system')->default(true);
             */
            // Fields
            $fields = ['accounts', 'cars', 'invoices', 'sales', 'vendors', 'trial', 'balance', 'profitloss', 'executivesummary', 'settings', 'users', 'perms', 'syslogs'];
            $table->string('name')->unique();
            $table->string('description');
            foreach ($fields as $col) {
                $table->boolean('view_' . $col)->default(true);
                $table->boolean('modify_' . $col)->default(false);
            }
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
        Schema::drop('permissions');
    }
}
