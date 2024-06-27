@extends('welcome')
@section ('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    @if(Session::has('error'))
        <p style="color:red;">{{ Session::get('error') }}</p>
    @endif
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="name"> User Email </label> 
                            <input type="email" name="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="name"> Password </label> 
                            <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <input type="submit" value="Login">

                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
