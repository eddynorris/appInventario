<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar nueva categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div  class="mt-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="Nombre" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                     <!-- Descripcion -->
                     <div  class="mt-4">
                        <x-input-label for="description" :value="__('Descripcion del producto')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"  autocomplete="Descripcion" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
