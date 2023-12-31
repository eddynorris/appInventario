<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de producto</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Nombre</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Categoria</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->category->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Descripcion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->description }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Presentacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->container }} de {{  $product->weight }}{{ $product->unit_measure }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Precio</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->price }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de creacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Ultima actualizacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $product->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
