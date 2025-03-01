<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create-user')->only(['create', 'store']);
        $this->middleware('check.permission:view-user')->only('index');
        $this->middleware('check.permission:edit-user')->only(['edit', 'update']);
        $this->middleware('check.permission:delete-user')->only(['destroy']);
    }

    public function index()
    {
        $users = User::all();
        // $users = User::with('roles')->get();

        return view('admins.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admins.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array', // Ensure roles is an array
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.create')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
        ]);

        $user->roles()->detach();
        // Attach roles baru
        $user->roles()->attach($request->roles);
        // $user->syncRoles($request->roles);

        // Session::flash('success', 'User created successfully.');
        Alert::success('Success', 'User created successfully.');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id')->all();

        $userRoles = $user->roles()->pluck('id')->toArray();

        return view('admins.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array', // Roles can be updated optionally
            'roles.*' => 'exists:roles,id',
        ]);


        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->roles()->detach();
        // Attach roles baru
        $user->roles()->attach($request->roles);



        // Session::flash('success', 'User updated successfully.');
        Alert::success('Success', 'User updated successfully.');

        // return redirect()->route('user.index');

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('user.index');
    }
}
