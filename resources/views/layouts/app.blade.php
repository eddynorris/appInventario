
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if (isset($header))
    <header class="">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif
@stop

@section('content')
    <main>
        {{ $slot }}
    </main>
@stop


@section('css')

@stop

@section('js')
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session("success") }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session("error") }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Aviso',
            text: '{{ session("warning") }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

@stop