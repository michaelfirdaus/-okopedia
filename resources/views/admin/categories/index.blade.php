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
            </tbody>
    
        </table>
    </div>
@endsection