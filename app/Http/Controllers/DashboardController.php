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

        $table = new Table();
        $reserve = new Reserve();
        $order = new Order();
        $checkout = new Checkout();
        $takeout_order = new Takeout_Order();
        $takeout_checkout = new Takeout_Checkout();

        $totalSeats = $table->totalSeats();
        $unusedSeats = $table->unusedSeats();
        $usingSeats = $table->usingSeats();

        $todayReserves = $reserve->todayReserves();

        $count_orders = $order->countOrders();
        $count_takeout_orders = $takeout_order->countTakeoutOrders();
        $count_total_orders = 0;
        $count_total_orders = $count_orders + $count_takeout_orders;
  
        $count_checkouts = $checkout->countCheckouts();
        $count_takeout_checkouts = $takeout_checkout->countTakeoutCheckouts();
        $count_total_checkouts = 0;
        $count_total_checkouts = $count_checkouts + $count_takeout_checkouts;

        // dd($checkouts);
    
        return view('dashboard', compact('role','count_total_orders', 'totalSeats', 'unusedSeats', 'usingSeats', 'todayReserves', 'count_total_checkouts'));
    }
}
