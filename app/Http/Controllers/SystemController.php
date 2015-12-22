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
     * Display user registration view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newUser()
    {
        $permissions = Permissions::all();
        $branches = Branches::all();
        return $this->view('system.users-new', ['permissions' => $permissions, 'branches' => $branches]);
    }

    /**
     * Save user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addUser(Request $request)
    {
        // Validate
        $this->validate($request, [
            'email'     =>      "required|unique:users,email",
            'password'  =>      "required|confirmed"
        ]);

        // Process Addition
        // Is there an avatar uploaded?
        $avatarChange = false;
        if (!empty($request->image)) {
            $file = ['image' => Input::file('image')];
            $this->validate($request, [
                'image'     =>      'image'
            ]);
            if (Input::file('image')->isValid()) {
                $destinationPath = 'data/avatars';
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = hash('sha256', time() . rand(111,999)) . '.' . $extension;
                Input::file('image')->move($destinationPath, $fileName);
                $avatarChange = true;
            } else {
                $request->session()->flash('error', 'Failed to upload image.');
                return redirect('/users/new');
            }
        }
        $addUser = new User;
        $addUser->email = $request->email;
        $addUser->password = bcrypt($request->password);
        $addUser->permission = $request->permission;
        $addUser->branch_specific = $request->branch_specific;
        $addUser->branch = $request->branch;
        $addUser->job = $request->job;
        $addUser->first_name = $request->first_name;
        $addUser->last_name = $request->last_name;
        $addUser->address = $request->address;
        $addUser->contact = $request->contact;
        if ($avatarChange) {
            $addUser->avatar = '/' . $destinationPath . '/' . $fileName;
        }
        $addUser->save();
        $request->session()->flash('success', 'User ' . $request->email . ' added successfully.');
        return redirect('/users');
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
