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
                            <span class="info-box-text text-center text-muted">Nombre</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Correo</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Rol asignado</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->role }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Sucursal a la que pertenece</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->branch->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Fecha de creacion del usuario</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->created_at }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Ultima actualizacion</span>
                            <span class="info-box-number text-center text-muted mb-0">{{  $user->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
