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
            <div class="card card-body m-4">
                <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}" class="img-thumbnail" width="300">
                <div class="my-2">
                    <h4 class="text-primary font-weight-bold my-3">{{$product->product_name}}</h4>
                    <p class="text-secondary">IDR {{$product->product_price}}</p>
                    <p class="text-info">{{$product->category->name}}</p>
                </div>
                <a href="{{ route('user.cart.create', ['id' => $product->id]) }}" class="btn btn-info">Add to Cart</a>
            </div>
        </div>

    </div>
</div>
@endsection
