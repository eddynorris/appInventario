<x-app-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles de la sucursal</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Nombre</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $category->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">RUC</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $category->description }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de creacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $category->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Ultima actualizacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $category->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
