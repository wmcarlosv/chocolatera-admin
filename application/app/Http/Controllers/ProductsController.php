<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\ProductType;

class ProductsController extends Controller
{
    private $view = "admin.products."; 
    private $router = "products.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        $title = "Productos";
        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nuevo Producto";
        $action = "create";
        $product_types = ProductType::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'product_types' => $product_types]);
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
            'product_type_id' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $object = new Product();
        $object->name = $request->input('name');
        $object->product_type_id = $request->input('product_type_id');
        $object->description = $request->input('description');
        $object->price = $request->input('price');

        if($request->hasFile('image')){
            $object->image = $request->image->store('products/images/');
        }else{
            $object->image = NULL;
        }

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
        $title = "Editar Producto";
        $action = "edit";
        $data = Product::findorfail($id);
        $product_types = ProductType::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'data' => $data, 'product_types' => $product_types]);
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
            'product_type_id' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $object = Product::findorfail($id);
        $object->name = $request->input('name');
        $object->product_type_id = $request->input('product_type_id');
        $object->description = $request->input('description');
        $object->price = $request->input('price');

        if($request->hasFile('image')){
            Storage::delete($object->image);
            $object->image = $request->image->store('products/images/');
        }

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
        $object = Product::findorfail($id);
        $image = $object->image;

        if($object->delete()){

            Storage::delete($image);
            
            flash()->overlay('Registro Eliminado con Exito!!','Exito');
        }else{
            flash()->overlay('Erros al tratar de eliminar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }
}
