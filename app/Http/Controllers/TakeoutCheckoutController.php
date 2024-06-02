<?php

namespace App\Http\Controllers;

use App\Models\Takeout_Checkout;
use App\Models\Takeout_Order;
use App\Models\Takeout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TakeoutCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $takeout_checkout = new Takeout_Checkout();
        $takeout_order_ids = $takeout_checkout->getTakeoutOrderIds();
        $takeout_orders = Takeout_Order::all();

        return view('takeout_checkouts.index', compact('takeout_order_ids', 'takeout_orders'));
    }


    public function storeAndUpdate(Request $request){
       
        // store ロジックを実行
         $this->store($request);

         // update ロジックを実行
         $this->update($request);

         return redirect()->route('dashboard')->with(['message' => '1件会計可能なテイクアウトが出ました。', 'type' => 'info']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $takeout_id = $request->input('takeout_id');
        try{
            DB::beginTransaction();
            $takeout_checkout = new Takeout_Checkout();
            $takeout_checkout->takeout_id =  $takeout_id;
            $takeout_checkout->save();

            $takeout_orders = Takeout_Order::where('takeout_id', $takeout_id)->get();
            foreach($takeout_orders as $takeout_order){
                $takeout_order->takeout_checkout_id = $takeout_checkout->id;
                $takeout_order->save();
            }
            
            DB::commit();
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error TakeoutCheckout Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'takeout_checkoutsテーブルへの追加に失敗しました');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($takeout_id)
    {
        $takeout_orders = Takeout_Order::where('takeout_id' ,$takeout_id)->get();
        $takeout = Takeout::where('id', $takeout_id)->first();
        $checkoutTime = Takeout_Checkout::where('takeout_id', $takeout_id)->select('created_at')->first();
        return view('takeout_checkouts.show', compact('takeout_orders', 'takeout', 'checkoutTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $takeout_id = $request->input('takeout_id');
        try{
            DB::beginTransaction();
             $takeout_orders = Takeout_Order::where('takeout_id', $takeout_id)->get();
            foreach($takeout_orders as $takeout_order){
                $takeout_order->check_status = config('takeout_order.done');
                $takeout_order->save();
            }
            DB::commit();
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error TakeoutCheckout Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'takeout_ordersテーブルのcheck_statusの更新に失敗しました');
        }

       
    }

   public function updateCheckStatus(Request $request)
   {
    //    dd($request);
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
            return redirect('checkout/takeout/' . $request->takeout_id)
                        ->withErrors($validator)
                        ->withInput();
        }
        try{
            DB::beginTransaction();
            $takeout_id = $request->input('takeout_id');
            $takeout_order = Takeout_Checkout::where('takeout_id' ,$takeout_id)->first();
            $takeout_order->check_status = config('takeout_checkout.done');
            $takeout_order->payment = $request->input('payment');
            $takeout_order->save();

            $takeout_id = $request->input('takeout_id');        
            $takeout = Takeout::where('id', $takeout_id)->first();                 
            $takeout->status = config('takeout.done');  
            $takeout->save();

            DB::commit();
            return redirect()->route('dashboard')->with(['message' => 'テイクアウトのお会計が1件完了しました', 'type' => 'info']);
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error TakeoutCheckout UpdateCheckStatus', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '支払い方法の追加に失敗しました');
        }
   }
}
