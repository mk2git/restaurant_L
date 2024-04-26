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
        $Atables = Table::where('name', 'like', 'A-%')->get();
        $Btables = Table::where('name', 'like', 'B-%')->get();

        return view('tables.index', compact('Atables', 'Btables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
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
        // dd($table);
        if($table->status == '未使用'){
            $table->status = '使用中';
            $table->save();
        }else{
            $table->status = '未使用';
            $table->save();
        }

        return redirect()->route('table.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $seatGroup = $request->input('name');
        $count = $request->count;
        // dd($request);

        if($seatGroup == 'A-'){

            $LastAseat = $seatGroup . $count;
            Table::where('name', $LastAseat)->delete();
        }

        if($seatGroup == 'B-'){
            $LastBseat = $seatGroup . $count;
            Table::where('name', $LastBseat)->delete();
        }

        return redirect()->route('table.edit')->with(['message' => '座席を1つ削除しました。', 'type' => 'danger']);
    }
}
