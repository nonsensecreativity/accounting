<?php

namespace App\Http\Controllers;

use App\User;
use App\Branches;
use App\Messages;
use App\Permissions;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SystemController extends CommonController
{
    /**
     * List users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers()
    {
        // Get a list of users
        $users = DB::table('users')
            ->join('branches', 'branches.id', '=', 'users.branch')
            ->join('permissions', 'permissions.id', '=', 'users.permission')
            ->select('users.*', 'branches.name as branch_name', 'permissions.name as permission_name')
            ->where('active', true)
            ->paginate(10);
        return $this->view('system.users', ['users' => $users]);
    }

    /**
     * List Permissions
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPerms()
    {
        $permissions = Permissions::paginate(10);
        return $this->view('system.perms', ['permissions' => $permissions]);
    }

    /**
     * Save new permission set.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPerms(Request $request)
    {
        $accounting = false;
        $reports = false;
        $system = false;
        if (!empty($request->accounting)) {
            $accounting = true;
        }
        if (!empty($request->reports)) {
            $reports = true;
        }
        if (!empty($request->system)) {
            $system = true;
        }

        $perm = new Permissions; // Yes, this is wrong in the English sense.

        $perm->name = $request->name;
        $perm->accounting = $accounting;
        $perm->reports = $reports;
        $perm->system = $system;
        $perm->save();

        $request->session()->flash('success', 'Permission set created.');
        return redirect('/perms');
    }
}
