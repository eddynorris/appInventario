<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        //
        //$branches = Branch::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        //$branches = Auth::user()->branches()
        $branches = Branch::all();
        return view('branches.index')->with('branches', $branches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branches.create');
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

        Auth::user()->branches()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('branches.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    { 
        if(!$branch->user->is(Auth::user())){
            return abort(403);
        }
        return view('branches.show')->with('branch',$branch);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        if($branch->user_id != Auth::id()){
            return abort(403);
        }
        return view('branches.edit')->with('branch',$branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        if($branch->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $branch->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('branches.show', $branch)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        if($branch->user_id != Auth::id()){
            return abort(403);
        }

        $branch->delete();

        return to_route('branches.index')->with('success','Nota al basurero');
    }
}
