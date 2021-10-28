@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-default table-responsive-md ">
            <div class="card-header">
                <b>
                    Trashed Posts
                </b>
    
            </div>
            <table class="table table-hover ">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Restore
                    </th>
                    <th>
                        Delete 
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
                                <a href="{{ route('post.restore', ['id' => $post->id])}}" class="btn btn-sm btn-success">
                                    <span class="fas fa-trash-restore-alt"> RESTORE</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('post.kill', ['id' => $post->id])}}" class="btn btn-sm btn-danger">
                                    <span class="fas fa-trash"> DELETE</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="5" class="text-center"> No Trashed Posts</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection