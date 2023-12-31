<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
     /*
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index')->with('branches', $branches);
    }

     */

     public function index()
     {
         $branches = Branch::orderBy('created_at', 'desc')->get();
     
         $data = $branches->map(function ($branch) {
 
             $showUrl = route("branches.show", $branch);
             $editUrl = route("branches.edit", $branch);
             $deleteUrl = route("branches.destroy", $branch->id);
 
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
               $branch->name,
               $branch->ruc,
               $branch->country,
               $branch->department,
               $branch->province,
               $branch->district,
               $branch->address,
               $branch->type,
               '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
             ];
         });
 
         $heads = [
             'Nombre',
             'RUC',
             'Pais ',
             'Departamento',
             'Provincia',
             'Distrito',
             'Direccion',
             'Tipo',
             ['label' => 'Actions', 'no-export' => true, 'width' => 5],
         ];
         // Create the configuration array for the frontend.
         $config = [
             'data' => $data,
             'order' => [[1, 'asc']],
             'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
         ];
     
         // Send the configuration to the view.
         return view('branches.index', ['config' => $config, 'heads' => $heads]);
     }

    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name'   => 'required',
            'ruc' => '',
            'country' => 'required',
            'department' => 'required',
            'province' => 'required',
            'district' => 'required',
            'address' => 'required',
            'type' => 'required'
        ]);

        Branch::create($validated);
        return redirect()->route('branches.index')->with('success','Sucursal creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    { 

        return view('branches.show')->with('branch',$branch);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit')->with('branch', $branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {

        $branch->update([
            'name'   => $request->name,
            'ruc' => $request->ruc,
            'country' => $request->country,
            'department' => $request->department,
            'province' => $request->province,
            'district' =>$request->district,
            'address' =>$request->address,
            'type' => $request->type
        ]);
        return to_route('branches.index', $branch)->with('success','Sucursal actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return to_route('branches.index')->with('success','Sucursal eliminada');
    }
}
