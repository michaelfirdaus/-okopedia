@extends('layouts.app')

@section('content')

    <div class="card">
        <table class="table table-hover">
            <thead>
                <th>
                    Category Name
                </th>
                <th>
                    Editing
                </th>
                <th>
                    Delete
                </th>
            </thead>
    
            <tbody>
                @if($category->count() > 0)
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('category.edit', ['id' => $category ->id]) }}" class="btn btn-xs btn-info">
                                    <span class="fas fa-pencil-alt"></span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('category.delete', ['id' => $category ->id]) }}" class="btn btn-xs btn-danger">
                                    <span class="fas fa-trash-alt"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="3" class="text-center">No data available, try add some new category.</th>
                    </tr>
                @endif
            </tbody>
    
        </table>
    </div>
@endsection