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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>code</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr>
                                <td>{{$color->id}}</td>
                                <td>{{$color->name}}</td>
                                <td>{{$color->code}}</td>
                                <td>{{$color->status ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{url('admin/color'.$color->id.'/edit')}}" class="btn btn-primary btn-sm">edit</a>
                                    <a href="{{url('')}}" class="btn btn-danger btn-sm">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
