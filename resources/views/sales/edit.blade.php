<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('sales.update', $sale) }}">
                    @csrf
                    @method('patch')
                    <!-- Categoria -->
                    <div class="mt-4">
                        <x-input-label for="user_id" :value="__('Categoria')" />
                        
                        <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            @foreach($users as $users)
                                <option value="{{ $users->id }}" {{ old('role', $sale->user_id) == $users->id ? 'selected' : '' }}>{{ $users->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>
                    <!-- Documento -->
                    <div  class="mt-4">
                        <x-input-label for="document" :value="__('DNI')" />
                        <x-text-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('name', $sale->document)" required autofocus autocomplete="DNI cliente" />
                        <x-input-error :messages="$errors->get('document')" class="mt-2" />
                    </div>

                     <!-- Cliente -->
                     <div  class="mt-4">
                        <x-input-label for="client" :value="__('Cliente')" />
                        <x-text-input id="client" class="block mt-1 w-full" type="text" name="client" :value="old('name', $sale->client)" required  autocomplete="Cliente" />
                        <x-input-error :messages="$errors->get('client')" class="mt-2" />
                    </div>  

                    <!-- Direccion -->
                    <div  class="mt-4">
                        <x-input-label for="address" :value="__('Direccion')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('name', $sale->address)" required  autocomplete="Direccion" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                     <!-- Monto total -->
                     <div  class="mt-4">
                        <x-input-label for="total_amount" :value="__('Monto total')" />
                        <x-text-input id="total_amount" class="block mt-1 w-full" type="number" step="0.01" name="total_amount" :value="old('name', $sale->total_amount)" required  autocomplete="Monto total" />
                        <x-input-error :messages="$errors->get('total_amount')" class="mt-2" />
                    </div> 

                    <!-- Peso total -->
                    <div  class="mt-4">
                        <x-input-label for="total_weight" :value="__('Peso total')" />
                        <x-text-input id="total_weight" class="block mt-1 w-full" type="number" step="0.01" name="total_weight" :value="old('name', $sale->total_weight)" required  autocomplete="Peso" />
                        <x-input-error :messages="$errors->get('total_weight')" class="mt-2" />
                    </div>

                    <!-- Duracion -->
                    <div  class="mt-4">
                        <x-input-label for="duration" :value="__('Duracion estimada')" />
                        <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('name', $sale->duration)" required  autocomplete="Duracion" />
                        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
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
</x-app-layout>
