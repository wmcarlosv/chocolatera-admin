<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Busines;
use Auth;

class UsersController extends Controller
{
    private $view = "admin.users."; 
    private $router = "users.index";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $title = "Coordinadores";
        return view($this->view.'index',['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Nuevo Coordinador";
        $action = "create";
        $business = Busines::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'business' => $business]);
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
            'email' => 'required|unique:users|email'
        ]);

        $object = new User();
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->role = $request->input('coordinator');
        $object->password = bcrypt('123456');

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
        $title = "Editar Coordinador";
        $action = "edit";
        $data = User::findorfail($id);
        $business = Busines::all();
        return view($this->view.'save',['title' => $title, 'action' => $action, 'data' => $data, 'business' => $business]);
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
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $object = User::findorfail($id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');
        $object->business_id = $request->input('business_id');

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
        $object = User::findorfail($id);

        if($object->delete()){
            flash()->overlay('Registro Eliminado con Exito!!','Exito');
        }else{
            flash()->overlay('Erros al tratar de eliminar el Registro!!','Error');
        }

        return redirect()->route($this->router);
    }

    public function profile(){
        $data = Auth::user();
        $title = "Perfil";
        return view($this->view.'profile',['title' => $title, 'data' => $data]);
    }

    public function update_profile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->name = $request->input('name');
        $object->email = $request->input('email');
        $object->phone = $request->input('phone');

        if($object->update()){
            flash()->overlay('Registro Actualizado con Exito!!','Exito');
        }else{
            flash()->overlay('Error al intentar actualizar el Registro','Error');
        }

        return redirect()->route('home');
    }

    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $object = User::findorfail(Auth::user()->id);
        $object->password = bcrypt($request->input('password'));

        if($object->update()){
            flash()->overlay('Registro Actualizado con Exito!!','Exito');
        }else{
            flash()->overlay('Error al intentar actualizar el Registro','Error');
        }

        return redirect()->route('home');    
    }
}