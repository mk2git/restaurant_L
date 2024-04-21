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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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

        // dd($request);
        // $takeout_orders = new TakeoutOrders();

    }

    /**
     * Display the specified resource.
     */
    public function show(Takeout_Order $takeout_Order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Takeout_Order $takeout_Order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Takeout_Order $takeout_Order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Takeout_Order $takeout_Order)
    {
        //
    }
}
