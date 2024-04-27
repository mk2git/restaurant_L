<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Table;
use App\Models\Reserve;
use App\Models\Order;
use App\Models\Takeout_Order;
use App\Models\Checkout;
use App\Models\Takeout_Checkout;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = User::where('role')->get();

        $totalSeats = Table::all()->count();
        $unusedSeats = Table::where('status', config('table.未使用'))->count();
        $usingSeats = Table::where('status', config('table.使用中'))->count();

        $todayReserves = Reserve::orderBy('time', 'asc')->whereDate('date', today())->get();

        $orders = Order::where('status', config('order.cooking'))->distinct()->pluck('table_id')->count();
        $takeout_orders = Takeout_Order::where('status', config('takeout_order.cooking'))->distinct()->pluck('takeout_id')->count();
        $total_orders = 0;
        $total_orders = $orders + $takeout_orders;
  
        $checkouts = Checkout::where('check_status', config('check.not yet'))->distinct()->pluck('table_id')->count();
        $takeout_checkouts = Takeout_Checkout::where('check_status', config('takeout_checkout.not yet'))->distinct()->pluck('takeout_id')->count();
        $total_checkouts = 0;
        $total_checkouts = $checkouts + $takeout_checkouts;

        // dd($checkouts);
    
        return view('dashboard', compact('role','total_orders', 'totalSeats', 'unusedSeats', 'usingSeats', 'todayReserves', 'total_checkouts'));
    }
}
