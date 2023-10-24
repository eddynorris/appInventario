<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Tabla de Ventas</h3>
            <div class="card-tools">
                <a  href="{{ route('transfers.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nueva transferencia
                </a>
            </div>
        </div>
        <table id="transfers" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Usuario</th>
                    <th>Tipo de transferencia</th>
                    <th>Desde </th>
                    <th>Hacia a</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha de entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->user->name }}</td>
                        <td>{{ $transfer->transaction_type ? 'De fabrica' : 'De proveedor' }}</td>
                        <td>{{ $transfer->fromBranch->name }}</td>
                        <td>{{ $transfer->branch->name }}</td>
                        <td>{{ $transfer->product->name }}</td>
                        <td>{{ $transfer->quantity }}</td>
                        <td>{{ $transfer->created_at->format('d-m-Y') }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('transfers.show', $transfer) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('transfers.edit', $transfer) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('transfers.destroy', $transfer->id)}}">
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
