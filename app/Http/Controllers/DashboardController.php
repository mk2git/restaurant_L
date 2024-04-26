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
        $orders = Order::where('status', 'cooking')->distinct()->pluck('table_id');
        if($orders){
            $count_orders = count($orders);
        }else{
            $count_orders = 0;
        }
        
        $takeout_orders = Takeout_Order::where('status', 'cooking')->distinct()->pluck('takeout_id');
        if($takeout_orders){
            $count_takeout_orders = count($takeout_orders);
        }else{
            $count_takeout_orders = 0;
        }
        $checkouts = Checkout::where('check_status', 'not yet')->distinct()->pluck('table_id');
        if($checkouts){
            $count_checkouts = count($checkouts);
        }else{
            $count_checkouts = 0;
        }
        $takeout_checkouts = Takeout_Checkout::where('check_status', 'not yet')->distinct()->pluck('takeout_id');
        if($takeout_checkouts){
            $count_takeout_checkouts = count($takeout_checkouts);
        }else{
            $count_takeout_checkouts = 0;
        }
        // dd($checkouts);
    
        return view('dashboard', compact('role', 'totalSeats', 'unusedSeats', 'usingSeats', 'todayReserves', 'count_orders', 'count_takeout_orders', 'count_checkouts', 'count_takeout_checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
