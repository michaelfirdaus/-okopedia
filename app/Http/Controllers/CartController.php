<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
use App\Cart;
use App\History;
use App\DetailHistory;

class CartController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::where('id', $id)
        ->with('category')
        ->first();

        //Redirecting user to addtocart view and pass a product based on it's ID
        return view('addtocart', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Find product ID
        $product = Cart::where('product_id', $request->id)->first();

        //Check if the product is already exists on the cart, update the existing
        if($product != null)
        {
            $product->update([
                'user_id' => $request->user()->id,
                'product_id' => $request->id,
                'qty' => (int) $product->qty + $request->qty
            ]);
        }

        //Check if the product isn't already exists on the cart, create new one
        else{
            Cart::create([
                'user_id' => $request->user()->id,
                'product_id' => $request->id,
                'qty' => $request->qty
            ]);
        }

        //Notify user with pop up message
        Session::flash('success', 'Successfully add product to cart');

        //Redirecting user to home view
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //Find user's cart by comparing the user ID 
        $carts = Cart::where('user_id', $request->user()->id)
            ->with('product')
            ->get();

        $grandtotals = 0;

        //Counting the grandtotal
        foreach($carts as $cart)
        {
            $grandtotals += $cart->qty * $cart->product->product_price;
        }
        
        //Redirecting user to listcart view and pass the user's cart and the grandtotal
        return view('listcart', compact('carts','grandtotals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find specific product ID that is listed on the user's cart
        $cart = Cart::where('id', $id)->with('product')->first();

        //Redirecting user to editcart view and pass the user's cart
        return view('editcart', compact('cart'));
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
        //Find the user's cart
        $cart = Cart::find($id);

        //Updating product qty and save them to the cart
        $cart->update([
            'qty' => $request->qty
        ]);

        //Notify user with pop up message   
        Session::flash('success', 'Successfully updated product quantity');

        //Redirecting user to cart lists
        return redirect()->route('user.cart.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find user's cart
        $cart = Cart::find($id);

        //Delete user's cart
        $cart->delete();

        //Notify user with pop up message
        Session::flash('success', 'Successfully removed product from cart');

        //Redirecting user to home view
        return redirect()->route('home');
    }

    //Custom function to checkout user's cart
    public function checkout(Request $request)
    {
        //Find user's cart and the product by comparing the user ID
        $carts = Cart::where('user_id', $request->user()->id)->with('product')->get();

        $total = 0;

        //Counting the total price
        foreach($carts as $cart)
        {
            $total += (int) $cart->product->product_price * $cart->qty;
        }

        //Saving the current user's transaction to the transaction history
        $history = History::create([
            'user_id' => $request->user()->id,
            'total'   => $total
        ]);

        //Saving the current user's transaction to the  user's detail transaction history
        foreach($carts as $cart)
        {
            DetailHistory::create([
                'history_id' => $history->id,
                'product_id' => $cart->product->id,
                'qty'        => $cart->qty,
                'total'      => (int) $cart->qty * $cart->product->product_price
            ]);

            //Cleaning up the current cart
            $cart->delete();
        }

        //Notify user with pop up message
        Session::flash('success', 'Successfully processed the transaction');

        //Redirecting user to home view
        return redirect()->route('home');
    }
}
