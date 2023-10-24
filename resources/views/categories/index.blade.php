
<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Usuarios</h3>
            <div class="card-tools">
                <a  href="{{ route('categories.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nuevo Usuario
                </a>
            </div>
        </div>
        <table id="usuarios" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Fecha de creacion</th>
                    <th>Ultima actualizacion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('categories.destroy', $category->id)}}">
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