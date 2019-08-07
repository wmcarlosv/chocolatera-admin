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
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#promotion">Promocion</a></li>
              <li><a data-toggle="tab" href="#products">Productos</a></li>
            </ul>
            @if($action == 'create')
                {!! Form::open(['route' => 'promotions.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
                {!! Form::open(['route' => ['promotions.update',@$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
            @endif
                <div class="tab-content">
                  <div id="promotion" class="tab-pane fade in active">
                    <br />
                    <div class="form-group">
                        <label for="name">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ @$data->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Descripci&oacute;n: </label>
                        <textarea class="form-control" name="description" id="description"> {{ @$data->description }}</textarea>
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

                    <div class="form-group">
                        <label for="price">Precio: </label>
                        <input type="text" class="form-control" name="price" id="price" value="{{ @$data->price }}" />
                    </div>
                  </div>
                  <div id="products" class="tab-pane fade">
                    <br />
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>-</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Preco</th>
                            <th>Foto</th>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                                <tr>
                                    <td><input type="checkbox" style="width:20px; height:20px;" name="products[]" id="check_box_{{ $p->id }}" value="{{ $p->id }}"></td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->product_type->name }}</td>
                                    <td>{{ $p->price }}</td>
                                    <td>
                                        @if(!empty($p->image))
                                            <img src="{{ asset('application/storage/app/'.$p->image) }}" width="50" height="50" class="img-thumbnail" />
                                        @else
                                            <label class="label label-danger">Sin Imagen</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                <a class="btn btn-danger" href="{{ route('promotions.index') }}"><i class="fa fa-times"></i> Cancelar</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            @if($action == 'edit')
                @foreach(@$data->products as $ps)
                    $("#check_box_{{ $ps->id }}").prop('checked',true);
                @endforeach
            @endif
        });
    </script>
@stop