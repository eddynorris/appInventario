<x-app-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar usuario</h3>
        </div>
            <form method="post" action="{{ route('users.update', $user) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Nombre completo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="ejemplo@ejemplo.com">
                    </div>

                    <div class="form-group">
                        <label>Rol</label>
                        <select class="form-control" id="role" name="role"> 
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sucursal</label>
                        <select class="form-control" id="branch_id" name="branch_id">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('role', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
