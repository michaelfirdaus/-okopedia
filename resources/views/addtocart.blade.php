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
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="col">
            <div class="card card-body m-3">
                <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}" width="512px" height="300px" class="ml-1 mx-auto d-block rounded p-0">
                <div class="card-header m-2">
                    <div class="row m-1">
                        {{$product->product_name}}
                    </div>
                    <div class="row m-1">
                        {{$product->product_price}}
                    </div>
                    <div class="row mt-1 ml-1 mb-1">
                        Category : <div class= "ml-1">{{$product->category->name}}</div>
                    </div>
                    <div class="row m-1">
                        {{$product->product_desc}}
                    </div>
                    <form action="{{ route('cart.store', ['id' => $product->id]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row m-1">
                            <input type="number" id="qty" name="qty" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Add To Cart</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>

    </div>
</div>
@endsection
