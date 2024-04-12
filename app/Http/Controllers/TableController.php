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
        $seat = $request->input('name');
        $count = $request->count;
        // dd($count);

        // Aグループ席
        if($seat == 'A-'){
            $findLastAseat = Table::where('name', 'like', 'A-%')->select('name')->orderBy('name', 'desc')->first();


             if($findLastAseat){
                 $newNumber = $count +1;
                 $newSeatName = 'A-' . $newNumber;

            }else{
                $newSeatName = 'A-1';
            }
           
        }

        // Bグループ席
        if($seat == 'B-'){
            $findLastBseat = Table::where('name', 'like', 'B-%')->select('name')->orderBy('name', 'desc')->first();

            if ($findLastBseat) {
                $newNumber = $count +1;
                $newSeatName = 'B-' . $newNumber;

                }
             else {
                $newSeatName = 'B-1';
            }
        }

        $table->name = $newSeatName;
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
        $Atables = Table::where('name', 'like', 'A-%')->get();
        $Btables = Table::where('name', 'like', 'B-%')->get();
        // dd($Atables);
        return view('tables.edit', compact('Atables', 'Btables'));
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

        if($seatGroup == 'A-'){
            $findLastAseat = Table::where('name', 'like', "A-%")->orderBy('name', 'desc')->first();

            if($findLastAseat){
                // 削除するときはその該当する情報すべてを取得してからでないとテーブルから削除されない（nameカラムがA-3を取得するだけでは、削除できない。必ずA-3のidやstatusなど全ての情報を取得する！）
                $findLastAseat->delete();
            }
        }

        if($seatGroup == 'B-'){
            $findLastBseat = Table::where('name', 'like', "B-%")->orderBy('name', 'desc')->first();

            if($findLastBseat){
                $findLastBseat->delete();
            }
        }

        return redirect()->route('table.edit')->with(['message' => '座席を1つ削除しました。', 'type' => 'danger']);
    }
}
