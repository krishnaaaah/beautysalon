@extends('layouts.ViewTeam')
     
     @section('content')
         <div class="row">
             <div class="col-lg-12 margin-tb">
                 <div class="pull-left">
                 </div>
                 <div class="pull-right">
                     <a class="btn btn-success" href="{{ route('ViewTeam') }}"> Create New Team Member</a>
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
                 <th width="280px">Action</th>
             </tr>
             @foreach ($team as $team)
             <tr>
                 <td>{{ ++$i }}</td>
                 <td><img src="{{ asset('/image/'.$team->image) }}" width="100px"></td>
                 <td>{{ $team->name }}</td>
                 <td>{{ $team->position }}</td>
                 <td>
                     <form action="{{ route('deleteteam',$team->id) }}" method="POST">
          
           
                         <a class="btn btn-primary" href="{{ route('EditTeam',$team->id) }}">Edit</a>
          
                         @csrf
                         @method('DELETE')
             
                         <button type="submit" class="btn btn-danger">Delete</button>
                     </form>
                 </td>
             </tr>
             @endforeach
         </table>
         
      
             
     @endsection