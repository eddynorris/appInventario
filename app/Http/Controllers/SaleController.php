<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::all();
        return view('sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sales.create');
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

        Auth::user()->sales()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    { 
        if(!$sale->user->is(Auth::user())){
            return abort(403);
        }
        return view('sales.show')->with('sale',$sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        if($sale->user_id != Auth::id()){
            return abort(403);
        }
        return view('sales.edit')->with('sale',$sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        if($sale->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $sale->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('sales.show', $sale)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        if($sale->user_id != Auth::id()){
            return abort(403);
        }

        $sale->delete();

        return to_route('sales.index')->with('success','Nota al basurero');
    }
}
