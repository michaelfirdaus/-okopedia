@extends('layouts.app')

@section('content')
<div class="card mt-4 mb-4">
    <div class="card-header font-weight-bold">Update {{ $cart->product->product_name }} Product</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="col">
            <div class="m-4">
                <img src="{{ asset($cart->product->product_image) }}" alt="{{ $cart->product->product_name }}" class="img-thumbnail" width="300">
                <div class="my-2">
                    <h4 class="text-primary font-weight-bold my-3">{{$cart->product->product_name}}</h4>
                    <p class="text-secondary">IDR {{$cart->product->product_price}}</p>
                </div>
                
                <form action="{{ route('user.cart.update', $cart->id) }}" method="post">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="col-md-3">
                            Qty : <input type="number" id="qty" name="qty" placeholder="Qty" value="{{ $cart->qty }}" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success my-3">Update Qty</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection


