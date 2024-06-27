@extends('layout.layout')

@section('space-work')
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('posts.index') }}>All Post</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('posts.create') }}>Add Post</a>
        </div>
      </div>
    </div>
  </nav>
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <h3>Update Post</h3>
        <form action="{{ route('posts.update', $post->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
              value="{{ $post->title }}" required>
          </div>
          <div class="form-group">
            <label for="body">Description</label>
            <textarea class="form-control" id="body" name="body" rows="3" required>{{ $post->body }}</textarea>
          </div>
          <div class="form-group">
            <label for="file">File</label>
            <input type="file" name="file" required>
          </div>
          <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
        </form>
      </div>
    </div>
  </div>
@endsection