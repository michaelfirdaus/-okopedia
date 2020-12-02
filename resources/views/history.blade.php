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
        @foreach($histories as $history)
            <div class="col-md-12 @if (!$loop->first) my-3 @endif">
                <div class="card">
                    <div class="card-header bg-success text-white">
                    Transaction History
                    </div>
                    <div class="card-body">
                    <a href="{{ route('user.transaction.history.detail', $history->id) }}" class="text-secondary">{{ $history->created_at }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
