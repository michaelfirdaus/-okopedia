<?php

namespace App\Http\Controllers;

use Session;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index')->with(['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        if($categories->count() == 0){
            Session::flash('info', 'You must have a category before attempting to create a new product.');
            return redirect()->back();
        }

        return view('admin.products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'product_name' => 'required|unique:products',
            'product_category' => 'required',
            'product_desc' => 'required',
            'product_price' => 'required|numeric',
            'product_image' => 'required|image|max:10240'
        ]);

        $image = $request->file('product_image');

        $fullImage = time().'.'.$image->getClientOriginalExtension();

        $path = public_path('/uploads/product_img/');

        $image->move($path, $fullImage);
        // $product_image = $request->product_image;
        // $product_new_name = time().$product_image->getClientOriginalName().$request->product_name;
        // $product_image->move('uploads/product_img', $product_new_name);

        $product = Product::create([
            'product_name' => $request->product_name,
            'product_image' => $fullImage,
            'product_category' => $request->product_category,
            'product_price' => $request->product_price,
            'product_desc' => $request->product_desc
        ]);

        Session::flash('success', 'Successfully created a product.');

        return redirect()->route('products');
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
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.products.edit')->with('product', $product)->with('categories', $categories);
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
        $product = Product::find($id);

        $this->validate($request, [
            'product_name' => 'required',
            'product_category' => 'required',
            'product_price' => 'required',
            'product_desc' => 'required'
        ]);

        if($request->hasFile('product_image')){
            $image = $request->file('product_image');

            $fullImage = time().'.'.$image->getClientOriginalExtension();
    
            $path = public_path('/uploads/product_img/');
    
            $image->move($path, $fullImage);

            $product->product_image = $fullImage;
        }
       
        $product->id = $request->id;
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price;
        $product->product_desc = $request->product_desc;

        $product->save();

        Session::flash('success', 'Product updated successfully.');

        return redirect()->route('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        Session::flash('success', 'Product has been deleted.');

        return redirect()->route('products');
    }
}
