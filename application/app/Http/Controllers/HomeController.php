<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Busines;
use App\Hotel;
use App\Product;
use App\Promotion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Escritorio";
        $data = [
            'business' => Busines::get(),
            'hotels' => Hotel::all(),
            'products' => Product::all(),
            'promotions' => Promotion::all()
        ];

        return view('home',['title' => $title, 'data' => $data]);
    }
}
