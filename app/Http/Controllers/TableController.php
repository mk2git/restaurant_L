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
        dd($count);

        // Aグループ席
        if($seat == 'A-'){
            $findLastAseat = Table::where('name', 'like', 'A-%')->select('name')->orderBy('name', 'desc')->first();


                if($findLastAseat){
                 // 文字列から数値部分のみを取り出す
                //  substr($findLastAseat->name, 2)のsubstr()は文字列から部分文字列を取り出すもので、$findLastAseat->nameの先頭から2文字目までを除いた文字を取得できる（例：A-1の場合、1が取り出される）
                // intval() 関数は、文字列を整数値に変換する
                 $seatNumber = intval(substr($findLastAseat->name, 2));
// dd($seatNumber);
                    // 10以降のもの
                 if($seatNumber >= 10){
                     $newSeatName = 'A-' . ($seatNumber+1);

                 //  10未満のもの
                 }else{
                      $newSeatName = 'A-' . ($seatNumber+1);
                 }

            }else{
                $newSeatName = 'A-1';
            }


        }

        // Bグループ席
        if($seat == 'B-'){
            $findLastBseat = Table::where('name', 'like', 'B-%')->select('name')->orderBy('name', 'desc')->first();

            if ($findLastBseat) {
                // 正規表現を使って文字列から数字部分を抽出します
                preg_match('/\d+$/', $findLastBseat->name, $matches);

                dd($matches);
                // 数字部分が取得できた場合
                if (isset($matches[0])) {
                    $lastNumber = intval($matches[0]);
                    $newSeatName = 'B-' . ($lastNumber + 1);
                } else {
                    // 数字部分が取得できない場合、エラー処理またはデフォルト値を設定します
                    $newSeatName = 'B-1';
                }
            } else {
                // B-席が一つも存在しない場合、B-1から始めるため、$lastNumberを0にセットします
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
