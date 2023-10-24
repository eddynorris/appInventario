<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Sucursales</h3>
            <div class="card-tools">
                <a  href="{{ route('branches.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nueva sucursal
                </a>
            </div>
        </div>
        <table id="usuarios" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nombre</th>
                    <th>RUC</th>
                    <th>Pais</th>
                    <th>Departamento</th>
                    <th>Provincia</th>
                    <th>Distrito</th>
                    <th>Direccion</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->ruc }}</td>
                        <td>{{ $branch->country }}</td>
                        <td>{{ $branch->department }}</td>
                        <td>{{ $branch->province }}</td>
                        <td>{{ $branch->district }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->type }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('branches.show', $branch) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('branches.edit', $branch) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('branches.destroy', $branch->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Esta seguro?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                             </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
</x-app-layout>