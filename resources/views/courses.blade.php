@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#registrarCurso">
                    Nuevo Curso
                </button>
            </p>    
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card">
            <div class="card-header">Cursos</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->theme }}</td>
                        <td>{{ $course->type }}</td>
                        <td>{{ $course->updated_at }}</td>
                        <td>
                        
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarCurso" data-id="{{ $course->id }}" data-user_id="{{ $course->user_id }}" data-theme="{{ $course->theme }}" data-type="{{ $course->type }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarCurso" data-id="{{ $course->id }}">
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

<div class="modal fade" id="registrarCurso" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel">Registrar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Docente</label>
                        <div class="col-md-6">
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    @if($user->type == 'docente')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Tema</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="theme" name="theme" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Tipo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="type" name="type" required minlength="5" maxlength="255">
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

<div class="modal fade" id="editarCurso" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{ route('courses.update', $user->id) }}">
                    @csrf 
                    <div hidden class="form-group">
                        <label for="recipient-name" class="col-form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Docente</label>
                        <div class="col-md-6">
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    @if($user->type == 'docente')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Tema</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="theme" name="theme" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Tipo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="type" name="type" required minlength="5" maxlength="255">
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

<div class="modal fade" id="eliminarCurso" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">¿Seguro que deseas eliminarlo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="DELETE" action="{{ route('courses.destroy', $user->id) }}">
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

