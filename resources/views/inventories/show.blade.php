<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de transferencia</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Inventario de la Sucursal</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $inventory->branch->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Producto</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $inventory->product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Stock disponible</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $inventory->stock }} 
                                {{  $inventory->product->container }} de {{  $inventory->product->weight }}{{  $inventory->product->unit_measure }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Cantidad Total (KG)</span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ $inventory->stock * $inventory->product->weight }}{{ $inventory->product->unit_measure }} 
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de creacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $inventory->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Ultima actualizacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $inventory->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
