<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{  __('Detalle de dependencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <p class="opacity-70">
                    <strong>Creado: </strong> {{ $branch->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Actualizado: </strong> {{ $branch->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    Nombre: {{ $branch->name }}       
                </h2>
                <p class="mt-6 whitespace-pre-wrap">Ruc: {{ $branch->ruc }}</p>
                <p class="mt-6 whitespace-pre-wrap">Pais: {{ $branch->country }}</p>
                <p class="mt-6 whitespace-pre-wrap">Departamento de: {{ $branch->department }}</p>
                <p class="mt-6 whitespace-pre-wrap">Provincia de: {{ $branch->province }}</p>
                <p class="mt-6 whitespace-pre-wrap">Distrito de : {{ $branch->district }}</p>
                <p class="mt-6 whitespace-pre-wrap">Direccion {{ $branch->address }}</p>
                <p class="mt-6 whitespace-pre-wrap">Tipo: {{ $branch->type }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
