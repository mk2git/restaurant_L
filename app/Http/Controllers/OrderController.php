<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

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
        $table = Table::where('id', $table_id)->get();
// dd($table);
        return view('orders.create', compact('table'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
