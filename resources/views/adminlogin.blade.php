@extends('layouts.AdminLogin')

@section('content')
    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">

            <div class="col-md-12">
                @isset($url)
                    <form class="box" method="POST" action='' aria-label="{{ __('Login') }}">
                @else
                    <form class="box" method="POST" action="" aria-label="{{ __('Login') }}">
                @endisset
                        @csrf
                        <h1>Admin Login</h1>
                        <form class="user">
                        <div class="form-group">
                        <input type="email" name="email"class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                        </div>
                        <div class="form-group">
                        <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword"name="password" required placeholder="Password">
                        </div>
                        <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                        <input type="checkbox"  class="custom-control-input" id="customCheck" name="remember"{{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                        <input type="submit" class="btn btn-primary btn-user btn-block"name="" value="Login">
                        </div>
                        </div>
                        </form >
                        @if (isset($url) && $url == 'vendor')
                        <a href="{{ route('reset.vendor') }}">Lost your password?</a> <br /><br />
                        <a href="{{ route('register.vendor') }}">Create an account</a>
                        @endif
                    </form>
            </div>
        </div>
    </div>
@endsection