@extends('layout/layout')
@section('spacework')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4> List of Users Post
                            </h4>
                        </div>
                            <div class="card-body">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                    <th> ID </th>
                                    <th> Title </th>
                                    <th> Description</th>
                                    <th> File</th>
                                    <th > Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                    
                                    <tr>
                                        <td> {{ $post->id }}</td>
                                        <td> {{ $post->title }}</td>
                                        <td> {{ $post->description }}</td>
                                        <td> {{ $post->filename }}</td>
                                        <td>  
                                            <a href="{{ url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-success"> Add / Edit permission</a>
                            
                                            <a href="{{ url('roles/'.$role->id.'/edit')}}" class="btn btn-success"> Edit</a>
                                        
                                            <a href="{{ url('roles/'.$role->id.'/delete')}}" class="btn btn-danger"> Delete</a>
                                            
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