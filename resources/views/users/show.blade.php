<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{  __('Detalle de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="flex">
                <p class="opacity-70">
                    <strong>Creado: </strong> {{ $user->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Actualizado: </strong> {{ $user->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    Nombre: {{ $user->name }}       
                </h2>
                <p class="mt-6 whitespace-pre-wrap">Correo: {{ $user->email }}</p>
                <p class="mt-6 whitespace-pre-wrap">Rol asignado: {{ $user->role }}</p>
                <p class="mt-6 whitespace-pre-wrap">Sucursal a la que pertenece: {{ $user->branch->name }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
