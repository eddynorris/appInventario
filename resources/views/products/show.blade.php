<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{  __('Detalle de producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex">
                <p class="opacity-70">
                    <strong>Creado: </strong> {{ $product->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Actualizado: </strong> {{ $product->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    Nombre: {{ $product->name }}       
                </h2>
                <p class="mt-6 whitespace-pre-wrap">Categoria: {{ $product->category->name }}</p>
                <p class="mt-6 whitespace-pre-wrap">Descripcion: {{ $product->description }}</p>
                <p class="mt-6 whitespace-pre-wrap">Unidad de medida{{ $product->unit_measure }}</p>
                <p class="mt-6 whitespace-pre-wrap">Presentacion: {{ $product->container }}</p>
                <p class="mt-6 whitespace-pre-wrap">Peso {{ $product->weight }}</p>
                <p class="mt-6 whitespace-pre-wrap">Precio: {{ $product->price }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
