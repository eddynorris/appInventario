<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar Inventario</h3>
        </div>
            <form method="post" action="{{ route('inventories.update', $inventory) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label>Sucursal</label>
                        <select class="form-control" name="branch_id" id="branch_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $branch->id == $inventory->branch_id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Producto</label>
                        <select class="form-control" name="product_id" id="product_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $inventory->product_id ? 'selected' : '' }}>{{ $product->name }} (viene en: {{ $product->container }} de {{ $product->weight }}{{ $product->unit_measure }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Cantidad en inventario</label>
                        <input type="number" class="form-control" id="stock" name="stock" step="0.01" value="{{ $inventory->stock }}" min="0" > 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
