@extends('layouts.admin')

@section('title', 'add user')

@section('content')


<div class="row">
    <div class="col-md-12 ">
        @if (Session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>add user
                    <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm text-white float-end">back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/users')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>email</label>
                            <input type="text" name="email" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>password</label>
                            <input type="text" name="password" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>select role</label>
                            <select name="role_as" class="form-controle">
                                <option value="">Select role</option>
                                <option value="0">user</option>
                                <option value="1">admin</option>
                            </select>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
