@extends('layout.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            User Add
        </div>

        <div class="card-body">
            <form action="{{ route('createpost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', isset($event) ? $event->title : '') }}" required>
                    @if ($errors->has('title'))
                        <em class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </em>
                    @endif

                <div class="form-group {{ $errors->has('display') ? 'has-error' : '' }}">
                    <label for="display">Display *
                        <input type="checkbox" name="display"
                            value="1"{{ old('dispaly', isset($event) ? $event->display : '') == 1 ? 'checked' : '' }}>

                        @if ($errors->has('display'))
                            <em class="invalid-feedback">
                                {{ $errors->first('display') }}
                            </em>
                        @endif

                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', isset($event) ? $event->description : '') }}</textarea>
                    @if ($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                    @endif

                </div>

                <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                    <label for="file">file *</label>
                    <textarea id="file" name="file" class="form-control">{{ old('file', isset($event) ? $event->file : '') }}</textarea>
                    @if ($errors->has('file'))
                        <em class="invalid-feedback">
                            {{ $errors->first('file') }}
                        </em>
                    @endif

                </div>
                <div>
                    <input class="btn btn-primary" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>


        </div>
    </div>
@endsection
