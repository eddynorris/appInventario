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
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">RUC</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->ruc }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Departamento</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->department }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Provincia</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->province }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Distrito</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->district }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Direccion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->address }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Tipo de sucursal</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->type }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de creacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Ultima actualizacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $branch->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
