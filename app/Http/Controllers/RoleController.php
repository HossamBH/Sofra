<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permission_list' => 'required|array',
        ];

        $message = [
            'name.required' => 'Name is required',
            'display_name.required' => 'Displayed Name is required',
            'permission_list.required' => 'Permission List is required',
        ];
        $this->validate($request,$rules,$message);

        $role = Role::create($request->all());
        $role->permissions()->attach($request->permission_list);

        flash()->success('Success');
        return redirect(route('roles.index'));
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
        $model = Role::findOrFail($id);
        return view('roles.edit', compact('model'));
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
        $rules = [
            'name' => 'required|unique:roles,name,'.$id,
            'display_name' => 'required',
            'permission_list' => 'required|array',
        ];

        $message = [
            'name.required' => 'Name is required',
            'display_name.required' => 'Displayed Name is required',
            'permission_list.required' => 'Permission List is required',
        ];
        $this->validate($request,$rules,$message);
        
       $model = Role::findOrFail($id);
       $model->update($request->all());
       $model->permissions()->sync($request->permission_list);
       flash()->success('updated'); 
       return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        flash()->success('Deleted'); 
       return back();   
    }
}
