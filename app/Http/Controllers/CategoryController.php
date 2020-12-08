<?php

namespace App\Http\Controllers;

use Session;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //This controller should be accessible only by authenticated user
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Redirecting user to admin/categories/index view with all category (listing all category)
        return view('admin.categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Redirecting user to admin/categories/index view
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation to make sure name field should be filled and the category must be unique
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category = new Category;

        $category->name = $request->name;
        //Saving current category to the database
        $category->save();

        //Notify user with pop up message
        Session::flash('success', 'Successfully created category');

        //Redirecting user to categories route
        return redirect()->route('categories');

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
        //Find category based on category ID
        $category = Category::find($id);

        //Redirecting user to admin/categories/edit view with the specific category
        return view('admin.categories.edit')->with('category', $category); 
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
        //Find category based on category ID
        $category = Category::find($id);
        
        $category->name = $request->name;
        
        //Save the category to the database
        $category->save();

        //Notify user with pop up message
        Session::flash('success', 'Successfully updated category');

        //Redirecting user to categories route
        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find category based on category ID
        $category = Category::find($id);

        //Delete category
        $category->delete();

        //Notify user with pop up message
        Session::flash('success', 'Successfully deleted category');

        //Redirecting user to categories route
        return redirect()->route('categories');
    }
}
