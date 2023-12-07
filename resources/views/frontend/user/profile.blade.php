@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>profile
                    <a href="{{url('change-password')}}" class="btn btn-warning">Change password?</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>

            <div class="col-md-10">
                @if (session('message'))
                    <p class="alert alert-success">{{session('message')}}</p>
                @endif

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">user details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('profile')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>username</label>
                                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>email</label>
                                        <input type="text" readonly  value="{{Auth::user()->email}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>phone</label>
                                        <input type="text" name="phone" value="{{Auth::user()->userDetail->phone ?? ''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>pin code</label>
                                        <input type="text" name="pin_code" value="{{Auth::user()->userDetail->pin_code ?? ''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>address</label>
                                        <textarea rows="3" name="address" class="form-control">{{Auth::user()->userDetail->address ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">save data</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
