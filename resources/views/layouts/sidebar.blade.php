<div class="bg-blue-800 text-white w-64 space-y-6 px-4 py-7">
    <a href="#" class="text-white text-2xl font-semibold uppercase hover:text-gray-300">Admin</a>
    <ul>
        <li><a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Panel de control</a></li>
        <li><a href="{{ route('users.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Usuarios</a></li>
        <li><a href="{{ route('branches.index') }}" :active="request()->routeIs('branches.index')" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Sucursales</a></li>
        <li><a href="{{ route('suppliers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Proveedores</a></li>
        <li><a href="{{ route('products.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Productos</a></li>
        <li><a href="{{ route('categories.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Categorias</a></li>
        <li><a href="{{ route('transfers.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Transacciones</a></li>
        <li><a href="{{ route('sales.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Ventas</a></li>

        <li><a href="" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-blue-700 hover:text-white">Configuracion</a></li>
    </ul>
</div>
