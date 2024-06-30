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
                  <h4> List of Departments
                  <a href={{ route('departments.create') }} class="btn btn-primary float-end">Add Departmentst</a>
                  </h4>
              </div>
                  <div class="card-body">
                  <table class="table table-bordered table-stripped">
                      <thead>
                          <tr>
                          <th> ID </th>
                          <th> Name </th>
                          <th > Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($departments  as $department)
          
                          <tr>
                              <td> {{ $department->id }}</td>
                              <td> {{ $department->name }}</td>
                                   <td>
                                  <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-success"> Edit</a>
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
 @endsection