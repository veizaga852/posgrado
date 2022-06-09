@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#registrarRegistro">
                    Nuevo Registro
                </button>
            </p>    
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card">
            <div class="card-header">Registros</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>
                        @foreach($users as $user)
                            @if($user->id == $record->user_id)
                                {{ $user->name }}    
                            @endif
                        @endforeach
                        </td>
                        <td>{{ $record->updated_at }}</td>
                        <td>
                        
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarRegistro" data-id="{{ $record->id }}" data-user_id="{{ $record->user_id }}" data-course_id="{{ $record->course_id }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarRegistro" data-id="{{ $record->id }}">
                                Eliminar
                            </button>
                            <a class="btn btn-primary" href="{{ route('records.edit', $record->id) }}">
                                Actividades
                            </a>
                        </td>
                    </tr>
                    @endforeach      
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registrarRegistro" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel">Crear registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('records.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Estudiante</label>
                        <div class="col-md-6">
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    @if($user->type == 'estudiante')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Curso</label>
                        <div class="col-md-6">
                            <select class="form-control" id="course_id" name="course_id">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->theme }}</option>
                                @endforeach    
                            </select>
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

<div class="modal fade" id="editarRegistro" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{ route('records.update', $user->id) }}">
                    @csrf 
                    <div hidden class="form-group">
                        <label for="recipient-name" class="col-form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Estudiante</label>
                        <div class="col-md-6">
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    @if($user->type == 'estudiante')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Curso</label>
                        <div class="col-md-6">
                            <select class="form-control" id="course_id" name="course_id">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->theme }}</option>
                                @endforeach    
                            </select>
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

<div class="modal fade" id="eliminarRegistro" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">¿Seguro que deseas eliminarlo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="DELETE" action="{{ route('records.destroy', $user->id) }}">
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

