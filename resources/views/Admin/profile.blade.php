@extends('layouts.Profile')

@section('content')
<h1>Admin Profile</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
            <form class="user" method="POST" action="">
                @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="{{ __('Enter your Name') }}"class="form-control form-control-user"
                                  id="exampleInputEmail" aria-describedby="emailHelp"
                                  value="{{ $admin->name }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{ __('Enter your email-address') }}"class="form-control form-control-user"
                                  id="exampleInputEmail" aria-describedby="emailHelp"
                                  value="{{ $admin->email }}" required autofocus>
                            </div>
                           <div class="form-group">
                           
                           <input type="submit" name="" value="Save" class="btn btn-primary btn-user btn-block">

                           </div>
                           
                           @if (session('error'))
                               <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if (session('success'))
                               <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                    </form>
            </div>
        
        </div>
    
    </div>
                        
                        
@endsection