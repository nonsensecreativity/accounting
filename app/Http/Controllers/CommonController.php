<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    /**
     * Returns a view with pre-assigned information.
     *
     * @param $view
     * @param array $opts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($view, $opts = array())
    {
        $user = User::findOrFail(Auth::user()['id']);
        if ($user->avatar == "") {
            $user->avatar = "http://gravatar.com/avatar/" . md5($user->email);
        }

        // Get unread messages
        $messages = \App\Messages::where('unread', true)->where('recipient', $user->id)->get();
        $unread = count($messages);
        $data = ['user' => $user];
        $data['unread'] = $unread;
        foreach($opts as $key => $value) {
            $data[$key] = $value;
        }
        return view($view, $data);
    }
}
