@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-7">
        <div class="card">
            <div class="card-header">{{ $course->theme }}</div>
            <div class="card-body">
    
                <div class="form-group row">
                    <label for="message-text" class="col-md-3 col-form-label">Tipo del curso:</label>
                    <div class="col-md-4">
                        <label for="message-text" class="col-form-label">{{ $course->type }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message-text" class="col-md-3 col-form-label">Docente:</label>
                    <div class="col-md-4">
                        <label for="message-text" class="col-form-label">{{ $user->name }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message-text" class="col-md-3 col-form-label">Correo del docente:</label>
                    <div class="col-md-4">
                        <label for="message-text" class="col-form-label">{{ $user->email }}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message-text" class="col-md-3 col-form-label">Fecha del registro:</label>
                    <div class="col-md-4">
                        <label for="message-text" class="col-form-label">{{ $record->updated_at }}</label>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

