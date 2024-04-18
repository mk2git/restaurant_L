<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;
use App\Models\Menu;

class ServeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table_ids = Order::where('check_status', 'not yet')->distinct()->get('table_id');
        // dd($table_ids);
        $order_tables = Table::whereIn('id', $table_ids)->select('id', 'name')->get();

        $orders = Order::all();

        // $checkTables = Order::where('status', 'done')->distinct()->get();
        // dd($checkTables);
        return view('serve.index', compact('order_tables', 'orders'));
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
