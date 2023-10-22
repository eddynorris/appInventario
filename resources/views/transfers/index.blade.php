<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 mt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 mb-4">
                <h1 class="text-2xl font-bold">Transacciones</h1>
                <a href="{{ route('transfers.create') }}" class="btn-link btn-lg mb-2">Agregar</a>
            </div>
        </div>
        <table class="min-w-full bg-white border rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr class="text-center text-gray-600 border-b font-bold">
                    <th class="px-6 py-3 border-b">Id</th>
                    <th class="px-6 py-3 border-b">Usuario</th>
                    <th class="px-6 py-3 border-b">Tipo</th>
                    <th class="px-6 py-3 border-b">Desde</th>
                    <th class="px-6 py-3 border-b">Hacia</th>
                    <th class="px-6 py-3 border-b">Producto</th>
                    <th class="px-6 py-3 border-b">Cantidad</th>
                    <th class="px-6 py-3 border-b">Fecha</th>
                    <th class="px-6 py-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                    <tr class="hover:bg-gray-100 text-center">

                        <td class="px-6 py-4 border-b">{{ $transfer->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->transaction_type ? 'De fabrica' : 'De proveedor'}}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->fromBranch->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->branch->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->product->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->quantity }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->created_at }}</td>
                        
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="px-6 py-4 border-b text-center">
                            <a href="{{ route('transfers.show', $transfer) }}" class="text-blue-500 hover:text-blue-700 mx-2">Ver</a>
                            <a href="{{ route('transfers.edit', $transfer) }}" class="text-green-500 hover:text-green-700 mx-2">Editar</a>
                            <form method="post" action="{{ route('transfers.destroy', $transfer->id)}}">
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
