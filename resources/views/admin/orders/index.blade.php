@extends('layouts.admin')

@section('title', 'orders')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Orders</h3>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>filter by date</label>
                            <input type="date" name="date" value="{{Request::get('date') ?? date('d-m-y')}}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>filter by status</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected':''}}>In progress</option>
                                <option value="completed" {{Request::get('status') == 'completed' ? 'selected':''}}>Completed</option>
                                <option value="pending" {{Request::get('status') == 'pending' ? 'selected':''}}>Pending</option>
                                <option value="cancelled" {{Request::get('status') == 'cancelled' ? 'selected':''}}>Cancelled</option>
                                <option value="out-for-delivery" {{Request::get('status') == 'out-for-delivery' ? 'selected':''}}>Out for delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>tracking No</th>
                                    <th>username</th>
                                    <th>payment mode</th>
                                    <th>order date</th>
                                    <th>status message</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->fullname}}</td>
                                        <td>{{$item->payment_mode}}</td>
                                        <td>{{$item->created_at->format('d-m-y')}}</td>
                                        <td>{{$item->status_message}}</td>
                                        <td><a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"> no orders available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

@endsection
