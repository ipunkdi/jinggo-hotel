<?php

namespace App\Http\Controllers;

use App\Mail\AccountVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('general_manager.users.index', ['title' => 'User management', 'users' => User::with('roles')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = array();
        $roles = Role::all();
        foreach ($roles as $role1) {
            if ($role1->name != 'general manager') {
                array_push($role,$role1);
            }
        }
        return view('general_manager.users.create', ['title' => 'Create User', 'roles' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'role_name' => 'required',
        ]);
        
        $user = User::create([
            'email' => $request->email,
            'remember_token' => Str::random(60),
        ]);

        $user->assignRole($request->role_name);

        Mail::to($user->email)->send(new AccountVerificationMail($user, $user->remember_token));
        
        return redirect('/general-manager/users')->with('success', 'New user has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($token, $email)
    {
        $user = User::where('remember_token', $token)->where('email', $email)->first();
        if(!$user){
            echo 'invalid token';
        }
        return view('auth.register', compact('token','email'));
    }

    public function updatePass(Request $request, $token, $email){
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('remember_token', $token)->first();
        if(!$user){
            return redirect()->route('login')->with('error', 'token tidak valid');
        }
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->remember_token = null;
        $user->save();

        return view('auth.login')->with('success', 'kata sandi berhasil diatur');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Ambil semua roles kecuali "general manager"
        $roles = Role::where('name', '!=', 'general manager')->get();

        return view('general_manager.users.edit', [
            'title' => 'Edit User',
            'user' => $user->load('roles'),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_name' => 'required|exists:roles,name',
        ]);
    
        // Update user data
        $user->update(['email' => $request->email]);
    
        // Sync role
        $user->syncRoles([$request->role_name]);
    
        return redirect('/general-manager/users')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself');
        }

        $user->delete();

        return redirect('/general-manager/users')->with('success', 'User has been deleted!');
    }
}
