<?php

use App\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'      =>      'Default',
            'accounting'=>      true,
            'reports'   =>      true,
            'system'    =>      true
        ];
        $perm = new Permissions;
        foreach ($data as $column => $value) {
            $perm->$column = $value;
        }
        $perm->save();
    }
}
