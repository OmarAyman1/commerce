@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-header">
                <h3>Add sliders
                    <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{url('admin/sliders')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Tile</label>
                        <input type="text" name="title" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"  rows="3"></textarea>

                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label>status</label> <br/>
                        <input type="checkbox" name="status"/>checked=hidden
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
