@extends('layouts.ViewAdmin')  
@section('content')  
<thead>  
<tr>  
<td>  
Name</td>  
<td>  
Email </td>  
 <td>Action</td>
</tr>  
</thead>  
<tbody>  
@foreach($cruds as $crud)  
        <tr>  
              
            <td>{{$crud->name}}</td>  
            <td>{{$crud->email}}</td>  
            
<td >  
<form action=" {{route('delete',$crud->id)}}" method="post">  
                  @csrf  
                  @method('DELETE')  
                  <button class="btn btn-danger" type="submit">Delete</button>  
                </form>  

<form action=" {{route('EditAdmin',$crud->id)}}" method="GET">  
                  @csrf  
                   
                  <button class="btn btn-danger" type="submit">Edit</button>  
                </form>  
</td>  
  
         </tr>  
@endforeach  
</tbody>  
  
@endsection  