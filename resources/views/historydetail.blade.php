@extends('layouts.app')

@section('content')
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">Your Transaction History Detail</div>
                    <div class="card-body">
                        @foreach($details as $detail)
                            <div class=" mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-3 my-4 mx-4">
                                        <img src="{{ url($detail->product->product_image) }}" alt="{{ $detail->product->product_name }}" class="card-img">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title font-weight-bold">
                                                {{ $detail->product->product_name }}
                                            </h5>
                                            <p class="card-text text-secondary">
                                                Price : <span class="font-weight-bold">IDR {{ $detail->product->product_price }}</span>
                                            </p>
                                            <small class="text-muted">
                                                Quantity : {{ $detail->qty }}
                                            </small>
                                            <h5 class="font-weight-bold my-3 text-secondary">Total Price : IDR {{ ($detail->qty * $detail->product->product_price) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <h4 class="card-footer">Grand Total : <span class="font-weight-bold text-secondary">IDR {{ $grandtotals }}</span></h4>
            </div>
        </div>
    </div>

@endsection
