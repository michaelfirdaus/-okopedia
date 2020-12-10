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
        //Find specific product by comparing product ID and get the category too
        $product = Product::where('id', $id)->with('category')->first();

        //Redirecting user to productdetail view and pass the specific product
        return view('productdetail', ['product' => $product]);
    }

    //Custom function to search a product
    public function search(Request $request)
    {
        //Find products by comparing the product name
        $products = Product::where('product_name', 'LIKE', '%'.$request->search.'%')->paginate(1);
        
        //Check if the search keyword match with a product
        if($products->count() > 0)
        {
            return view('home', ['products' => $products]);
        }
        //Check if the search keyword doesn't match any product
        else {
            return redirect()->route('home');
            
        }
    }
}
