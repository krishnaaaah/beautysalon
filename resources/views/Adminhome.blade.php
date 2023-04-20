@extends('layouts.AdminHome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('AdminDashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div>
                    <form action="{{route('admin_logout')}}" method="POST">
                        @csrf
                    <input type="submit" value="logout" name="" >

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection