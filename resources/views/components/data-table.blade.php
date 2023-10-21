<table class="min-w-full bg-white border rounded-lg overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            @foreach($columns as $column)
                <th class="px-6 py-3 border-b font-bold text-left text-gray-600">{{ $column }}</th>
            @endforeach
            @if($actions)
                <th class="px-6 py-3 border-b font-bold text-left text-gray-600">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr class="hover:bg-gray-100">
                @foreach($columns as $column => $label)
                    <td class="px-6 py-4 border-b">{{ $row[$column] }}</td>
                @endforeach
                @if($actions)
                    <td class="px-6 py-4 border-b text-right">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mx-2">Ver</a>
                        <a href="#" class="text-green-500 hover:text-green-700 mx-2">Editar</a>
                        <a href="#" class="text-red-500 hover:text-red-700 mx-2">Eliminar</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>