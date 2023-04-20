@extends('layouts.EditAdmin')  
@section('content')  
<form method="Post" action="{{route('update',$crud->id)}}">  
     
 @csrf     
          <div class="form-group">      
              <label for="first_name"> Name:</label><br/><br/>  
              <input type="text" class="form-control" name="name" value={{$crud->name}}><br/><br/>  
          </div>  
  
<div class="form-group">      
              <label for="first_name">Email:</label><br/><br/>  
              <input type="text" class="form-control" name="email" value={{$crud->email}}><br/><br/>  
          </div>  
  
<button type="submit" class="btn-btn" >Update</button>  
@if (session('error'))
                               <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                               <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
</form>  
  
  
@endsection  