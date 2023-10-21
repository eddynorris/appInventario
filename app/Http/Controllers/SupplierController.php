<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Auth::user()->suppliers()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    { 
        if(!$supplier->user->is(Auth::user())){
            return abort(403);
        }
        return view('suppliers.show')->with('supplier',$supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        if($supplier->user_id != Auth::id()){
            return abort(403);
        }
        return view('suppliers.edit')->with('supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        if($supplier->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $supplier->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('suppliers.show', $supplier)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if($supplier->user_id != Auth::id()){
            return abort(403);
        }

        $supplier->delete();

        return to_route('suppliers.index')->with('success','Nota al basurero');
    }
}
