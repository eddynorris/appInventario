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
                            <span class="info-box-text text-center text-muted">Usuario que realizo la transferencia</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Desde </span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->fromBranch->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Hacia</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->branch->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Producto enviado</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Cantidad enviada</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->quantity }} 
                                {{  $transfer->product->container }} de {{  $transfer->product->weight }}{{  $transfer->product->unit_measure }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Carga Total</span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ $transfer->quantity * $transfer->product->weight }}{{ $transfer->product->unit_measure }} 
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha y hora de embarque</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de llegada</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $transfer->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
