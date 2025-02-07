@extends('layouts.app')

@section('content')
<div class="card mt-4 mb-4">
    <div class="card-header font-weight-bold">Add {{$product->product_name}} To Cart</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="col">
            <div class="card card-body m-4">
                <img src="{{ asset('uploads/product_img/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="img-thumbnail rounded mx-auto d-block" width="300">
                <div class="my-2">
                    <h4 class="text-primary font-weight-bold my-3">{{$product->product_name}}</h4>
                    <p class="text-secondary">IDR {{$product->product_price}}</p>
                    <p>Category : <span class="text-primary">{{$product->category->name}}</span></p>
                    <p>Description : {{ $product->product_desc }}</p>
                </div>
                
                <form action="{{ route('user.cart.store', ['id' => $product->id]) }}" method="post">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="col-md-3">
                            <span class="ml-1">Qty :</span>
                            <input type="number" id="qty" name="qty" placeholder="Qty" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 btn-block">Add To Cart</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection


