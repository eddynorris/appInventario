<x-app-layout>
    <table>
        @foreach($salesThisWeek as $sale)
            <tr>
                <td>{{ $sale->user->name }}</td>
                <td>{{ $sale->duration }}</td>
                <!-- Otros campos que quieras mostrar -->
            </tr>
        @endforeach
    </table>
    
    <h3>Ventas para este mes</h3>
    <table>
        @foreach($salesThisMonth as $sale)
            <tr>
                <td>{{ $sale->user->name }}</td>
                <td>{{ $sale->duration }}</td>
                <!-- Otros campos que quieras mostrar -->
            </tr>
        @endforeach
    </table>    
</x-app-layout>
<h3>Ventas para esta semana</h3>
