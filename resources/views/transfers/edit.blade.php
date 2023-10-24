<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar usuario</h3>
        </div>
            <form method="post" action="{{ route('transfers.update', $transfer) }}">
                @csrf
                @method('patch')
                <div class="card-body">

                    <div class="form-group">
                        <label>Usuario</label>
                        <select class="form-control" name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $transfer->user_id ? 'selected' : '' }}>{{ $user->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de transferencia</label>
                        <select class="form-control" name="transaction_type" id="transaction_type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" onchange="updateBranches()">   
                            <option value="0" {{ 'selected' }}> Proveedor a Fabrica </option>
                            <option value="1"> Fabrica a Sucursal </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Desde</label>
                        <select class="form-control" name="from_id" id="from_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branchesSupplier as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $transfer->from_id ? 'selected' : '' }}>{{ $supplier->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hacia a</label>
                        <select class="form-control" name="branch_id" id="branch_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branchesFactory as $branch)
                                <option value="{{ $branch->id }}" {{ $branch->id == $transfer->branch_id ? 'selected' : '' }}>{{ $branch->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Producto</label>
                        <select class="form-control" name="product_id" id="product_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $transfer->product_id ? 'selected' : '' }}>
                                    {{ $product->name }} (viene en: {{ $product->container }} de {{ $product->weight }}{{ $product->unit_measure }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" value="{{ $transfer->quantity }}" min="0" placeholder="Cantidad" > 
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Editar transferencia</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function updateBranches() {
            const transactionType = document.getElementById('transaction_type').value;
            const fromSelect = document.getElementById('from_id');
            const toSelect = document.getElementById('branch_id');
    
            // limpiar selecciones
            fromSelect.innerHTML = '';
            toSelect.innerHTML = '';
    
            // Supplier to Factory
            if (transactionType == "0") {
                @foreach($branchesSupplier as $supplier)
                    fromSelect.innerHTML += `<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>`;
                @endforeach
    
                @foreach($branchesFactory as $branch)
                    toSelect.innerHTML += `<option value="{{ $branch->id }}">{{ $branch->name }}</option>`;
                @endforeach
            }
            // Factory to Office
            else {
                @foreach($branchesFactory as $branch)
                    fromSelect.innerHTML += `<option value="{{ $branch->id }}">{{ $branch->name }}</option>`;
                @endforeach
    
                @foreach($branchesOffice as $office)
                    toSelect.innerHTML += `<option value="{{ $office->id }}">{{ $office->name }}</option>`;
                @endforeach
            }
        }
    </script>
</x-app-layout>
