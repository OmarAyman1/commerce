<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminat\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        $totalAllUsers = User::count();
        $totalAdmins = User::where('role_as','1')->count();
        $totalUsers = User::where('role_as','0')->count();

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at',$todayDate)->count();
        $monthOrders = Order::whereMonth('created_at',$thisMonth)->count();
        $yearOrders = Order::whereMonth('created_at',$thisYear)->count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalBrands',
                                             'totalAllUsers', 'totalAdmins', 'totalUsers',
                                              'totalOrders', 'todayOrders', 'monthOrders', 'yearOrders'));
    }
}
