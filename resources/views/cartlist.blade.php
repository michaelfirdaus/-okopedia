@extends('layouts.app')

@section('searchbox')
<form action="/search" method="POST" role="search" class="d-flex justify-content-end">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q"
            placeholder="Search anything..." size="40"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="fas fa-search"></span>
            </button>
        </span>
    </div>
</form>
@endsection

@section('content')
    <div class="row">
        @foreach($carts as $cart)
            <div class="col-md-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-3 my-4 mx-4">
                            <img src="{{ url($cart->product->product_image) }}" alt="{{ $cart->product->product_name }}" class="card-img">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">
                                    {{ $cart->product->product_name }}
                                </h5>
                                <p class="card-text text-secondary">
                                    Price : <span class="font-weight-bold">{{ $cart->product->product_price }}</span>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Quantity : {{ $cart->qty }}
                                    </small>
                                </p>
                                <form method="POST" action="{{ route('cart.destroy', $cart->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</a>
                                </form>

                                {{-- <a href="" class="btn btn-success">Edit</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($carts->count() > 0)
            <a href="" class="btn btn-danger mx-3">Checkout</a>
        @endif
    </div>
@endsection
