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
        <div class="card-body">
            <a  href="{{ route('sales.dateReport') }}" type="button" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ver reporte
            </a>
        </div>
        <table id="sales" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Cliente</th>
                    <th>Precio Total</th>
                    <th>Peso Total</th>
                    <th>Estado de entrega</th>
                    <th>Fecha de entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $sale->client->document }}</td>
                        <td>{{ $sale->client->name }}</td>
                        <td>S/.{{ $sale->total_amount }}</td>
                        <td>{{ $sale->total_weight }} KG</td>
                        <td class="project_progress">
                            <div class="progress progress-sm">
                                <div class="progress-bar {{ max(0, $sale->duration - now()->diffInDays($sale->created_at)) < 7 ? 'bg-danger' : 'bg-green' }} " role="progressbar" 
                                    aria-valuenow="{{ max(0, $sale->duration - now()->diffInDays($sale->created_at)) }}" 
                                    aria-valuemin="0" aria-valuemax="{{ $sale->duration }}"
                                    style="width: {{ $sale->duration == 0 ? 0 : (max(0, $sale->duration - now()->diffInDays($sale->created_at))/$sale->duration) * 100 }}%">
                                </div>
                            </div>
                            <small>
                               {{ max(0, $sale->duration - now()->diffInDays($sale->created_at)) }} Dias restantes
                            </small>
                        </td>
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
