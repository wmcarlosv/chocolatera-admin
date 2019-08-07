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
            @if($action == 'create')
                {!! Form::open(['route' => 'business.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @else
                {!! Form::open(['route' => ['business.update',@$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            @endif
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ @$data->email }}" />
                </div>
                <div class="form-group">
                    <label for="phone">Telefono: </label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ @$data->phone }}" />
                </div>
                <div class="form-group">
                    <label for="commission">Comision: </label>
                    <input type="text" class="form-control" name="commission" id="commission" value="{{ @$data->commission }}" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('business.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop