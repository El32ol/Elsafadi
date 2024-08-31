<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // with count for cont the users of the relation
        $roles = Role::withCount('users')->paginate();
        $title = 'Roles Page';
        return view('roles.index' , compact('roles' , 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = new Role;
        return view('roles.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'abilities' => 'required|array',
        ]);

        $role = Role::create($request->all());

        return redirect()->route('roles.index')
                ->with('success' , __('Roles :name created successfully' , 
            [
                'name'=>$role->name,
            ]));
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
    public function edit(Role $role)
    {
        return view('roles.edit' , compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' =>'required',
            'abilities' => 'required|array',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')
                ->with('success' , __('Roles :name updated successfully' , 
            [
                'name'=>$role->name,
            ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
                ->with('success' , __('Roles :name deleted successfully' , 
            [
                'name'=>$role->name,
            ]));
    }
}
