<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar categoria</h3>
        </div>
            <form method="POST" action="{{ route('categories.update', $category) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{  $category->name }}" placeholder="Nombre de la categoria">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}" placeholder="Ingrese una descripcion">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

