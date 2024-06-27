@extends('layout.layout')

@section('space-work')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4>Edit Document Post</h4>
                  <a href="{{ url('/')}}" class="btn btn-danger float-end">Go Back</a>
                  <div class="card-body">
                  <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" name="description"  required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="file">File</label>
                      <input type="file" name="file" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                  </form>
                  </div>
              </div>
    </div>
  </div>
</div>

@endsection