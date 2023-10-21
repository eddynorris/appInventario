<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::with(['supplier','product', 'user', 'branch'])->get();
        return view('transfers.index')->with('transfers', $transfers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transfers.create');
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

        Auth::user()->transfers()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('transfers.index');
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
        if($transfer->user_id != Auth::id()){
            return abort(403);
        }

        $transfer->delete();

        return to_route('transfers.index')->with('success','Nota al basurero');
    }
}
