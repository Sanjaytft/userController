@extends('layout.layout')

@section('space-work')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
              @if(session('status'))
                  <div class="alert alert-success">{{ session('status')}}</div>
              @endif
          <div class="card mt-3">
              <div class="card-header">
                  <h4> List of Users Roles
                  <a href={{ route('posts.index') }} class="btn btn-primary float-end"> List of Posts</a>
                  </h4>
              </div>
                  <div class="card-body">
                  <table class="table table-bordered table-stripped">
                      <thead>
                          <tr>
                          <th> ID </th>
                          <th> Title </th>
                          <th> Description <th>
                          <th > File </th>
                          <th> Status</th>
                          <th > Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($posts as $post)
          
                          <tr>
                              <td> {{ $post->id }}</td>
                              <td> {{ $post->title }}</td>
                              <td> {{ $post->description }}</td>
                              <td> {{ $post->file }}</td>
                              <td>
                                <a href="" class="btn btn-sm btn- {{ $post->status ? 'sucess' : 'danger' }}">
                                  {{ $post->status ? 'Active' : 'Deactive' }}
                                  </a>
                              </td>
                              {{-- //resources route follow this structure --}}
                              {{-- <td>  @if(!empty ($role->getPermissionNames()))
                                  @foreach($user->getPermissionNames() as $permissionname)
                                  <label class="'badge badge-primary mx-1"> {{ $permissionname}} </label>
                                  @endforeach
                                  @endif </td>
                              <td>  --}}
                                  {{-- @role(super-admin) --}}
                                  <td>
                                  <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success"> Edit</a>
                              
                                  <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger"> Delete</a>
                                  {{-- @endrole --}}
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>

                  </div>

              </div>
          </div>
      </div>
  </div>
</div>
 @endsection