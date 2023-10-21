<?php

namespace App\Http\Controllers;

use App\Models\BranchInventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchInventoryController extends Controller
{
    public function index()
    {

        $branchInventory = BranchInventory::all();
        return view('branchInventory.index')->with('branchInventory', $branchInventory);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branchInventory.create');
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

        Auth::user()->branchInventory()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('branchInventory.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BranchInventory $branchInventory)
    { 
        if(!$branchInventory->user->is(Auth::user())){
            return abort(403);
        }
        return view('branchInventory.show')->with('Branch',$branchInventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BranchInventory $branchInventory)
    {
        if($branchInventory->user_id != Auth::id()){
            return abort(403);
        }
        return view('branchInventory.edit')->with('Branch',$branchInventory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BranchInventory $branchInventory)
    {
        if($branchInventory->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $branchInventory->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('branchInventory.show', $branchInventory)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchInventory $branchInventory)
    {
        if($branchInventory->user_id != Auth::id()){
            return abort(403);
        }

        $branchInventory->delete();

        return to_route('branchInventory.index')->with('success','Nota al basurero');
    }
}
