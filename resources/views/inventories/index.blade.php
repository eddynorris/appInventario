<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Tabla Inventario</h3>
            <div class="card-tools">
                <a  href="{{ route('inventories.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Agregar stock
                </a>
            </div>
        </div>
        <table id="inventories" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Sucursal</th>
                    <th>Producto</th>
                    <th>Stock </th>
                    <th>Cantidad (KG) </th>
                    <th>Ultima actualizacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->branch->name }}</td>
                        <td>{{ $inventory->product->name }}</td>
                        <td>{{ $inventory->stock }}</td>
                        <td>{{ $inventory->product->weight * $inventory->stock}}</td>
                        <td>{{ $inventory->updated_at->format('d-m-Y') }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('inventories.destroy', $inventory->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Esta seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                             </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
</x-app-layout>
