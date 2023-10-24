
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop