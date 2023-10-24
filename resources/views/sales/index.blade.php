<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Tabla de Ventas</h3>
            <div class="card-tools">
                <a  href="{{ route('sales.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nueva venta
                </a>
            </div>
        </div>
        <table id="sales" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Precio Total</th>
                    <th>Peso Total</th>
                    <th>Duracion</th>
                    <th>Fecha de entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->document }}</td>
                        <td>{{ $sale->client }}</td>
                        <td>{{ $sale->address }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td>{{ $sale->total_weight }}</td>
                        <td>{{ $sale->duration }}</td>
                        <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('sales.show', $sale) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sales.edit', $sale) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('sales.destroy', $sale->id)}}">
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
