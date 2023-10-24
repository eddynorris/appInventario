<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar sucursal</h3>
        </div>
            <form method="post" action="{{ route('branches.update', $branch) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$branch->name}}" placeholder="Nombre de la sucursal">
                    </div>
                    <div class="form-group">
                        <label for="ruc">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" value="{{$branch->ruc}}" placeholder="Ingresar RUC">
                    </div>
                    <div class="form-group">
                        <label for="country">Pais</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{$branch->country}}" placeholder="Pais de la sucursal">
                    </div>
                    <div class="form-group">
                        <label for="department">Departamento</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{$branch->department}}" placeholder="Ingrese el departamento ">
                    </div>
                    <div class="form-group">
                        <label for="province">Provincia</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{$branch->province}}" placeholder="Ingrese la provincia">
                    </div>
                    <div class="form-group">
                        <label for="district">Distrito</label>
                        <input type="text" class="form-control" id="district" name="district" value="{{$branch->district}}" placeholder="Ingrese el distrito">
                    </div>
                    <div class="form-group">
                        <label for="address">Direccion</label>
                        <input type="text" class="form-control" id="address" name="address" value={{ "$branch->address" }} placeholder="Direccion de la sucursal">
                    </div>
                    <div class="form-group">
                        <label>Tipo de sucursal</label>
                        <select class="form-control" id="type" name="type"> 
                            <option value="supplier" {{ old('type', $branch->type) == 'supplier' ? 'selected' : '' }}> Proveedor</option>
                            <option value="office" {{ old('type', $branch->type) == 'office' ? 'selected' : '' }}> Sucursal </option>
                            <option value="factory" {{ old('type', $branch->type) == 'factory' ? 'selected' : '' }}> Fabrica </option>
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


