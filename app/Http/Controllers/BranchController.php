<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index')->with('branches', $branches);
    }

    /**
     * Show the form for creating a new resource.
     */
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
