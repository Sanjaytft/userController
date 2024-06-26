<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Post</h4>
                        <a href="{{ url('user/createpost')}}" class="btn btn-danger float-end">Go Back</a>
                        <div class="card-body">
                            <form action="{{ route('createpost') }}" method="POST" enctype="multipart/form-data"> 
                                @method('POST')
                                @csrf
                                <div class="mb-3">
                                    <label for="">Post Title</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}"> 
                                    <label for="">Post Description</label>
                                    <input type="text" name="description" class="form-control" value="{{old('description')}}"> 
                                    <br> <br>
                                    <input type="file" name="filename">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit"> Save</button>
                                </div>    

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
        