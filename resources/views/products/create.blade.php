<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nuevo producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <!-- Categoria -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Categoria')" />
                        
                        <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    <!-- Nombre -->
                    <div  class="mt-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="Nombre" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                     <!-- Descripcion -->
                     <div  class="mt-4">
                        <x-input-label for="description" :value="__('Descripcion del producto')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"  required  autocomplete="Descripcion" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>  

                    <!-- Contenedor -->
                    <div  class="mt-4">
                        <x-input-label for="container" :value="__('Aspecto')" />
                        <x-text-input id="container" class="block mt-1 w-full" type="text" name="container"  required  autocomplete="Aspecto" />
                        <x-input-error :messages="$errors->get('container')" class="mt-2" />
                    </div>

                     <!-- Unidad de medida -->
                     <div  class="mt-4">
                        <x-input-label for="unit_measure" :value="__('Unidad de medida')" />
                        <x-text-input id="unit_measure" class="block mt-1 w-full" type="text" name="unit_measure"  required  autocomplete="Unidad" />
                        <x-input-error :messages="$errors->get('unit_measure')" class="mt-2" />
                    </div> 

                    <!-- Peso -->
                    <div  class="mt-4">
                        <x-input-label for="weight" :value="__('Peso')" />
                        <x-text-input id="weight" class="block mt-1 w-full" type="text" name="weight"  required  autocomplete="Peso" />
                        <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                    </div>

                    <!-- Precio -->
                    <div  class="mt-4">
                        <x-input-label for="price" :value="__('Precio')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"  required  autocomplete="Precio" />
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
