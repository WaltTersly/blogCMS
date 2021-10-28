@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-header">
                <b>
                    Available Tags
                </b>
    
            </div>
            <table class="table table-hover">
                <thead>
                    <th>
                        Tag Name
                    </th>
                    <th>
                        Editing
                    </th>
                    <th>
                        Deleting
                    </th>
                </thead>
        
                <tbody>
                    @if ($tags->count() > 0)
                        
                    @foreach ($tags as $tag)
                        <tr>
                            <td>
                                {{ $tag->tag}}
                            </td>
                            <td>
                                <a href="{{ route('tag.edit', ['id' => $tag->id])}}" class="btn btn-sm btn-info">
                                    <span class="fas fa-edit"> EDIT</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('tag.delete', ['id' => $tag->id])}}" class="btn btn-sm btn-danger">
                                    <span class="fa fa-trash"> DEL</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <th colspan="5" class="text-center"> No Tags Made</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection