<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        if(Gate::allows('admin_only', auth()->user())) {

            $users = User::all(['id', 'is_admin', 'name', 'email']);
            return view('users.userlist', compact('users'));
        }
        else {
            abort(403);
        }
    }

    public function destroy($id): Redirector
    {

        if(Gate::allows('admin_only', auth()->user())) {


            User::destroy($id);

            return redirect(route('users.index'));
        }
        else {
            abort(403);

        }


    }

    public function edit(User $user): View
    {

        if (Gate::allows('admin_only', auth()->user())) {

            return view('users.useredit', ['user' => $user]);

        } else {
            abort(403);
        }
    }


    public function update(Request $request, $id): Redirector
    {

        if (Gate::allows('admin_only', auth()->user())) {

            $user = User::findOrFail($id);

            $user->update($request->except('is_banned'));
            if ($request->has('is_banned'))
            {
                $user->update(['is_banned' => true]);
            }

            return redirect(route('users.index'));

        } else {
            abort(403);
        }
    }

//    public function ban(Request $request, $id)
//    {
//
//        if (Gate::allows('admin_only', auth()->user())) {
//
//
//
//            $user = User::findOrFail($id);
//            $user->is_banned = 1;
//
//            $user->update($request->all());
//
//            return redirect(route('users.index'));
//
//
//
//        } else {
//            abort(403);
//        }
//    }
//
//
//    public function unban(Request $request, $id)
//    {
//
//        if (Gate::allows('admin_only', auth()->user())) {
//
//
//
//            $user = User::findOrFail($id);
//            $user->is_banned = 0;
//
//            $user->update($request->all());
//
//            return redirect(route('users.index'));
//
//
//
//        } else {
//            abort(403);
//        }
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }




}

