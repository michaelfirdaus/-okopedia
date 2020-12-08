@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($carts as $cart)
            <div class="col-md-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-3 my-4 mx-4">
                            <img src="{{ asset('uploads/product_img/'.$cart->product->product_image) }}" alt="{{ $cart->product->product_name }}" class="card-img">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">
                                    {{ $cart->product->product_name }}
                                </h5>
                                <p class="card-text text-secondary">
                                    Price : <span class="font-weight-bold">IDR {{ $cart->product->product_price }}</span>
                                </p>
                                <small class="text-muted">
                                    Quantity : {{ $cart->qty }}
                                </small>
                                <h5 class="font-weight-bold my-3 text-secondary">Total Price : IDR {{ ($cart->qty * $cart->product->product_price) }}</h5>
                                <div class="row d-flex justify-content-end">
                                    <form method="POST" action="{{ route('user.cart.destroy', $cart->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('user.cart.edit', $cart->id) }}" class="btn btn-success mx-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($carts->count() > 0)
        <h4 class="my-3">Grand Total : <span class="font-weight-bold text-secondary">IDR {{ $grandtotals }}</span></h4>
        <form method="POST" action="{{ route('user.cart.checkout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Checkout</a>
        </form>
        @else
        <div class="container my-5">
            <h4 class="font-weight-bold text-danger text-center">Your cart is still empty. Shop now and your product will showed up here!</h4>
        </div>
    @endif
@endsection
