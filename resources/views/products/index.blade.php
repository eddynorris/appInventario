<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <!--header -->
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 mt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 mb-4">
                <h1 class="text-2xl font-bold">Productos</h1>
                <a href="{{ route('products.create') }}" class="btn-link btn-lg mb-2">Agregar</a>
            </div>
        </div>
        <table class="min-w-full bg-white border rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr class="text-center text-gray-600 border-b font-bold">
                    <th class="px-6 py-3">Id</th>
                    <th class="px-6 py-3">Categoria</th>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Descripcion</th>
                    <th class="px-6 py-3">Unidad de medida</th>
                    <th class="px-6 py-3">Aspecto</th>
                    <th class="px-6 py-3">Peso</th>
                    <th class="px-6 py-3">Precio</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="px-6 py-4 border-b">{{ $product->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->description }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->unit_measure }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->container }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->weight }}</td>
                        <td class="px-6 py-4 border-b">{{ $product->price }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="px-6 py-4 border-b text-center">
                            <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:text-blue-700 mx-2">Ver</a>
                            <a href="{{ route('products.edit', $product) }}" class="text-green-500 hover:text-green-700 mx-2">Editar</a>
                            <form method="post" action="{{ route('products.destroy', $product->id)}}">
                                @csrf
                                @method('delete')
                                <x-danger-button class="" onclick="return confirm('Esta seguro?')">Eliminar</x-danger-button>
                             </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
</x-app-layout>
