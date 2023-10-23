<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Agregar nuevo usuario</h3>
        </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@ejemplo.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="**********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="**********">
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <select class="form-control" id="role" name="role"> 
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sucursal</label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
