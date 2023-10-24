<x-app-layout>
    <div class="card">
        <div class="card-header mt-4">
            <h3 class="card-title">Productos</h3>
            <div class="card-tools">
                <a  href="{{ route('products.create') }}" type="button" class="btn btn-primary">
                    <i class="fas fa-save"></i> Nuevo Producto
                </a>
            </div>
        </div>
        <table id="usuarios" class="table table-striped shadow-lg mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Unidad de medida</th>
                    <th>Contenedor</th>
                    <th>Peso</th>
                    <th>Precio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->unit_measure }}</td>
                        <td>{{ $product->container }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>{{ $product->price }}</td>
                        <!-- Agrega aquí otros campos si los tienes -->
                        <td class="project-actions d-flex align-items-right">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="post" action="{{ route('products.destroy', $product->id)}}">
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
