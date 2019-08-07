<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Promotion;
use App\Product;

class PromotionsController extends Controller
{
    private $view = "admin.promotions."; 
    private $router = "promotions.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Promotion::all();
        $title = "Promociones";
        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nueva Promocion";
        $action = "create";
        $products = Product::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'products' => $products]);
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
            'description' => 'required',
            'price' => 'required'
        ]);

        $object = new Promotion();
        $object->name = $request->input('name');
        $object->description = $request->input('description');
        $object->price = $request->input('price');

        if($request->hasFile('image')){
            $object->image = $request->image->store('promotions/images/');
        }else{
            $object->image = NULL;
        }

        if($object->save()){
            $object->products()->attach($request->input('products'));
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
        $title = "Editar Promocion";
        $action = "edit";
        $data = Promotion::findorfail($id);
        $products = Product::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'data' => $data, 'products' => $products]);
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
            'description' => 'required',
            'price' => 'required'
        ]);

        $object = Promotion::findorfail($id);
        $object->name = $request->input('name');
        $object->description = $request->input('description');
        $object->price = $request->input('price');

        if($request->hasFile('image')){
            Storage::delete($object->image);
            $object->image = $request->image->store('promotions/images/');
        }

        if($object->save()){
            $object->products()->detach();
            $object->products()->attach($request->input('products'));
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
        $object = Promotion::findorfail($id);

        $object->products()->detach();

        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito');
        }else{
            flash()->overlay('Erros al tratar de eliminar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }
}
