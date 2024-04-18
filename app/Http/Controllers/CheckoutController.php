<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Atables = Table::where('name', 'like', 'A-%')->get();
        $Btables = Table::where('name', 'like', 'B-%')->get();
        $checkoutTables = Checkout::all();

        return view('checkouts.index', compact('Atables', 'Btables', 'checkoutTables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show()
    {
        return view('checkouts.show');
    }

    public function storeAndUpdate(Request $request){
       
        // store ロジックを実行
         $this->store($request);

         // update ロジックを実行
         $this->update($request);

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
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $table_id = $request->input('table_id');
        $orders = Order::where('table_id', $table_id)->get();
        // dd($order);
        foreach($orders as $order){
            $order->check_status = 'done';
            $order->save();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
