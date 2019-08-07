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
                {!! Form::open(['route' => 'products.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => ['products.update',@$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
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
                    <label for="product_type_id">Tipo de Producto: </label>
                    <select class="form-control" name="product_type_id" id="product_type_id">
                        <option>-</option>
                        @foreach($product_types as $pt)
                            <option value="{{ $pt->id }}" @if(@$data->product_type_id == $pt->id) selected='selected' @endif>{{ $pt->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Precio: </label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ @$data->price }}" />
                </div>
                <div class="form-group">
                    <label for="image">Imagen: </label>
                    @if(!empty(@$data->image))
                        <br />
                        <br />
                        <img src="{{ asset('application/storage/app/'.@$data->image) }}" class="img-thumbnail" width="150" height="150">
                        <br />
                        <br />
                    @endif
                    <input type="file" class="form-control" name="image" id="image"/>
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop