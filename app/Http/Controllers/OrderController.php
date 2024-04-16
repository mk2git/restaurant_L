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

        return redirect()->route('orders.create', ['table_id' => $request->input('table_id')])->with(['message' => '注文が追加されました。', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
