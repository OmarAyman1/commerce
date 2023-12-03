<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request){
        // $currentDate = Carbon::now();
        // $orders = Order::whereDate('created_at', $currentDate)->paginate(10);

        $currentDate = Carbon::now();
        $orders = Order::when($request->date != null , function ($query) use ($request){
                            return $query->whereDate("created_at", $request->date);
                        }, function ($query) use ($currentDate) {
                            return $query->whereDate('created_at', $currentDate);
                        })
                        ->when($request->status != null , function ($query) use ($request){
                            return $query->where("status_message", $request->status);
                        })
                        ->paginate(10);


        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId){
        $order = Order::where('id', $orderId)->first();
        if($order){
            return view('admin.orders.view', compact('order'));
        }else{
            return redirect('admin/orders')->with('message','order not fpund');
        }
    }
}
