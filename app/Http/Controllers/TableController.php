<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try{
            DB::beginTransaction();
            $table = new Table();
            $seat_type = $request->input('seat_type');

            $findLastSeatNumber = Table::where('seat_type', $seat_type)->select('seat_number')->orderBy('seat_number', 'desc')->first();

            if($findLastSeatNumber){
                $newSeatNumber = $findLastSeatNumber->seat_number + 1;
                $table->seat_type = $seat_type;
                $table->seat_number = $newSeatNumber;

            }else{
                $table->seat_type = $seat_type;
                $table->seat_number = 1;
            }
            $table->save();
            DB::commit();
            return redirect()->route('table.edit')->with(['message' => '席が追加されました。', 'type' => 'success']);
        } catch(\Throwable $th){
            DB::rollBack();
            logger('Error Table Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '座席の追加に失敗しました');
        }
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
        try{
            DB::beginTransaction();
            $table = Table::find($table_id);

            if($table->status == config('table.使用中')){
                $table->status = config('table.未使用');
                $table->save();
            }else{
                $table->status = config('table.使用中');
                $table->save();
            }
            DB::commit();
            return redirect()->route('table.index');
        } catch(\Throwable $th){
            DB::rollBack();
            logger('Error Table Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'テーブルの更新に失敗しました');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();
            $seat_type = $request->input('seat_type');
            $getLastSeatNumber = Table::where('seat_type', $seat_type)->select('seat_number')->orderBy('seat_number', 'desc')->first();

            $lastSeatNumber = $getLastSeatNumber->seat_number;

            Table::where('seat_type',$seat_type)->where('seat_number', $lastSeatNumber)->delete();
            DB::commit();
             return redirect()->route('table.edit')->with(['message' => '座席を1つ削除しました。', 'type' => 'danger']);
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Table Destroy', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '座席の削除に失敗しました');
        }
    }
}
