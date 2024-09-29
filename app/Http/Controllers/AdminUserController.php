<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function create()
    {
        return view('admin_users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $admin_user)
    {
        if($admin_user->admin_user == 1){
            return view('admin_users.show', compact('admin_user'));
        }
        else{
            return redirect()->route('users.index')->with('error', 'You are not authorized to view this user.');
        }
    }

    public function edit(User $admin_user)
    {
        return view('admin_users.edit', compact('admin_user'));
    }

    public function update(Request $request, User $admin_user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin_user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin_user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $admin_user)
    {
        $admin_user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}