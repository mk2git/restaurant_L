<?php

namespace App\Http\Controllers;

use App\Models\Takeout_Checkout;
use App\Models\Takeout_Order;
use App\Models\Takeout;
use Illuminate\Http\Request;

class TakeoutCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $takeout_order_ids = Takeout_Checkout::where('check_status', 'not yet')->get('takeout_id');
        $takeout_orders = Takeout_Order::all();
        // dd($takeout_orders);

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
        $takeout_checkout = new Takeout_Checkout();
        $takeout_checkout->takeout_id =  $takeout_id;
        $takeout_checkout->save();

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

        $takeout_orders = Takeout_Order::where('takeout_id', $takeout_id)->get();
        foreach($takeout_orders as $takeout_order){
            $takeout_order->check_status = 'done';
            $takeout_order->save();
        }
    }

   public function updateCheckStatus(Request $request)
   {
       $takeout_id = $request->input('takeout_id');
        $takeout_order = Takeout_Checkout::where('takeout_id' ,$takeout_id)->first();
        $takeout_order->check_status = 'done';
        $takeout_order->save();

        return redirect()->route('dashboard')->with(['message' => 'テイクアウトのお会計が1件完了しました', 'type' => 'info']);
   }
}
