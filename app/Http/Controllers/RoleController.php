<?php

namespace Plans\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        return view('roles.index')
            ->withData(Role::all());

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create($request->all());

        return redirect('roles');
    }



    public function edit($id)
    {

        $role = Role::find($id);
        $user = User::all();

        return view('roles.edit')
            ->withRole($role)
            ->withUsers($user);

    }

    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);

        $role->users()->sync($request->get("user_id", []));

        return redirect('roles');

    }
}
