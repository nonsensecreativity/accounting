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
            'name'          =>      'Default',
            'description'   =>      'The default permission set.'
        ];
        $perm = new Permissions;
        foreach ($data as $column => $value) {
            $perm->$column = $value;
        }

        $perm->view_accounts = true;
        $perm->view_cars = true;
        $perm->view_invoices = true;
        $perm->view_sales = true;
        $perm->view_vendors = true;
        $perm->view_trial = true;
        $perm->view_balance = true;
        $perm->view_profitloss = true;
        $perm->view_executivesummary = true;
        $perm->view_settings = true;
        $perm->view_users = true;
        $perm->view_perms = true;
        $perm->view_syslogs = true;

        $perm->modify_accounts = true;
        $perm->modify_cars = true;
        $perm->modify_invoices = true;
        $perm->modify_sales = true;
        $perm->modify_vendors = true;
        $perm->modify_trial = true;
        $perm->modify_balance = true;
        $perm->modify_profitloss = true;
        $perm->modify_executivesummary = true;
        $perm->modify_settings = true;
        $perm->modify_users = true;
        $perm->modify_perms = true;
        $perm->modify_syslogs = true;
        $perm->save();
    }
}
