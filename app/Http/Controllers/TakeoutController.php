<?php

namespace App\Http\Controllers;

use App\Models\Takeout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TakeoutController extends Controller
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
    public function create()
    {
        return view('takeouts.create');
    }

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
        
        return redirect()->route('takeout.order', ['takeout_id' => $takeout->id]);

    }

    public function showMenu(){

        return view('takeouts.show-menu');
    }

    /**
     * Display the specified resource.
     */
    public function show(Takeout $takeout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Takeout $takeout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Takeout $takeout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Takeout $takeout)
    {
        //
    }
}
