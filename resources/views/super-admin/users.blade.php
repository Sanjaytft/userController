@extends('layout/layout')

@section('space-work')

    <h2 class="mb-4">Users</h2>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th> Delete User</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->roles == null)
                        User
                    @else

                    {{ $user->roles->name }}

                    @endif
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
