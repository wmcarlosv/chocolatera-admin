@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
    <div class="row">
    	<div class="col-md-3">
    		<div class="info-box">
			  <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Empresas</span>
			    <span class="info-box-number">{{ $data['business']->count() }}</span>
			  </div>
			</div>
    	</div>

    	<div class="col-md-3">
    		<div class="info-box">
			  <span class="info-box-icon bg-blue"><i class="fa fa-home"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Hoteles</span>
			    <span class="info-box-number">{{ $data['hotels']->count() }}</span>
			  </div>
			</div>
    	</div>

    	<div class="col-md-3">
    		<div class="info-box">
			  <span class="info-box-icon bg-green"><i class="fa fa-product-hunt"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Productos</span>
			    <span class="info-box-number">{{ $data['products']->count() }}</span>
			  </div>
			</div>
    	</div>

    	<div class="col-md-3">
    		<div class="info-box">
			  <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Promociones</span>
			    <span class="info-box-number">{{ $data['promotions']->count() }}</span>
			  </div>
			</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="panel pane-default">
    			<div class="panel-heading">
    				<h2>Ultimos Productos</h2>
    			</div>
    			<div class="panel-body">
    				<table class="table table-bordered table-striped">
    					<thead>
    						<th>ID</th>
    						<th>Nombre</th>
    						<th>Precio</th>
    						<th>Foto</th>
    					</thead>
    					<tbody>
    						@foreach($data['products'] as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->price }}</td>
                                    <td>
                                        @if(!empty($p->image))
                                            <img src="{{ asset('application/storage/app/'.$p->image) }}" class="img-thumbnail" width="100" height="100" />
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
    	</div>
    	<div class="col-md-6">
    		<div class="panel pane-default">
    			<div class="panel-heading">
    				<h2>Ultimas Promociones</h2>
    			</div>
    			<div class="panel-body">
    				<table class="table table-bordered table-striped">
    					<thead>
    						<th>ID</th>
    						<th>Nombre</th>
    						<th>Precio</th>
                            <th>Foto</th>
    					</thead>
    					<tbody>
                            @foreach($data['promotions'] as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->price }}</td>
                                    <td>
                                        @if(!empty($p->image))
                                            <img src="{{ asset('application/storage/app/'.$p->image) }}" class="img-thumbnail" width="100" height="100" />
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
    	</div>
    </div>
@stop
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
        $('#flash-overlay-modal').modal();
		$("table.table").DataTable();
	});
</script>
@stop