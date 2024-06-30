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
        <form action="{{ route('departments.update', $department->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="name">Department name</label>
            <input type="text" class="form-control" id="name" name="name"
              value="{{ $department->name }}" required>
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