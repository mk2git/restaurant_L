<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Takeout_Order;
use App\Models\Takeout;

class ServeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table_ids = Order::where('check_status', 'not yet')->distinct()->get('table_id');
        $order_tables = Table::whereIn('id', $table_ids)->select('id', 'name')->get();
        $orders = Order::all();

        $takeout_order_ids = Takeout_Order::where('check_status', 'not yet')->whereDate('created_at', today())->distinct()->get('takeout_id');
        $takeout_order_names = Takeout::whereIn('id', $takeout_order_ids)->select('id', 'name')->get();
        $takeout_orders = Takeout_Order::whereDate('created_at', today())->get();
        $confirm_table_orders = Order::whereDate('created_at', today())->where('check_status', 'not yet')->get();
        $confirm_takeout_orders = Takeout_Order::whereDate('created_at', today())->where('check_status', 'not yet')->get();

        return view('serve.index', compact('order_tables', 'orders', 'takeout_order_names', 'takeout_orders', 'confirm_table_orders', 'confirm_takeout_orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        $order = Order::find($request->order_id);
        // dd($order);
        $order->status = 'done';
        $order->save();
        $message = '「'.$order->menu->name.'」の配膳を確認しました';
        return redirect()->route('serve.index')->with(['message' => $message, 'type' => 'success']);
    }

}
