<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Product;
use App\Category;
use App\Cart;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', [
            'users'    => User::all(),
            'products' => Product::paginate(3),
        ]);
    }

    public function search(Request $request)
    {
        
    }
}
