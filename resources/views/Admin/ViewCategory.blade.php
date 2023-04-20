@extends('layouts.ViewCategory')
     
     @section('content')
         <div class="row">
             <div class="col-lg-12 margin-tb">
                 <div class="pull-left">
                 </div>
                 <div class="pull-right">
                     <a class="btn btn-success" href="{{ route('ViewCategory') }}"> Create New Product</a>
                 </div>
             </div>
         </div>
         
         @if ($message = Session::get('success'))
             <div class="alert alert-success">
                 <p>{{ $message }}</p>
             </div>
         @endif
          
         <table class="table table-bordered">
             <tr>
                 <th>No</th>
                 <th>Image</th>
                 <th>Name</th>
                 <th>Details</th>
                 <th width="280px">Action</th>
             </tr>
             @foreach ($category as $category)
             <tr>
                 <td>{{ ++$i }}</td>
                 <td><img src="/image/{{ $category->image }}" width="100px"></td>
                 <td>{{ $category->name }}</td>
                 <td>{{ $category->description }}</td>
                 <td>
                     <form action="{{ route('deletecategory',$category->id) }}" method="POST">
          
           
                         <a class="btn btn-primary" href="{{ route('EditCategory',$category->id) }}">Edit</a>
          
                         @csrf
                         @method('DELETE')
             
                         <button type="submit" class="btn btn-danger">Delete</button>
                     </form>
                 </td>
             </tr>
             @endforeach
         </table>
         
      
             
     @endsection