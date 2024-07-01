@extends('layout/layout')

@section('space-work')

    <h2 class="mb-4">Users</h2>
    @if(session('status'))
    <div class="alert alert-success">{{ session('status')}}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error')}}</div>
@endif

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th> Department</th>
            <th> Delete User</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @php
                 $role=App\Models\Role::all();   
                @endphp
                <td>
                    <form action="{{ route('users.change_role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}" >
                        <select id="exampleMultiSelect" name="role_id" class="form-control" onchange="this.form.submit()">
                            <option value="" selected disabled>Select Role</option>
                            @foreach($role as $r)
                            <option value="{{$r->id}}" @if($user->role_id == $r->id) selected @endif>{{$r->name}}</option>

                            @endforeach
                          
                        </select>
                    </form>    
                </td>
                @php
                 $department=App\Models\Department::all();   
                //  $departmentPost
                @endphp
                <td>
                    <form action="{{ route('users.change_department') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <select  name="department_id" class="form-control" onchange="this.form.submit()">
                            <option selected disabled > Select Department</option>
                            @foreach($department as $dept)
                                <option value="{{$dept->id}}" 
                                    @if ($dept->id == $user->department_id)
                                        selected 
                                    @endif 
                                    {{-- (is_array(json_decode($user->department_id)) && in_array($dept->id, json_decode($user->department_id))) --}}
                                >
                                    {{$dept->name}}
                                </option>
                            @endforeach
                        </select>
                        {{-- <button type="submit"> 
                            Save
                        </button> --}}
                        
                    </form>    
                </td>
                <td>
                    <form action="{{ route('superadmin.destroy') }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
