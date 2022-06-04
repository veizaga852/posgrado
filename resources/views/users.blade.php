@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#registrarUsuario">
                    Nuevo Usuario
                </button>
            </p>    
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">Usuarios</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Creacion</th>
                        <th>Actualizacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                        
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarUsuario" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarUsuario" data-id="{{ $user->id }}">
                                Eliminar
                            </button>

                        </td>
                    </tr>
                    @endforeach      
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registrarUsuario" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel">Registrar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="name" name="name" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Correo</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control validate" id="email" name="email" required minlength="10" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control validate" id="password" name="password" required minlength="8" maxlength="255">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{ route('users.update', $user->id) }}">
                    @csrf 
                    <div hidden class="form-group">
                        <label for="recipient-name" class="col-form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="name" name="name" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Correo</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control validate" id="email" name="email" required minlength="10" maxlength="255">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">¿Seguro que deseas eliminarlo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="DELETE" action="{{ route('users.destroy', $user->id) }}">
                    @csrf 
                    <div hidden class="form-group">
                        <label for="recipient-name" class="col-form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Si, eliminalo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

