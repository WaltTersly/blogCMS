@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
               <b>
                Registered Users
               </b> 
    
            </div>
            <table class="table table-hover">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Permissions
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
        
                <tbody>
                    @if ($users->count() > 0)
                        
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name}}" width="100px" height="70px" style="border-radius: 50%">
                                
                            </td>
                            <td>
                                {{ $user->name}}
                            </td>
                            <td>
                               @if ($user->admin)
                                   admin
                                   <a href="{{ route('user.not.admin', ['id' => $user->id])}}" class="btn btn-sm btn-warning">
                                    <span class="fas fa-user-shield"> Revoke Privileges </span> </a>
                               @else
                                   not admin
                                   <a href="{{ route('user.admin', ['id' => $user->id])}}" class="btn btn-sm btn-success">
                                    <span class="fas fa-user-shield"> Make Admin </span> </a>
                               @endif
                            </td>
                            <td>
                                {{-- ensuring that no one can destroy there own profile even though they are admins --}}
                                @if ( Auth::id() !== $user->id )
                                    
                                <a href="{{ route('user.delete', ['id' => $user->id])}}" class="btn btn-sm btn-danger">
                                    <span class="fa fa-trash"> DELETE</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <th colspan="5" class="text-center"> No Users Registered</th>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection