@extends('layouts.app')

@section('content')
    <h1 class="text-center  my-3"> Blog Settings

    </h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
    
            <div class="card card-default">
                <div class="card-header">
                    Edit Blog Settings
        
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('settings.update')}}" method="POST" >
                        @csrf
                        <div class="form-group my-2">
                            <label for="site_name"> Site Name </label>
                            <input type="text" class="form-control" value="{{ $setting->site_name }}" placeholder=" Site name" name="site_name">
                        </div>
                        <div class="form-group my-2">
                            <label for="contact_email"> Contact Email </label>
                            <input type="email" class="form-control" value="{{ $setting->contact_email }}" placeholder=" hehehe@example.com" name="contact_email">
                        </div>
                        
                        <div class="form-group my-2">
                            <label for="address"> Address </label>
                            <input type="text" class="form-control" value="{{ $setting->address }}" placeholder="" name="address">
                        </div>
                        <div class="form-group my-2">
                            <label for="contact_number"> Contact Number </label>
                            <input type="tel" class="form-control" value="{{ $setting->contact_number }}" placeholder=" " name="contact_number">
                        </div>
                        
                        <div class="form-group float-end" >
                            <button type="submit" class="btn btn-success">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>
    </div>

@endsection