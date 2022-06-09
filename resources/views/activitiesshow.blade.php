@extends('layouts.app')

@section('content')
<div class="container">

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activitie)
                    <tr>
                        <td>{{ $activitie->title }}</td>
                        <td>{{ $activitie->percentage }}</td>
                        <td>{{ $activitie->score }}</td>
                        <td>{{ $activitie->updated_at }}</td>
                    </tr>
                    @endforeach      
                </tbody>
            </table>
            <div hidden>
                @php
                    $nota = 0
                @endphp
                @foreach($activities as $activitie)
                    {{ $nota = $nota + $activitie->percentage * $activitie->score}}
                @endforeach
            </div>
            <div class="form-group row">
                <label for="message-text" class="col-md-2 col-form-label">Nota final:</label>
                <div class="col-md-4">
                    <label for="message-text" class="col-form-label">{{ $nota }}</label>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection

