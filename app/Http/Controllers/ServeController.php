<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Takeout_Order;
use App\Models\Takeout;
use Illuminate\Support\Facades\DB;

class ServeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = new Order();
        $table = new Table();
        $takeout = new Takeout();
        $takeout_order = new Takeout_Order();

        $table_ids = $order->getTableId();
        $order_tables = $table->getOrderTables();
        $orders = $order->getOrders();

        $takeout_order_names = $takeout->getNames();
        $takeout_orders = $takeout_order->getTakeoutOrders();

        return view('serve.index', compact('order_tables', 'orders', 'takeout_order_names', 'takeout_orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            DB::beginTransaction();
            $order = Order::find($request->order_id);
            $order->status = config('order.done');
            $order->save();
            DB::commit();
            $message = '「'.$order->menu->name.'」の配膳を確認しました';
            return redirect()->route('serve.index')->with(['message' => $message, 'type' => 'success']);

        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Serve Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '料理の配膳済み処理に失敗しました');
        }
    }

}
