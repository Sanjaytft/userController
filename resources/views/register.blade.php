@extends('welcome')
@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="name"> User Name </label> 
                            <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            <div class="mb-3">
                            <label for="name"> Email</label> 
                            <input type="email" name="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name"> Password </label> 
                            <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name"> Conform Password </label> 
                            <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" class="form-control">
                            </div>
                            <input type="submit" value="Register">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    @if(Session::has('success'))
        <p style="color:green;">{{ Session::get('success') }}</p>
    @endif
  @endsection  