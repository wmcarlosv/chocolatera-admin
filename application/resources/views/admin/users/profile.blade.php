@extends('adminlte::page')

@section('title', $title)

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>            
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'update_profile', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" class="form-control" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="email">Correo: </label>
                    <input type="text" name="email" class="form-control" value="{{ @$data->email }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Telefono: </label>
                    <input type="text" name="phone" class="form-control" value="{{ @$data->phone }}" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('home') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div> 
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Cambiar Contrase&ntilde;a</h2>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'update_password', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    <label for="password">Contrase&ntilde;a: </label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Correo: </label>
                    <input type="password" name="password_confirmation" class="form-control" value="" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
            {!! Form::close() !!}
        </div>
    </div>
@stop
