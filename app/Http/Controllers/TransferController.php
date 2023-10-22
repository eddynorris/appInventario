<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function index()
    {
        //$transfers = Transfer::with(['supplier','product', 'user', 'branch'])
        //->whereHas('branch', function ($query) {
        //    $query->where('is_factory', 1);
        //})->get();
        $transfers = Transfer::orderBy('created_at', 'desc')->get();
        return view('transfers.index')->with('transfers', $transfers);
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

        $products = Product::select('id', 'name')->get();
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

        Transfer::create($validated);
        return redirect()->route('transfers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transfer $transfer)
    { 
        if(!$transfer->user->is(Auth::user())){
            return abort(403);
        }
        return view('transfers.show')->with('transfer',$transfer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transfer $transfer)
    {
        if($transfer->user_id != Auth::id()){
            return abort(403);
        }
        return view('transfers.edit')->with('transfer',$transfer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        if($transfer->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $transfer->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('transfers.show', $transfer)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        if(auth()->user()->role != 'administrador'){
            return abort(403);
        }

        $transfer->delete();

        return to_route('transfers.index')->with('success','Nota al basurero');
    }
}
