<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{  __('Detalle de categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Creado: </strong> {{ $category->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Actualizado: </strong> {{ $category->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    Nombre: {{ $category->name }}       
                </h2>
                <p class="mt-6 whitespace-pre-wrap">Descripcion: {{ $category->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
