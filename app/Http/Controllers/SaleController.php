<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::with('user')->get();
        return view('sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('sales.create')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'user_id'   => 'required',
            'document'   => 'required',
            'client' => 'required',
            'address'   => 'required',
            'total_amount'   => 'required',
            'total_weight'   => 'required',
            'duration'   => 'required'
        ]);

        Sale::create($validated);
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    { 

        return view('sales.show')->with('sale',$sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $users = User::select('id', 'name')->get();
        return view('sales.edit')->with(['users' => $users, 'sale' => $sale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {

        $sale->update([
            'user_id' => $request->user_id,
            'document' => $request->document,
            'client' => $request->client,
            'address' => $request->address,
            'total_amount' => $request->total_amount,
            'total_weight' => $request->total_weight,
            'duration' => $request->duration
        ]);
        return to_route('sales.index', $sale)->with('success','Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return to_route('sales.index')->with('success','Nota al basurero');
    }
}
