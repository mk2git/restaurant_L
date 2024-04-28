<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Takeout_Checkout;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all(); 
        $checkoutTables = Checkout::where('check_status', config('check.not yet'))->get(); // ステータス系は数値でレコード格納したほうがよい by candy

        return view('checkouts.index', compact('tables', 'checkoutTables'));
    }

    public function select()
    {
        $checkout = new Checkout();
        $count_checkouts = $checkout->countCheckouts();
        $takeout_checkout = new Takeout_Checkout();
        $count_takeout_checkouts = $takeout_checkout->countTakeoutCheckouts();

        return view('checkouts.select_checkout', compact('count_checkouts', 'count_takeout_checkouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($table_id)
    {
        $checkout_ids = Checkout::where('table_id', $table_id)->where('check_status', config('check.not yet'))->pluck('id');  
        $orders = Order::whereIn('checkout_id', $checkout_ids)->get();

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
        $table_id = $request->input('table_id');
        try{
            DB::beginTransaction();
            $checkout = new Checkout(); 
            $checkout->table_id = $table_id;
            $checkout->save();
            $checkout_id = $checkout->id;

            $orders = Order::where('table_id', $table_id)->where('check_status', config('order.not yet'))->get();
            foreach($orders as $order){
                $order->check_status = config('order.done');
                $order->checkout_id = $checkout_id;
                $order->save();
            }
            DB::commit();
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Checkout Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'checkoutsテーブルへのデータ挿入やordersテーブルのcheck_statusの変更に失敗しました');
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

        try{
            DB::beginTransaction();
            $table_id = $request->input('table_id');
            $checkouts = Checkout::where('table_id', $table_id)->where('check_status', config('check.not yet'))->get();
        
            foreach($checkouts as $checkout){
                $checkout = Checkout::find($checkout->id);
                $checkout->check_status = config('check.done');
                $checkout->payment = $request->input('payment');
                $checkout->save();
            }
            $table = Table::where('id', $table_id)->first();
            $table->status = config('table.未使用');
            $table->save();
            DB::commit();           
            return redirect()->route('dashboard')->with(['message' => 'お会計が1件完了しました', 'type' => 'info']);

        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Checkout updateCheckStatus', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '支払い方法やデータの更新に失敗しました');
        }
    }
}
