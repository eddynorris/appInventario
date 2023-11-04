<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /*
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index')->with('products', $products);
    }

    /*
     * Show the form for creating a new resource.
     */

     public function index()
     {
         $products = Product::orderBy('created_at', 'desc')->get();
     
         // Map the products to the desired format.
         $data = $products->map(function ($product) {
 
             $showUrl = route("products.show", $product);
             $editUrl = route("products.edit", $product);
             $deleteUrl = route("products.destroy", $product->id);
 
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
               $product->name,
               $product->category->name,
               $product->description,
               $product->unit_measure,
               $product->container,
               $product->weight,
               'S/.'.$product->price,
               '<nobr>' . $btnDetails . $btnEdit . $btnDelete . '</nobr>',
             ];
         });
         $heads = [
             'Nombre',
             'Categoria',
             'Descripcion ',
             'Unidad de medida',
             'Contenedor ',
             'Peso',
             'Precio',
             ['label' => 'Actions', 'no-export' => true, 'width' => 5],
         ];
         // Create the configuration array for the frontend.
         $config = [
             'data' => $data,
             'order' => [[1, 'asc']],
             'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
         ];
     
         // Send the configuration to the view.
         return view('products.index', ['config' => $config, 'heads' => $heads]);
     }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('products.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'category_id'   => 'required',
            'name'   => 'required',
            'description' => 'required',
            'unit_measure'   => 'required',
            'container'   => 'required',
            'weight'   => 'required',
            'price'   => 'required'
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    { 

        return view('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('products.edit')->with(['categories' => $categories, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'unit_measure' => $request->unit_measure,
            'container' => $request->container,
            'weight' => $request->weight,
            'price' => $request->price,
        ]);
        return to_route('products.index', $product)->with('success','Producto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('success','Producto eliminado');
    }
}
