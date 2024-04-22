<?php

namespace App\Http\Controllers;

use App\Models\Takeout_Checkout;
use App\Models\Takeout_Order;
use Illuminate\Http\Request;

class TakeoutCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Takeout_Checkout $takeout_Checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Takeout_Checkout $takeout_Checkout)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Takeout_Checkout $takeout_Checkout)
    {
        //
    }
}
