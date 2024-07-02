@extends('layout.layout')

@section('space-work')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
              @if(session('status'))
                  <div class="alert alert-success">{{ session('status')}}</div>
              @endif
              @if(session('error'))
                  <div class="alert alert-danger">{{ session('error')}}</div>
              @endif
          <div class="card mt-3">
              <div class="card-header">
                  <h4> List of Users Roles
                  <a href={{ route('posts.create') }} class="btn btn-primary float-end">Add Post</a>
                  </h4>
              </div>
                  <div class="card-body">
                  <table class="table table-bordered table-stripped">
                      <thead>
                          <tr>
                          <th> ID </th>
                          <th> Title </th>
                          <th> Description </th>
                          <th > File </th>
                          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                          <th> Status</th>
                          @endif
                          <th > Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($posts as $post)
          
                          <tr>
                              <td> {{ $post->id }}</td>
                              <td> {{ $post->title }}</td>
                              <td> {{ $post->description }}</td>

                              <td>
                                @php 
                            
                                    // Define allowed image extensions
                                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                    $extension = pathinfo(asset('file/files/' . $post->file), PATHINFO_EXTENSION);
                                    @endphp
                                    @if(in_array($extension, $allowedExtensions))
                                        <a href="{{ asset('file/images/' . $post->file) }}" target="_blank">{{ $post->file }}</a>
                                    @else
                                    <a href="{{ asset('file/files/' . $post->file) }}" target="_blank">{{ $post->file }}</a>
                                    @endif
                                
                            </td>
                              @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                              <td>
                                
                                <form action="{{ route('posts.change_status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <select name="status" class="form-control" id="" onchange="this.form.submit()">
                                        <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                                    </select>
                                </form>    
                              </td>
                              @endif
                                  <td>
                                  <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success"> Edit</a>
                                  </td>
                          @endforeach
                      </tbody>
                  </table>
                  </div>

                  </div>

              </div>
          </div>
      </div>
 @endsection