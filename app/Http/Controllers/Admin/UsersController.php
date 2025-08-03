<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminsDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //index datatable

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.users.index');
    }
    //create
    public function create()
    {
        return view('dashboard.admin.users.create');
    }
    //store
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Patient added successfully.');
    }

    //edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.edit', compact('user'));
    }
    //update
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Patient added successfully.');

    }
    //destroy
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('success');

    }

}
