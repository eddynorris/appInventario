<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Notas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <form action="{{ route('notes.update', $note) }}" method="post">
                    @method('put')
                    @csrf
                    <input name="title"  placeholder="Titulo" class="w-full" value="{{ $note->title }}" autocomplete="off">
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    <textarea name="text" rows="10" placeholder="Escribe aqui marrano" class="w-full"> {{ $note->text }} </textarea>
                    <x-input-error :messages="$errors->get('text')" class="mt-2"/>
                    <button class="mt-6"> Guardar Nota </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
