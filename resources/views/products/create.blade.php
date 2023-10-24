<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nuevo producto</h3>
        </div>
            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto">
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Descripcion del producto">
                    </div>
                    <div class="form-group">
                        <label for="unit_measure">Unidad de medida</label>
                        <input type="text" class="form-control" id="unit_measure" name="unit_measure" placeholder="Unidad de medida (kg, tn, etc)">
                    </div>
                    <div class="form-group">
                        <label for="container">Contenedor</label>
                        <input type="text" class="form-control" id="container" name="container" placeholder="Contenedor del producto (bolsas, sacos, etc)">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" value="0" min="0" placeholder="Precio" >
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <input type="number" class="form-control" id="weight" name="weight" step="0.01" value="0" min="0" placeholder="Peso del producto" > 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
