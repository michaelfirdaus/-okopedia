<?php

namespace App\Http\Controllers;

use Session;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //This controller should be accessible only by authenticated user
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Find all products
        $products = Product::all();
        //Find all categories
        $categories = Category::all();
        //Redirecting user to admin/products/index view and pass all products and all categories
        return view('admin.products.index')->with('products', $products)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Find all categories (list all categories)
        $categories = Category::all();

        //Check if there's category already exists
        if($categories->count() == 0)
        {
            Session::flash('info', 'You must have a category before attempting to create a new product.');
            return redirect()->back();
        }

        //Redirecting user to admin/products/create view and pass all categories
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
        //Validate that product name should be filled and unique
        //Validate that product category should be chosen
        //Validate that product description should be filled
        //Validate that product price should be filled and must be numeric
        //Validate that product image should be uploaded, must be an image, and max. file size is 10000KB
        $this->validate($request, [
            'product_name'     => 'required|unique:products',
            'product_category' => 'required',
            'product_desc'     => 'required',
            'product_price'    => 'required|numeric',
            'product_image'    => 'required|image|max:10240'
        ]);

        //Saving an image by rename them and placing them on specific folder
        $image = $request->file('product_image');

        $fullImage = time().'.'.$image->getClientOriginalExtension();

        $path = public_path('/uploads/product_img/');

        $image->move($path, $fullImage);

        //Create a product and save them to the database
        $product = Product::create([
            'product_name'     => $request->product_name,
            'product_image'    => $fullImage,
            'product_category' => $request->product_category,
            'product_price'    => $request->product_price,
            'product_desc'     => $request->product_desc
        ]);

        //Notify user with pop up message
        Session::flash('success', 'Successfully created product');

        //Redirecting user to products route
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
        //Find specific product by comparing product ID
        $product = Product::find($id);
        //Find all categories
        $categories = Category::all();

        //Redirecting user to admin/products/edit view and pass a specific product and all categories
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
        //Find specific product by comparing product ID
        $product = Product::find($id);

        //Validate that product name should be filled and unique
        //Validate that product category should be chosen
        //Validate that product description should be filled
        //Validate that product price should be filled and must be numeric
        //Validate that product image should be uploaded, must be an image, and max. file size is 10000KB
        $this->validate($request, [
            'product_name'     => 'required|unique:products',
            'product_category' => 'required',
            'product_desc'     => 'required',
            'product_price'    => 'required|numeric',
            'product_image'    => 'required|image|max:10240'
        ]);

        //Validate if user upload a new image, 
        //saving an image by rename them and placing them on specific folder
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');

            $fullImage = time().'.'.$image->getClientOriginalExtension();
    
            $path = public_path('/uploads/product_img/');
    
            $image->move($path, $fullImage);

            $product->product_image = $fullImage;
        }
       
        $product->id               = $request->id;
        $product->product_name     = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_price    = $request->product_price;
        $product->product_desc     = $request->product_desc;

        //Saving product to the database
        $product->save();

        //Notify user with pop up message
        Session::flash('success', 'Successfully updated product.');

        //Redirecting user to products route
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
        //Find specific product by comparing product ID
        $product = Product::find($id);

        //Deleting specific product
        $product->delete();

        //Notify user with pop up message
        Session::flash('success', 'Successfully deleted product');

        //Redirecting user to products route
        return redirect()->route('products');
    }
}
