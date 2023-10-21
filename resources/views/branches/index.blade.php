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
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Nombre</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Pais</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Departamento</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Provincia</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Distrito</th>
                    <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Direccion</th>
                    <th class="px-6 py-3 border-b font-bold text-center text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branch)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b">{{ $branch->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->country }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->department }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->province }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->city }}</td>
                        <td class="px-6 py-4 border-b">{{ $branch->address }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="px-6 py-4 border-b text-center">
                            <a href="{{ route('branches.show', $branch) }}" class="text-blue-500 hover:text-blue-700 mx-2">Ver</a>
                            <a href="{{ route('branches.edit', $branch) }}" class="text-green-500 hover:text-green-700 mx-2">Editar</a>
                            <form method="post" action="{{ route('branches.destroy', $branch->id)}}">
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
