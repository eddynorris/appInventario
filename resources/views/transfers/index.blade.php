<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Sucursales
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 mt-6">
        <h1 class="text-2xl font-bold mb-4">Branches</h1>
        <table class="min-w-full bg-white border rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Id</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Usuario</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Tipo</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Desde</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Hacia</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Producto</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Cantidad</th>
                    <th class="px-6 py-3 border-b font-bold text-center text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                    <tr class="hover:bg-gray-100">

                        <td class="px-6 py-4 border-b">{{ $transfer->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->user->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->transaction_type }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->supplier->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->branch->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->product->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $transfer->quantity }}</td>
                        
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