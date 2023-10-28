<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        $users = User::with('branch')->get();
        $heads = ['Nombre','Correo','Rol','Sucursal','Acciones'];
        return view('users.index')->with(['heads' => $heads ,'users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        $branches = Branch::select('id', 'name')->get();
        return view('users.create',['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'branch_id' => $request->branch_id,
        ]);

        event(new Registered($user));

        return to_route('users.index');
    }

    public function show(User $user)
    { 
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        
        return view('users.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        $roles = ['repartidor', 'empleado', 'admin'];
        $branches = Branch::select('id', 'name')->get();
        return view('users.edit')->with(['roles' => $roles , 'branches' => $branches, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'branch_id' => $request->branch_id,
        ]);

        return to_route('users.index', $user)->with('success','Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        // Actualiza las relaciones
        $user->sales()->update(['user_id' => 1]);
        $user->transfers()->update(['user_id' => 1]);
        $user->delete();

        return to_route('users.index')->with('success','Usuario Eliminado');
    }
}
