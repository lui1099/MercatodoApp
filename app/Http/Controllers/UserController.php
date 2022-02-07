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
        $users = User::paginate(10, ['id','role', 'name', 'email']);
        return view('users.userlist', compact('users'));
    }

    public function destroy($id)
    {

            User::destroy($id);

            return redirect(route('users.index'));

    }

    public function edit(User $user): View
    {

            return view('users.useredit', ['user' => $user]);

    }


    public function update(Request $request, $id)
    {

            $user = User::findOrFail($id);


            $user->update($request->except('is_banned'));
            if ($request->has('is_banned'))
            {
                $user->update(['is_banned' => true]);
            }
            else
            {
                $user->update(['is_banned' => false]);
            }

            return redirect(route('users.index'));

    }


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

