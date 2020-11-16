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
        
        @foreach($products as $product)
        <div class="col-md-12">
            <div class="card card-body col-md-7 m-3">
                <img src="{{ url($product->product_image) }}" alt="{{ $product->product_name }}" width="312px" height="200px" class="ml-1 mx-auto d-block rounded p-0">
                <div class="card-header m-2">
                    {{$product->product_name}}
                    <br>
                    {{$product->product_price}}
                    <br>
                    {{$product->category->name}}
                </div>  
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-success">Product Detail</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">{{$products->links()}}</div>

    </div>
</div>
@endsection
