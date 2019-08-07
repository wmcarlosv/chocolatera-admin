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
                {!! Form::open(['route' => 'promotions.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @else
                {!! Form::open(['route' => ['promotions.update',@$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            @endif
                <div class="form-group">
                    <label for="name">Nombre: </label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="description">Descripci&oacute;n: </label>
                    <textarea class="form-control" name="description" id="description"> {{ @$data->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Precio: </label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ @$data->price }}" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('promotions.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop