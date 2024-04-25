<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Takeout_Checkout;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Atables = Table::where('name', 'like', 'A-%')->get();
        $Btables = Table::where('name', 'like', 'B-%')->get();
        $checkoutTables = Checkout::where('check_status', 'not yet')->get();

        return view('checkouts.index', compact('Atables', 'Btables', 'checkoutTables'));
    }

    public function select(){
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
        return view('checkouts.select_checkout', compact('count_checkouts', 'count_takeout_checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($table_id)
    {
        $checkout_ids = Checkout::where('table_id', $table_id)->where('check_status', 'not yet')->pluck('id');
       
       $orders = Order::whereIn('checkout_id', $checkout_ids)->get();
        //  dd($orders);
        $table = Table::where('id', $table_id)->first();
        $checkoutTime = Checkout::where('table_id', $table_id)->select('created_at')->first();

        return view('checkouts.show', compact('orders', 'table', 'checkoutTime'));
    }

    public function storeAndUpdate(Request $request){
       
        // store ロジックを実行
         $this->store($request);

         return redirect()->route('dashboard')->with(['message' => '1件会計可能なテーブルが出ました。', 'type' => 'info']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $table_id = $request->input('table_id');
        $checkout = new Checkout();
        $checkout->table_id = $table_id;
        $checkout->save();
        $checkout_id = $checkout->id;

        $orders = Order::where('table_id', $table_id)->where('check_status', 'not yet')->get();
        foreach($orders as $order){
            $order->check_status = 'done';
            $order->checkout_id = $checkout_id;
            $order->save();
        }
    }


    public function updateCheckStatus(Request $request)
    {
        // dd($request);
        $rule = [
            'payment' => 'required'
        ];

        $message = [
            'payment.required' => '支払い方法を選択してください'
        ];

        // バリデータの作成
        $validator = Validator::make($request->all(), $rule, $message);

        // バリデーションエラー時の処理
        if ($validator->fails()) {
            return redirect('checkout/show/' . $request->table_id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $table_id = $request->input('table_id');
        
        $checkouts = Checkout::where('table_id', $table_id)->where('check_status', 'not yet')->get();
        
        foreach($checkouts as $checkout){
            $checkout = Checkout::find($checkout->id);
            $checkout->check_status = 'done';
            $checkout->payment = $request->input('payment');
            $checkout->save();
        }
        

        $table = Table::where('id', $table_id)->first();
        $table->status = '未使用';
        $table->save();

        
        return redirect()->route('dashboard')->with(['message' => 'お会計が1件完了しました', 'type' => 'info']);
   
    }
}
