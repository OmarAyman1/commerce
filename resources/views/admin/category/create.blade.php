@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-header">
                <h3>Add Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
            <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>name</label>
                            <input type="text" name="name" class="form-control"/>
                            @error('name')<small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>slug</label>
                            <input type="text" name="slug" class="form-control"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>image</label>
                            <input type="file" name="image" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>status</label><br/>
                            <input type="checkbox" name="status" />
                        </div>
                        <div class="col-md-12">
                         <h4>seo tags</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>meta title</label>
                            <input type="text" name="meta_title" class="form-control"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>meta keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3"></textarea>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label>meta description</label>
                            <textarea name="meta_description" class="form-control" rows="3"></textarea>

                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
