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
                    
        <form action="{{ route('posts.update', $post->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"
              value="{{ $post->title }}" required>
          </div>
          <div class="mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" value="{{ $post->title }}" required>{{ $post->description }}</textarea>
          </div>
          <div class="mb-3">
            <label for="file">File</label>
            <input type="file" name="file" value="{{ $post->file }}" required>
          </div>
          <button type="submit" class="btn mt-3 btn-primary">Update Post</button>
        </form>
      </div>

    </div>
</div>
</div>
</div>
</div>
@endsection