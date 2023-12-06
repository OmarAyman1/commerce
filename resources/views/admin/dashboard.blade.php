@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <h6 class="alert alert-success">{{session('message')}}</h6>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Welcome back,</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
            <hr/>
        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>total orders</label>
                    <h1>{{$totalOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>today orders</label>
                    <h1>{{$todayOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>month orders</label>
                    <h1>{{$monthOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <label>year orders</label>
                    <h1>{{$yearOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>
        </div>

        <hr/>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>total products</label>
                    <h1>{{$totalProducts}}</h1>
                    <a href="{{url('admin/products')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>total Categories</label>
                    <h1>{{$totalCategories}}</h1>
                    <a href="{{url('admin/category')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>total Brands</label>
                    <h1>{{$totalBrands}}</h1>
                    <a href="{{url('admin/brands')}}" class="text-white">view</a>
                </div>
            </div>
        </div>


        <hr/>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>All users</label>
                    <h1>{{$totalAllUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>admins</label>
                    <h1>{{$totalAdmins}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>normal users</label>
                    <h1>{{$totalUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
