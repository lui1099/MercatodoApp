<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::allows('admin_only', auth()->user())) {

            $users = User::all(['id', 'is_admin', 'name', 'email']);
            return view('userlist', compact('users'));
        }
        else {
            abort(403);
        }
    }
}
