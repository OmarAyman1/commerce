@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-md-12 ">
        @if (Session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Colors
                    <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text-white float-end">Add colors</a>
                </h3>
            </div>

            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@endsection
