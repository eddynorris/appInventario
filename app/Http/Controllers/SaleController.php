<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleController extends Controller
{

    public function index()
    {
        $sales = Sale::with('user')->get();
        $clients = Client::get();
        return view('sales.index')->with(['sales'=> $sales, 'clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $products = Product::get();
        $clients = Client::get();
        return view('sales.create', compact('users', 'products', 'clients'));
        return view('transfers.edit', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'user_id' => 'required',
            'client_id' => 'required',
            'total_amount' => 'required',
            'total_weight' => 'required',
            'duration' => 'required|integer|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.weight' => 'required|numeric|min:0'
        ]);
        DB::transaction(function () use ($request, $validated) {

            $sale = Sale::create($validated);
            $details = collect($request->input('products'))->map(function ($product) use ($sale) {
                return [
                    'sale_id' => $sale->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'subtotal' => $product['weight']
                ];
            })->toArray();

            SalesDetail::insert($details);

        }); //no esta guardando el timestamp del SalesDetails

        return to_route('sales.index')->with('success', 'Registro guardado correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    { 

        $saleDetails = $sale->salesDetails;
        return view('sales.show', compact('sale', 'saleDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $users = User::select('id', 'name')->get();
        $products = Product::get();
        $clients = Client::get();
        $saleDetails = $sale->salesDetails;
        return view('sales.edit', compact('sale', 'users', 'products', 'saleDetails','clients'));
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
        $sale->salesDetails()->delete();

        $sale->delete();

        return to_route('sales.index')->with('success','Venta eliminada');
    }
    public function dateReport()
    {
        $now = now();
        $salesThisWeek = Sale::whereRaw("DATEDIFF(?, created_at) BETWEEN duration - 7 AND duration - 1", [$now])->get();
        $salesThisMonth = Sale::whereRaw("DATEDIFF(?, created_at) BETWEEN duration - 30 AND duration - 8", [$now])->get();

        return view('sales.dateReport')->with(['salesThisWeek' => $salesThisWeek, 'salesThisMonth' => $salesThisMonth]);
    }
}
