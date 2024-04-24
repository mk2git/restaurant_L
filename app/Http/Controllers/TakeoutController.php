<?php

namespace App\Http\Controllers;

use App\Models\Takeout;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TakeoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone_number' => 'required'
        ];
        $messages = [
            'name.required' => '名前は必須です',
            'phone_number.required' => '電話番号は必須です'
        ];
        // バリデータの作成
        $validator = Validator::make($request->all(), $rules, $messages);
        // バリデーションエラー時の処理
        if ($validator->fails()) {
            return redirect('takeout')
                        ->withErrors($validator)
                        ->withInput();
        }

        $takeout = new Takeout();
        $takeout->name = $request->input('name');
        $takeout->phone_number = $request->input('phone_number');
        $takeout->save();
        
        return redirect()->route('takeout-order.create', ['takeout_id' => $takeout->id]);

    }

}
