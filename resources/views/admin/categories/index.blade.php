@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-header">
                <b>
                    Available Categories
                </b>
    
            </div>
            <table class="table table-hover">
                <thead>
                    <th>
                        Category Name
                    </th>
                    <th>
                        Editing
                    </th>
                    <th>
                        Deleting
                    </th>
                </thead>
        
                <tbody>
                    @if ($categories->count() > 0)
                        
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name}}
                            </td>
                            <td>
                                <a href="{{ route('category.edit', ['id' => $category->id])}}" class="btn btn-sm btn-info">
                                    <span class="fas fa-edit"> EDIT</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('category.delete', ['id' => $category->id])}}" class="btn btn-sm btn-danger">
                                    <span class="fa fa-trash"> DEL</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <th colspan="5" class="text-center"> No categories Made</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection