<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::where('id', $id)->with('category')->first();

        return view('productdetail', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $product = Product::where('product_name', 'LIKE', '%'.$request->search.'%')->first();

        if($product != null)
        {
            return redirect()->route('user.product.detail', $product->id)->with('product', $product);
        }
        else return redirect()->route('home');
    }
}
