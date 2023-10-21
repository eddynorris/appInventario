<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
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

        Auth::user()->categories()->create([
            'uuid' =>Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);
        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    { 
        if(!$category->user->is(Auth::user())){
            return abort(403);
        }
        return view('categories.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if($category->user_id != Auth::id()){
            return abort(403);
        }
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($category->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $category->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);

        return to_route('categories.show', $category)->with('success','Nota Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->user_id != Auth::id()){
            return abort(403);
        }

        $category->delete();

        return to_route('categories.index')->with('success','Nota al basurero');
    }
}
