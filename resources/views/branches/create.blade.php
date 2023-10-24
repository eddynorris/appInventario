<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nueva Sucursal</h3>
        </div>
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la sucursal">
                    </div>
                    <div class="form-group">
                        <label for="ruc">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Ingresar RUC">
                    </div>
                    <div class="form-group">
                        <label for="country">Pais</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Pais de la sucursal">
                    </div>
                    <div class="form-group">
                        <label for="department">Departamento</label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="Departamento">
                    </div>
                    <div class="form-group">
                        <label for="province">Provincia</label>
                        <input type="text" class="form-control" id="province" name="province" placeholder="Provincia">
                    </div>
                    <div class="form-group">
                        <label for="district">Distrito</label>
                        <input type="text" class="form-control" id="district" name="district" placeholder="Distrito">
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Direccion de la sucursal">
                    </div>
                    <div class="form-group">
                        <label>Tipo de sucursal</label>
                        <select class="form-control" id="type" name="type"> 
                            <option value="supplier"> Proveedor</option>
                            <option value="office"> Sucursal </option>
                            <option value="factory"> Fabrica </option>
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

