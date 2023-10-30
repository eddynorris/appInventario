<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchInventory;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class BranchInventoryController extends Controller
{
    public function index()
    {

        $inventories = BranchInventory::all();
        return view('inventories.index')->with('inventories', $inventories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::get();
        $branches = Branch::select('id', 'name')->get();

        return view('inventories.create', compact('products', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated= $request->validate([
                'branch_id' => 'required',
                'product_id'   => 'required',
                'stock'   => 'required',
            ]);
    
            BranchInventory::create($validated);
            return redirect()->route('inventories.index')->with('success','Inventario creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',  $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(BranchInventory $inventory)
    { 
        return view('inventories.show')->with('inventory',$inventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BranchInventory $inventory)
    {
        $products = Product::get();
        $branches = Branch::select('id', 'name')->get();

        return view('inventories.edit', compact('products','branches','inventory'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BranchInventory $inventory)
    {
        $inventory->update([
            'branch_id' => $request->branch_id,
            'product_id' => $request->product_id,
            'stock' => $request->stock,
        ]);
        return to_route('inventories.index', $inventory)->with('success','Inventario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchInventory $inventory)
    {

        $inventory->delete();

        return to_route('inventories.index')->with('success','Registro de inventario eliminado');
    }
}
