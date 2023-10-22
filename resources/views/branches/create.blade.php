<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nueva rama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('branches.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div  class="mt-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="Nombre" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                     <!-- Ruc -->
                     <div  class="mt-4">
                        <x-input-label for="ruc" :value="__('RUC')" />
                        <x-text-input id="ruc" class="block mt-1 w-full" type="text" name="ruc"  autocomplete="ruc" />
                        <x-input-error :messages="$errors->get('ruc')" class="mt-2" />
                    </div>  

                     <!-- Pais -->
                     <div  class="mt-4">
                        <x-input-label for="country" :value="__('Pais')" />
                        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"  autocomplete="Pais" />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div> 

                     <!-- Departamento -->
                     <div  class="mt-4">
                        <x-input-label for="department" :value="__('Departamento')" />
                        <x-text-input id="department" class="block mt-1 w-full" type="text" name="department"  autocomplete="Departamento" />
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div> 
                     <!-- Provincia -->
                     <div  class="mt-4">
                        <x-input-label for="province" :value="__('Provincia')" />
                        <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"  autocomplete="Provincia" />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div> 
                     <!-- Distrito -->
                     <div  class="mt-4">
                        <x-input-label for="district" :value="__('Distrito')" />
                        <x-text-input id="district" class="block mt-1 w-full" type="text" name="district"  autocomplete="Distrito" />
                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                    </div> 
                    <!-- Direccion -->
                    <div  class="mt-4">
                        <x-input-label for="address" :value="__('Direccion')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"  autocomplete="Direccion" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div> 
                    <!-- Tipo transaccion -->
                    <div>
                        <x-input-label for="type" :value="__('Tipo')" />
                        <select name="type" id="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">
                            <option value="supplier" {{ 'selected' }}> Proveedor</option>
                            <option value="office"> Sucursal </option>
                            <option value="factory"> Fabrica </option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
