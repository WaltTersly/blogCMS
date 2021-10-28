@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
               <b>
                Published Posts
               </b> 
    
            </div>
            <table class="table table-hover">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Trashing
                    </th>
                </thead>
        
                <tbody>
                    @if ($posts->count() > 0)
                        
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ $post->image}}" alt="{{ $post->title}}" width="100px" height="70px">
                                
                            </td>
                            <td>
                                {{ $post->title}}
                            </td>
                            <td>
                                <a href="{{ route('post.edit', ['id' => $post->id])}}" class="btn btn-sm btn-info">
                                    <span class="fas fa-edit"> EDIT</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('post.delete', ['id' => $post->id])}}" class="btn btn-sm btn-danger">
                                    <span class="fa fa-trash"> TRASH</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <th colspan="5" class="text-center"> No Posts Available</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection