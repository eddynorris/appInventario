<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchInventory;
use App\Models\Product;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    /*
    public function index()
    {
        $transfers = Transfer::latest('created_at')->paginate(5);

        return view('transfers.index')->with('transfers', $transfers);
    }
    
     USANDO DATATABLES PLUGIN */
    public function index()
    {
        $transfers = Transfer::orderBy('created_at', 'desc')->get();
    
        // Map the transfers to the desired format.
        $data = $transfers->map(function ($transfer) {

            $showUrl = route("transfers.show", $transfer);
            $editUrl = route("transfers.edit", $transfer);
            $deleteUrl = route("transfers.destroy", $transfer->id);

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
              $transfer->user->name,
              $transfer->transaction_type ? 'De fábrica' : 'De proveedor',
              $transfer->fromBranch->name,
              $transfer->branch->name,
              $transfer->product->name,
              $transfer->quantity,
              $transfer->created_at->format('d-m-Y'),
              '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
            ];
        });
        $heads = [
            'Usuario',
            'Tipo de transferencia',
            'Desde ',
            'Hacia a',
            'Producto ',
            'Cantidad',
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
        return view('transfers.index', ['config' => $config, 'heads' => $heads]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $branches = Branch::select('id','name','type')->get();

        $branchesFactory = $branches->where('type', 'factory');
        $branchesOffice = $branches->where('type', 'office');
        $branchesSupplier = $branches->where('type', 'supplier');

        $products = Product::get();
        $users = User::select('id', 'name')->get();

        return view('transfers.create',['branchesOffice' => $branchesOffice ,'branchesSupplier' => $branchesSupplier ,'branchesFactory' => $branchesFactory ,'products' => $products,'users' => $users]);
  
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'transaction_type'   => 'required',
            'from_id'   => 'required',
            'branch_id' => 'required',
            'product_id'   => 'required',
            'quantity'   => 'required',
            'user_id'   => 'required'
        ]);
        //Se aumenta stock en sucursal y se quita en fabrica
        if ($request->transaction_type) {
            $branchInventoryOffice = BranchInventory::where('product_id', $validated['product_id'])                 
            ->where('branch_id', $validated['branch_id'])                                    
            ->first();   
    
            $branchInventoryFactory = BranchInventory::where('product_id', $validated['product_id'])                 
            ->where('branch_id', $validated['from_id'])                                    
            ->first();

            $branchInventoryOffice->increment('stock', $validated['quantity']);       
            $branchInventoryFactory->decrement('stock', $validated['quantity']);
        }
        //Se aumenta stock en fabrica
        else{
            $branchInventory = BranchInventory::where('product_id', $validated['product_id'])
                                                ->where('branch_id', $validated['branch_id'])        
                                                ->first();               
            $branchInventory->increment('stock', $validated['quantity']);
        }
        Transfer::create($validated);




        return redirect()->route('transfers.index')->with('success','Transferencia guardada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transfer $transfer)
    { 

        return view('transfers.show')->with('transfer',$transfer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transfer $transfer)
    {

        $branches = Branch::select('id','name','type')->get();

        $branchesFactory = $branches->where('type', 'factory');
        $branchesOffice = $branches->where('type', 'office');
        $branchesSupplier = $branches->where('type', 'supplier');

        $products = Product::get();
        $users = User::select('id', 'name')->get();

        return view('transfers.edit',  compact('branches', 'branchesFactory', 'branchesOffice', 'branchesSupplier','products','users','transfer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        $transfer->update([
            'transaction_type' => $request->transaction_type,
            'from_id' => $request->from_id,
            'branch_id' => $request->branch_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => $request->user_id,
        ]);
        return to_route('transfers.index', $transfer)->with('success','Transferencia Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        if(auth()->user()->role != 'admin'){
            return abort(403);
        }

        $transfer->delete();

        return to_route('transfers.index')->with('success','Registro de transferencia eliminada');
    }
}
