<?php

namespace App\Http\Controllers;

use App\Models\BranchInventory;
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
    /*
    public function index()
    {
        $sales = Sale::with('user')->get();
        $clients = Client::get();
        return view('sales.index')->with(['sales'=> $sales, 'clients' => $clients]);
    }

    
     * Show the form for creating a new resource.
     */

    public function index()
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
    
        // Map the sales to the desired format.
        $data = $sales->map(function ($sale) {

            $showUrl = route("sales.show", $sale);
            $editUrl = route("sales.edit", $sale);
            $deleteUrl = route("sales.destroy", $sale->id);

            $btnDetails = "<a href='{$showUrl}' class='btn btn-primary btn-sm mr-1'><i class='fas fa-eye'></i></a>";
            $btnEdit = "<a href='{$editUrl}' class='btn btn-info btn-sm mr-1'><i class='fas fa-pencil-alt'></i></a>";
            $btnDelete = "<form method='post' action='{$deleteUrl}' style='display: inline;'>
                              " . csrf_field() . "
                              " . method_field('DELETE') . "
                              <button class='btn btn-danger btn-sm' onclick='return confirm(\"¿Está seguro?\")'>
                                  <i class='fas fa-trash'></i>
                              </button>
                          </form>";
            $daysRemaining = max(0, $sale->duration - now()->diffInDays($sale->created_at));
            $progressBarClass = $daysRemaining < 7 ? 'bg-danger' : 'bg-green';
            $progressWidth = $sale->duration == 0 ? 0 : ($daysRemaining / $sale->duration) * 100;

            // Crear la barra de progreso como una cadena HTML
            $progressBarHtml = "<div class='progress progress-sm'>" .
                       "<div class='progress-bar {$progressBarClass}' role='progressbar' " .
                       "aria-valuenow='{$daysRemaining}' aria-valuemin='0' " .
                       "aria-valuemax='{$sale->duration}' style='width: {$progressWidth}%'>" .
                       "</div></div><small>{$daysRemaining} Días restantes</small>";
                       
            return [
              $sale->user->name,
              $sale->client->document ? 'De fábrica' : 'De proveedor',
              $sale->client->name,
              'S/.'.$sale->total_amount,
              $sale->total_weight. ' KG',
              $progressBarHtml,
              $sale->created_at->format('d-m-Y'),
              '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
            ];
        });

        $heads = [
            'Usuario',
            'DNI',
            'Cliente ',
            'Precio Total',
            'Peso Total ',
            'Estado de la entrega',
            'Fecha de entrega',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        // Create the configuration array for the frontend.
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
        ];
    
        // Send the configuration to the view.
        return view('sales.index', ['config' => $config, 'heads' => $heads]);
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        $products = Product::get();
        $clients = Client::get();
        return view('sales.create', compact('users', 'products', 'clients'));
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
        $LowStock = false;
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
            // Revisar si es necesario actualizar el stock 
            foreach ($details as $soldProduct) {
                $branchInventory = BranchInventory::where('product_id', $soldProduct['product_id'])
                                  ->where('branch_id', auth()->user()->branch_id)
                                  ->first();
                
                $branchInventory->decrement('stock', $soldProduct['quantity']);
            }
        }); 
        return to_route('sales.index')->with('success', 'Registro guardado correctamente');
        
    }

    /* Guardar con validaciones
    public function store(Request $request)
    {
        $validated = $request->validate([
            // ... tus reglas de validación ...
        ]);

        $outOfStockProducts = [];

        DB::beginTransaction();
        try {
            $sale = Sale::create($validated);
            $detailsData = collect($request->input('products'))->map(function ($product) use ($sale) {
                return [
                    'sale_id' => $sale->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'subtotal' => $product['quantity'] * $product['price'] // Asumiendo que el subtotal es cantidad * precio
                ];
            });

            SalesDetail::insert($detailsData->toArray());

            foreach ($detailsData as $soldProduct) {
                $branchInventory = BranchInventory::where('product_id', $soldProduct['product_id'])
                                                  ->where('branch_id', auth()->user()->branch_id)
                                                  ->lockForUpdate() // Bloquea el registro para operaciones concurrentes
                                                  ->first();

                if ($branchInventory && $branchInventory->stock >= $soldProduct['quantity']) {
                    $branchInventory->decrement('stock', $soldProduct['quantity']);
                } else {
                    // Guarda el producto con stock insuficiente
                    $outOfStockProducts[] = $soldProduct['product_id'];
                }
            }

            if (!empty($outOfStockProducts)) {
                // Si hay productos sin stock, cancela la transacción
                DB::rollBack();
                $productNames = Product::whereIn('id', $outOfStockProducts)->get()->pluck('name');
                $productNamesString = implode(', ', $productNames->toArray());
                return redirect()->route('sales.index')
                                 ->with('alert', "Stock insuficiente para los productos: {$productNamesString}.");
            }

            // Confirma la transacción
            DB::commit();
            return redirect()->route('sales.index')
                             ->with('success', 'Venta registrada correctamente y stock actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sales.index')
                             ->with('error', "Error al procesar la venta: {$e->getMessage()}");
        }
    }
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

        
        DB::transaction(function () use ($request, $validated, $sale) {

            // Actualiza la venta
            $sale->update($validated);
    
            // Elimina los detalles de venta antiguos
            $sale->salesDetails()->delete();
    
            // Crea nuevos detalles de venta
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
        });

        return to_route('sales.index', $sale)->with('success','Venta Actualizada');
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
