@extends('layouts.ViewTestimonial')
     
     @section('content')
         <div class="row">
             <div class="col-lg-12 margin-tb">
                 <div class="pull-left">
                 </div>
                 <div class="pull-right">
                     <a class="btn btn-success" href="{{ route('ViewTestimonial') }}"> Create New testimonial</a>
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
                 <th>Position</th>
                 <th>Comments</th>
                 <th>Rating</th>
                 <th width="280px">Action</th>
             </tr>
             @foreach ($testimonial as $testimonial)
             <tr>
                 <td>{{ ++$i }}</td>
                 <td><img src="/image/{{ $testimonial->image }}" width="100px"></td>
                 <td>{{ $testimonial->name }}</td>
                 <td>{{ $testimonial->position }}</td>
                 <td>{{ $testimonial->comments }}</td>
                 <td>{{ $testimonial->rating }}</td>
                 <td>
                     <form action="{{ route('deletetestimonial',$testimonial->id) }}" method="POST">
          
           
                         <a class="btn btn-primary" href="{{ route('EditTestimonial',$testimonial->id) }}">Edit</a>
          
                         @csrf
                         @method('DELETE')
             
                         <button type="submit" class="btn btn-danger">Delete</button>
                     </form>
                 </td>
             </tr>
             @endforeach
         </table>
         
      
             
     @endsection