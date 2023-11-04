<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /*
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);
    }

     */

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
    
        // Map the categories to the desired format.
        $data = $categories->map(function ($category) {

            $showUrl = route("categories.show", $category);
            $editUrl = route("categories.edit", $category);
            $deleteUrl = route("categories.destroy", $category->id);

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
              $category->name,
              $category->description,
              $category->created_at->format('d-m-Y'),
              $category->updated_at->format('d-m-Y'),
              '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
            ];
        });
        $heads = [
            'Nombre',
            'Descripcion',
            'Fecha de creacion ',
            'Fecha de actualizacion',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        // Create the configuration array for the frontend.
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
    
        // Send the configuration to the view.
        return view('categories.index', ['config' => $config, 'heads' => $heads]);
    }


    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'name'   => 'required',
            'description' => '',
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success','Categoria agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    { 

        return view('categories.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return to_route('categories.index', $category)->with('success','Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('success','Categoria eliminada');
    }
}
