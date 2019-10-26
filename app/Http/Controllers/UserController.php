<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function changePassword()
    {
        return view('userPassword/change-password', compact('model'));
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'old-password' => 'required',
            'password' => 'required|confirmed',
        ]);

       $user = Auth::user();

       if (Hash::check($request->input('old-password'), $user->password))
       {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            flash()->success('Password Updated');
            return back();
       }
       else
       {
            flash()->success('Password Wrong');
            return back();
       }
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|confirmed',
            'email' => 'email',
            'roles_list' => 'required',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except('roles_list'));
        $user->roles()->attach($request->input('roles_list'));

        flash()->success('Created');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        return view('users/edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|confirmed',
            'email' => 'email',
            'roles_list' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->roles()->sync($request->input('roles_list'));
        $request->merge(['password' => bcrypt($request->password)]);
        $update = $user->update($request->all());

        flash()->success('Updated');
        return redirect(route('users.edit',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        flash()->success('Deleted'); 
       return back();
    }
}