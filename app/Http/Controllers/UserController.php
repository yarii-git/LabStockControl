<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function index(): view
    {
        // $user = User::find($user_id);
        // return view('welcome', ['user' => $user]);

        $users = User::latest()->paginate(10);
        return view('users.index', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // Hash la contraseña antes de crear el usuario
        $userData = $request->all();
        $userData['password'] = bcrypt($request->password);

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // Hash la contraseña antes de crear el usuario
        $userData = $request->all();
        $userData['password'] = bcrypt($request->password);

        User::create($userData);
        return redirect()->route('users.index')->with('success', 'Usuari actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuari eliminat correctament!');
    }
}
