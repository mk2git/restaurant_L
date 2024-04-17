<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Atables = Table::where('name', 'like', 'A-%')->get();
        $Btables = Table::where('name', 'like', 'B-%')->get();

        return view('orders.index', compact('Atables', 'Btables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($table_id)
    {
        $table = Table::where('id', $table_id)->first();
        $menus = Menu::all();

       // menuテーブルから使用されているカテゴリIDの一覧を取得
        $usedCategoryIds = Menu::pluck('category_id')->unique();

      // 取得したカテゴリIDを使用して、categoryテーブルからカテゴリ情報を取得
       $categories = Category::whereIn('id', $usedCategoryIds)->get();
        // dd($categories);

        return view('orders.create', compact('table', 'menus', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'quantity' => 'required|min:1'
        ];

        $message = [
            'quantity.required' => '数量の指定をしてください。'
        ];
         // バリデータの作成
         $validator = Validator::make($request->all(), $rule, $message);

        // バリデーションエラー時の処理
        if ($validator->fails()) {
            return redirect('order/create/'. $request->input('table_id'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $order = new Order();
        $order->menu_id = $request->input('menu_id');
        $order->table_id = $request->input('table_id');
        $order->quantity = $request->input('quantity');
        $order->save();

        $message = '「'.$order->menu->name.'」の注文が追加されました。';

        return redirect()->route('orders.create', ['table_id' => $request->input('table_id')])->with(['message' => $message, 'type' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($table_id)
    {
         $orders = Order::where('table_id', $table_id)->where('order_status', 'new')->get();
         $table_id = $table_id;
        // dd($table_id);
        return view('orders.edit', compact('orders', 'table_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($order_id, Request $request)
    {
        $order = Order::find($order_id);
        $order->quantity = $request->input('quantity');
        $order->save();

        $message = $order->menu->name.'の注文数が変更されました。';

        return redirect()->route('orders.edit', ['table_id' => $request->input('table_id')])->with(['message' => $message, 'type' => 'success']);
    }

    public function changeOrderStatus(Request $request){
        // dd($request->table_id);
        $table_id = $request->table_id;
        $orders = Order::where('table_id', $table_id)->get();
        // dd($order);
        foreach($orders as $order){
            $order->order_status = 'old';
            $order->save();
        }
        
        return redirect()->route('dashboard')->with(['message' => '注文が確定しました', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order_id, Request $request)
    {
        $order = Order::find($order_id);
        $order->delete();

        return redirect()->route('orders.edit', ['table_id' => $request->input('table_id')])->with(['message' => '注文が1件削除されました。', 'type' => 'danger']);
    }
}
