<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();

        return view('tables.index', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Table();
        $seat_type = $request->input('seat_type');
        // $count = $request->count;
        // dd($count);

        $findLastSeatNumber = Table::where('seat_type', $seat_type)->select('seat_number')->orderBy('seat_number', 'desc')->first();
// dd($findLastSeatNumber);
        if($findLastSeatNumber){
            $newSeatNumber = $findLastSeatNumber->seat_number + 1;
            $table->seat_type = $seat_type;
            $table->seat_number = $newSeatNumber;

        }else{
            $table->seat_type = $seat_type;
            $table->seat_number = 1;
        }
        $table->save();

        return redirect()->route('table.edit')->with(['message' => '席が追加されました。', 'type' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        $tables = Table::all();

        return view('tables.edit', compact('tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($table_id)
    {
        $table = Table::find($table_id);

        if($table->status == 1){
            $table->status = 2;
            $table->save();
        }else{
            $table->status = 1;
            $table->save();
        }

        return redirect()->route('table.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $seat_type = $request->input('seat_type');
        $getLastSeatNumber = Table::where('seat_type', $seat_type)->select('seat_number')->orderBy('seat_number', 'desc')->first();

        $lastSeatNumber = $getLastSeatNumber->seat_number;

        Table::where('seat_type',$seat_type)->where('seat_number', $lastSeatNumber)->delete();


        return redirect()->route('table.edit')->with(['message' => '座席を1つ削除しました。', 'type' => 'danger']);
    }
}
