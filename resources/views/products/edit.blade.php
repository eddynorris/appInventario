<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar producto</h3>
        </div>
            <form method="POST" action="{{ route('products.update', $product) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"  placeholder="Nombre del producto">
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('role', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}"  placeholder="Descripcion del producto">
                    </div>
                    <div class="form-group">
                        <label for="unit_measure">Unidad de medida</label>
                        <input type="text" class="form-control" id="unit_measure" name="unit_measure" value="{{ $product->unit_measure }}"  placeholder="Unidad de medida (kg, tn, etc)">
                    </div>
                    <div class="form-group">
                        <label for="container">Contenedor</label>
                        <input type="text" class="form-control" id="container" name="container" value="{{ $product->container }}"  placeholder="Contenedor del producto (bolsas, sacos, etc)">
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <input type="number" class="form-control" id="weight" name="weight" step="0.01" min="0" value="{{ $product->weight }}"  placeholder="Peso del producto" > 
                    </div>
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ $product->price }}"  placeholder="Precio" >
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Editar producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf
                    @method('patch')
                    <!-- Categoria -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Categoria')" />
                        
                        <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($categories as $product)
                                <option value="{{ $product->id }}" {{ old('role', $product->category_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    <!-- Nombre -->
                    <div  class="mt-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  :value="old('name', $product->name)" required autofocus autocomplete="Nombre" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                     <!-- Descripcion -->
                     <div  class="mt-4">
                        <x-input-label for="description" :value="__('Descripcion del producto')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('name', $product->description)" required  autocomplete="Descripcion" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>  

                    <!-- Contenedor -->
                    <div  class="mt-4">
                        <x-input-label for="container" :value="__('Aspecto')" />
                        <x-text-input id="container" class="block mt-1 w-full" type="text" name="container" :value="old('name', $product->container)" required  autocomplete="Aspecto" />
                        <x-input-error :messages="$errors->get('container')" class="mt-2" />
                    </div>

                     <!-- Unidad de medida -->
                     <div  class="mt-4">
                        <x-input-label for="unit_measure" :value="__('Unidad de medida')" />
                        <x-text-input id="unit_measure" class="block mt-1 w-full" type="text" name="unit_measure" :value="old('name', $product->unit_measure)" required  autocomplete="Unidad" />
                        <x-input-error :messages="$errors->get('unit_measure')" class="mt-2" />
                    </div> 

                    <!-- Peso -->
                    <div  class="mt-4">
                        <x-input-label for="weight" :value="__('Peso')" />
                        <x-text-input id="weight" class="block mt-1 w-full" type="text" name="weight" :value="old('name', $product->weight)" required  autocomplete="Peso" />
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </div>

                    <!-- Precio -->
                    <div  class="mt-4">
                        <x-input-label for="price" :value="__('Precio')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('name', $product->price)" required  autocomplete="Precio" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">     
                        <x-primary-button class="ml-4">
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
