@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ $title }}</h2>
        </div>
        <div class="panel-body">
            <a class="btn btn-success" href="{{ route('product_types.create') }}"><i class="fa fa-plus"></i> Nuevo</a>
            <br />
            <br />
            <table class="table table-bordered table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>/</th>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('product_types.edit',$d->id) }}"><i class="fa fa-pencil"></i></a>
                                {!! Form::open(['route' => ['product_types.destroy',$d->id], 'method' => 'DELETE', 'autocomplete' => 'off', 'style' => 'display:inline']) !!}
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
        $('#flash-overlay-modal').modal();
		$("table.table").DataTable();

        $("body").on('click','button.btn-danger', function(){
            if(!confirm("Estas seguro de eliminar este Registro?")){
                return false;
            }
        });
	});
</script>
@stop