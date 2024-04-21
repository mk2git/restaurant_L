<?php

namespace App\Http\Controllers;

use App\Models\Takeout_Order;
use App\Models\Takeout;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class TakeoutOrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($takeout_id)
    {
        $takeout = Takeout::find($takeout_id);
        $menus = Menu::all();
        $categories = Category::all();

        return view('takeout_orders.create', compact('takeout', 'menus', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

         // メニューごとに注文を処理
        foreach ($data['quantity'] as $menuId => $quantity) {
        // quantityがnullまたは0の場合はスキップ
        if ($quantity === null || $quantity == 0) {
            continue;
        }

        // 注文を作成して保存
        $takeoutOrder = new Takeout_Order();
        $takeoutOrder->takeout_id = $data['takeout_id'];
        $takeoutOrder->menu_id = $menuId;
        $takeoutOrder->quantity = $quantity;
        $takeoutOrder->save();
    }

        return redirect()->route('takeout-order.edit', ['takeout_id' => $request->takeout_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($takeout_id, Takeout_Order $takeout_Order)
    {
        $takeout = Takeout::find($takeout_id);
        $takeout_orders = Takeout_Order::where('takeout_id', $takeout_id)->get();
        $menus = Menu::all();

        return view('takeout_orders.edit', compact('takeout', 'takeout_orders', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($takeout_order_id, Request $request)
    {
        // dd($request);
        $takeout_order = Takeout_Order::find($takeout_order_id);
        $takeout_order->quantity = $request->input('quantity');
        $takeout_order->save();

        $menu_name = Menu::find($takeout_order->menu_id)->name;
        $message = '「'.$menu_name.'」注文数が変更されました';
        $takeout_id = $request->takeout_id;
        // dd($takeout_id);

        return redirect()->route('takeout-order.edit', ['takeout_id' => $takeout_id])->with(['message' => $message, 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($takeout_order_id, Request $request)
    {
        $takeout_order = Takeout_Order::find($takeout_order_id);
        $menu_name = Menu::find($takeout_order->menu_id)->name;
        $message = '「'.$menu_name.'」が削除されました';
        $takeout_id = $request->takeout_id;

        $takeout_order->delete();

        
        return redirect()->route('takeout-order.edit', ['takeout_id' => $takeout_id])->with(['message' => $message, 'type' => 'danger']);
    }
}
