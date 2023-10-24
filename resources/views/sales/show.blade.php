<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Usuario</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">DNI</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->document }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Cliente</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->client }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Direccion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->address }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Precio total</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->total_amount }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Peso total</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->total_weight }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Duracion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->duration }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha </span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $sale->created_at }}</span>
                        </div>
                    </div>
                </div>
                @foreach($saleDetails as $detail)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $detail->product->name }}</h3> 
                            <!-- Suponiendo que tienes una relación product en tu modelo SaleDetail -->
                        </div>
                        <div class="card-body">
                            <p><strong>Cantidad:</strong> {{ $detail->quantity }}</p>
                            <p><strong>Precio Unitario:</strong> ${{ number_format($detail->price, 2) }}</p>
                            <p><strong>Peso:</strong> {{ number_format($detail->product->weight, 2) }}kg</p>
                            <p><strong>Precio Subtotal:</strong> ${{ number_format($detail->subtotal, 2) }}</p>
                            <p><strong>Peso Total:</strong> {{ number_format($detail->product->weight * $detail->quantity, 2) }}kg</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
