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
    /*
    public function index()
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }
        $users = User::with('branch')->get();
        $heads = ['Nombre','Correo','Rol','Sucursal','Acciones'];
        return view('users.index')->with(['heads' => $heads ,'users'=> $users]);
    }
    
     */

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
    
        // Map the users to the desired format.
        $data = $users->map(function ($user) {

            $showUrl = route("users.show", $user);
            $editUrl = route("users.edit", $user);
            $deleteUrl = route("users.destroy", $user->id);

            $btnDetails = "<a href='{$showUrl}' class='btn btn-primary btn-sm mr-1'><i class='fas fa-eye'></i></a>";
            $btnEdit = "<a href='{$editUrl}' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i></a>";
            $btnDelete = "<form method='post' action='{$deleteUrl}' style='display: inline;'>
                              " . csrf_field() . "
                              " . method_field('DELETE') . "
                              <button class='btn btn-danger btn-sm' onclick='return confirm(\"¿Está seguro?\")'>
                                  <i class='fas fa-trash'></i>
                              </button>
                          </form>";

            return [
              $user->id,
              $user->name,
              $user->email,
              $user->role,
              $user->branch->name,
              '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
            ];
        });
        $heads = [
            'ID',
            'Nombre',
            'Correo',
            'Rol',
            'Sucursal',

            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        // Create the configuration array for the frontend.
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false]],
        ];
    
        // Send the configuration to the view.
        return view('users.index', ['config' => $config, 'heads' => $heads]);
    }

     
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

        return to_route('users.index')->with('success','Usuario creado correctamente');
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
