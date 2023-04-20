@extends('layouts.SalonInfo')
  
@section('content')
 
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
<form action="{{ route('SalonInfo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
     <div class="row">
         
        <div class="col-xs-12 col-sm-12 col-md-12">
     
        <div class="form-group">
                <strong>About Salon:</strong>
                <textarea class="form-control" style="height:150px" name="aboutsalon" placeholder="About Salon"></textarea>
            </div>
        </div>
         
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
                @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        </div>
    </div>
     
</form>
@endsection