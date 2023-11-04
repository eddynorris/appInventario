<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nuevo inventario</h3>
        </div>
            <form method="POST" action="{{ route('inventories.store') }}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Sucursal</label>
                        <select class="form-control" name="branch_id" id="branch_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Producto</label>
                        <select class="form-control" name="product_id" id="product_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (viene en: {{ $product->container }} de {{ $product->weight }}{{ $product->unit_measure }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock">Cantidad en inventario</label>
                        <input type="number" class="form-control" id="stock" name="stock" step="0.01" value="0" min="0" placeholder="Cantidad" > 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar transferencia</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
