<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reserves = Reserve::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        $dates = Reserve::orderBy('date', 'asc')->distinct()->pluck('date');
        $selectedDate = null;

        return view('reserve.index', compact('reserves', 'dates', 'selectedDate'));
    }

    public function getDate(Request $request){
        // dd($request);
        $reserves = Reserve::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        $dates = Reserve::orderBy('date', 'asc')->distinct()->pluck('date');


        $selectedDate = $request->input('date');
        // dd($selectedDate);

        // これにより、$selectedAllDatesがallでないときに未定義とならない
        $selectedAllDates = null;
        if($selectedDate == 'all'){
            $selectedAllDates = $reserves;
        }
        $selectedDates = Reserve::where('date', $selectedDate)->get();
// dd($selectedDates);

        return view('reserve.index', compact('reserves', 'dates', 'selectedDates', 'selectedDate', 'selectedAllDates'));
    }

    public function show($reserve_id){
        $one_reserve = Reserve::find($reserve_id);

        return response()->json($one_reserve);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーションルールとカスタムメッセージ
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'adult' => 'required|integer|min:1',
            'name' => 'required|max:20',
            'phone_number' => 'required'
        ];

        $messages = [
            'date.required' => '日付は必須です。',
            'time.required' => '時間の選択は必須です。',
            'name.required' => '名前は必須です。',
            'phone_number.required' => '携帯電話番号の入力は必須です。',
            'adult.min' => '大人の人数は1人以上が必須です。',
            'name.max' => '名前は最大20文字までです。'
        ];

        // バリデータの作成
        $validator = Validator::make($request->all(), $rules, $messages);
// dd($validator);
        // バリデーションエラー時の処理
        if ($validator->fails()) {
            return redirect('reserve')
                        ->withErrors($validator)
                        ->withInput();
        }
        try{
            DB::beginTransaction();
            $reserve = new Reserve();
            $reserve->date = $request->input('date');
            $reserve->time = $request->input('time');
            $reserve->adult = $request->input('adult');
            $reserve->kid = $request->input('kid');
            $reserve->name = $request->input('name');
            $reserve->phone_number = $request->input('phone_number');
            $reserve->save();
            DB::commit();
            return redirect()->route('reserve.index')->with(['message' => '予約が確定しました。', 'type' => 'success']);

        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Reserve Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '予約追加に失敗しました');
        }        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reserve $reserve, Request $request)
    {
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'adult' => 'required|integer|min:1',
            'kid' => 'required|integer|min:0',
            'name' => 'required|max:20',
            'phone_number' => 'required'
        ];
        $messages = [
            'date.required' => '日付は必須です。',
            'time.required' => '時間の選択は必須です。',
            'phone_number.required' => '携帯電話番号の入力は必須です。',
            'adult.min' => '大人の人数は1人以上が必須です。',
            'name.max' => '名前は最大20文字までです。'
        ];

        // バリデータの作成
        $validator = Validator::make($request->all(), $rules, $messages);

        // バリデーションエラー時の処理
        if ($validator->fails()) {
            return redirect('reserve')
                        ->withErrors($validator)
                        ->withInput();
}
        try{
            DB::beginTransaction();
            $reserve = Reserve::find($request->id);
            $reserve->name = $request->input('name');
            $reserve->date = $request->input('date');
            $reserve->time = $request->input('time');
            $reserve->adult = $request->input('adult');
            $reserve->kid = $request->input('kid');
            $reserve->phone_number = $request->input('phone_number');
            $reserve->save();
            DB::commit();
            return to_route('reserve.index')->with(['message' => '予約内容が更新されました', 'type' => 'success']);
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Reserve Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '予約内容の更新に失敗しました');
        }
    }

    public function changeStatus($reserve_id){
        try{
            DB::beginTransaction();
            $reserve = Reserve::find($reserve_id);
            $reserve->status = config('reserve.arrived');
            $reserve->save();
            DB::commit();
            return redirect()->back();

        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Reserve changeStatus', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', '予約者の到着ステータスの更新に失敗しました'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reserve_id)
    {
        // dd($reserve_id);
        $reserve = Reserve::find($reserve_id);
        // dd($reserve);
        $reserve->delete();

        return redirect()->route('reserve.index')->with(['message' => '1件予約をキャンセルしました。', 'type' => 'danger']);
    }
}
