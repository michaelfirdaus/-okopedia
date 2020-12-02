<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\History;
use App\DetailHistory;
use Session;

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
        $product = Cart::where('product_id', $request->id)->first();

        if($product != null)
        {
            $product->update([
                'user_id' => $request->user()->id,
                'product_id' => $request->id,
                'qty' => (int) $product->qty + $request->qty
            ]);
        }
        else{
            Cart::create([
                'user_id' => $request->user()->id,
                'product_id' => $request->id,
                'qty' => $request->qty
            ]);
        }

        Session::flash('success', 'Successfully add product to cart');

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
        $carts = Cart::where('user_id', $request->user()->id)
            ->with('product')
            ->get();
        
        return view('listcart', compact('carts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        Session::flash('success', 'Successfully remove product from cart');

        return redirect()->route('home');
    }

    public function checkout(Request $request)
    {
        $carts = Cart::where('user_id', $request->user()->id)->with('product')->get();

        $total = 0;

        foreach($carts as $cart)
        {
            $total += (int) $cart->product->product_price * $cart->qty;
        }

        $history = History::create([
            'user_id' => $request->user()->id,
            'total'   => $total
        ]);

        foreach($carts as $cart)
        {
            DetailHistory::create([
                'history_id' => $history->id,
                'product_id' => $cart->product->id,
                'qty'        => $cart->qty,
                'total'      => (int) $cart->qty * $cart->product->product_price
            ]);

            $cart->delete();
        }

        Session::flash('success', 'Transaction success');

        return redirect()->route('home');
    }
}
