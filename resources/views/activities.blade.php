@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <p>
                <button type="button" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#registrarActividad">
                    Nueva actividad
                </button>
            </p>    
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card">
            <div class="card-header">Actividades</div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Ponderacion</th>
                        <th>Nota</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activitie)
                    <tr>
                        <td>{{ $activitie->title }}</td>
                        <td>{{ $activitie->percentage }}</td>
                        <td>{{ $activitie->score }}</td>
                        <td>{{ $activitie->updated_at }}</td>
                        <td>
                        
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarActividad" data-id="{{ $activitie->id }}" data-record_id="{{ $activitie->record_id }}" data-title="{{ $activitie->title }}" data-percentage="{{ $activitie->percentage }}" data-score="{{ $activitie->score }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarActividad" data-id="{{ $activitie->id }}">
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

<div class="modal fade" id="registrarActividad" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel">Registrar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('activities.store') }}">
                    @csrf
                    <div hidden class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Registro</label>
                        <div class="col-md-6">
                            <select class="form-control" id="record_id" name="record_id">
                                @foreach($records as $record)
                                    <option value="{{ $record->id }}">{{ $record->id }}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Titulo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="title" name="title" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Ponderacion</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control validate" id="percentage" name="percentage" required step="0.1" min="0" max="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Nota</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control validate" id="score" name="score" required min="0" max="100">
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

<div class="modal fade" id="editarActividad" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{ route('activities.update', $record->id) }}">
                    @csrf 
                    <div hidden class="form-group">
                        <label for="recipient-name" class="col-form-label">id</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div hidden class="form-group row">
                        <label for="recipient-name" class="col-md-4 col-form-label text-md-right">Registro</label>
                        <div class="col-md-6">
                            <select class="form-control" id="record_id" name="record_id">
                                @foreach($records as $record)
                                    <option value="{{ $record->id }}">{{ $record->id }}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Titulo</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control validate" id="title" name="title" required minlength="5" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Ponderacion</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control validate" id="percentage" name="percentage" required step="0.1" min="0" max="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message-text" class="col-md-4 col-form-label text-md-right">Nota</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control validate" id="score" name="score" required min="0" max="100">
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

<div class="modal fade" id="eliminarActividad" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">¿Seguro que deseas eliminarlo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="DELETE" action="{{ route('activities.destroy', $record->id) }}">
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

