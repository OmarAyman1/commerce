<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function updateOrderStatus(int $orderId, Request $request){
        $order = Order::where('id', $orderId)->first();
        if($order){
            $order->update([
                'status_message'=> $request->order_status,
            ]);
            return redirect('admin/orders/'.$orderId)->with('message','order status updated');
        }else{
            return redirect('admin/orders/'.$orderId)->with('message','order not fpund');
        }
    }


    public function viewInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $todayDate = Carbon::now()->format('d-m-y');

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-'.$orderId.'-'.$todayDate.'.pdf');
    }
}
