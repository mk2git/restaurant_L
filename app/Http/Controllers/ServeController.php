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
        $table_ids = Order::where('check_status', config('order.not yet'))->distinct()->get('table_id');
        $order_tables = Table::whereIn('id', $table_ids)->select('id', 'seat_type', 'seat_number')->get();
        $orders = Order::where('created_at', today())->where('check_status', config('order.not yet'))->get();

        $takeout_order_ids = Takeout_Order::where('check_status', config('takeout_order.not yet'))->distinct()->get('takeout_id');
        $takeout_order_names = Takeout::whereIn('id', $takeout_order_ids)->select('id', 'name')->get();
        $takeout_orders = Takeout_Order::where('created_at', today())->where('check_status', config('takeout_order.not yet'))->get();

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
