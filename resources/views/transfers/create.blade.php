<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nueva transaccion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('transfers.store') }}">
                    @csrf

                    <!-- Tipo transaccion -->
                    <div>
                        <x-input-label for="transaction_type" :value="__('Tipo')" />
                        <select name="transaction_type" id="transaction_type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" onchange="updateBranches()">

                            
                            <option value="0" {{ 'selected' }}> Proveedor a Fabrica </option>
                            <option value="1"> Fabrica a Sucursal </option>
                        </select>
                        <x-input-error :messages="$errors->get('transaction_type')" class="mt-2" />
                    </div>
            
                    <!-- Desde donde se envia -->
                    <div class="mt-4">
                        <x-input-label for="from_id" :value="__('Desde')" />
                        
                        <select name="from_id" id="from_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branchesSupplier as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('from_id')" class="mt-2" />
                    </div>
            
                    <!-- Hacia donde llego-->
                    <div class="mt-4">
                        <x-input-label for="branch_id" :value="__('Hacia')" />
                        
                        <select name="branch_id" id="branch_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($branchesFactory as $branche)
                                <option value="{{ $branche->id }}">{{ $branche->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('branch_id')" class="mt-2" />
                    </div>
                    <!-- Producto-->
                    <div class="mt-4">
                        <x-input-label for="product_id" :value="__('Producto')" />
                        
                        <select name="product_id" id="product_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>
            
                    <!-- Usuario -->
                    <div class="mt-4">
                        <x-input-label for="user_id" :value="__('Transportista')" />
                        
                        <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>
            
                    <!-- Cantidad -->
                    <div  class="mt-4">
                        <x-input-label for="quantity" :value="__('Cantidad (KG)')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity"  required autofocus autocomplete="Cantidad" />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">     
                        <x-primary-button class="ml-4">
                            {{ __('Registrar') }}
                        </x-primary-button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <script>
        function updateBranches() {
            const transactionType = document.getElementById('transaction_type').value;
            const fromSelect = document.getElementById('from_id');
            const toSelect = document.getElementById('branch_id');
    
            // Clear both selects
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
