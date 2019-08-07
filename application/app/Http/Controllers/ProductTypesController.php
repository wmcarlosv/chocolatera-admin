<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypesController extends Controller
{
    private $view = "admin.product_types."; 
    private $router = "product_types.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductType::all();
        $title = "Tipos de Productos";
        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nuevo Tipo de Producto";
        $action = "create";
        return view($this->view.'save',['title' => $title, 'action' => $action]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $object = new ProductType();
        $object->name = $request->input('name');

        if($object->save()){
            flash()->overlay('Registro insertado con Exito!!','Exito');
        }else{
            flash()->overlay('Error al tratar de insertar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Editar Tipo de Producto";
        $action = "edit";
        $data = ProductType::findorfail($id);
        return view($this->view.'save',['title' => $title, 'action' => $action, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $object = ProductType::findorfail($id);
        $object->name = $request->input('name');

        if($object->save()){
            flash()->overlay('Registro Actualizado con Exito!!','Exito');
        }else{
            flash()->overlay('Error al tratar de Actualizar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $object = ProductType::findorfail($id);

        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito');
        }else{
            flash()->overlay('Erros al tratar de eliminar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }
}
