<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Busines;

class BusinessController extends Controller
{
    private $view = "admin.business."; 
    private $router = "business.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Busines::all();
        $title = "Empresas";
        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nueva Empresa";
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
            'name' => 'required',
            'email' => 'required|unique:business|email',
            'phone' => 'required',
            'commission' => 'required'
        ]);

        $object = new Busines();
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->commission = $request->input('commission');

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
        $title = "Editar Empresa";
        $action = "edit";
        $data = Busines::findorfail($id);
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
            'name' => 'required',
            'email' => 'required|unique:business|email',
            'phone' => 'required',
            'commission' => 'required'
        ]);

        $object = Busines::findorfail($id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->commission = $request->input('commission');

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
        $object = Busines::findorfail($id);

        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito');
        }else{
            flash()->overlay('Erros al tratar de eliminar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }
}
