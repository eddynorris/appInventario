<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Tabla de Sucursales</h3>
            <div class="card-tools">
                <a  href="{{ route('branches.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nueva Sucursal
                </a>
            </div>
        </div>
        <div class="card-body">
            <div id="transfers_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <x-adminlte-datatable id="branch" :heads="$heads" head-theme="dark" class="bg-light" :config="$config"
                        striped hoverable with-buttons/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>