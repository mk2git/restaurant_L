<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        $categories = Category::all();
        $selectedCategoryId = null;

        return view('menu.index', compact('menus', 'categories', 'selectedCategoryId'));
    }

    public function create(){
        $categories = Category::all();

        return view('menu.add_category_menu', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:menus',
            'price' => 'required|min:0',
            'category_id' => 'required',
            'description' => 'required',
            'photo' => 'required'

        ];

        $messages = [
            'name.required' => '料理名は必須です。',
            'name.unique' => 'すでにその料理名は登録されています。',
            'price.required' => '価格は必須です。',
            'category_id.required' => 'カテゴリーの選択は必須です。',
            'description.required' => '料理の説明文は必須です。',
            'photo.required' => '写真の選択は必須です。',
        ];
         // バリデータの作成
         $validator = Validator::make($request->all(), $rules, $messages);
                 // バリデーションエラー時の処理
                 if ($validator->fails()) {
                     return redirect('menu/add')
                                 ->withErrors($validator)
                                 ->withInput();
         }

         try{
            DB::beginTransaction();
             // ファイルがアップロードされた場合は保存する
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time().'.'.$image->extension(); // ファイル名を生成
                $image->move(public_path('images'), $imageName); // ファイルを保存
            }

             $menu = new Menu();
             $menu->name = $request->input('name');
             $menu->price = $request->input('price');
             $menu->category_id = $request->input('category_id');
             $menu->description = $request->input('description');
             $menu->photo = $imageName;
             $menu->save();
             DB::commit();
            $message = '「'.$menu->name.'」がメニューに追加されました。';
            return redirect()->route('menu.add')->with(['message' => $message, 'type' => 'success']);

         }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Menu Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'メニューの追加に失敗しました');
         }      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu_id)
    {
        $rules = [
             // unique:menusを使ってしまうとデータが更新されないため、バリデーションに含まないように
            'name' => 'required',
            'price' => 'required|min:0',
            'category_id' => 'required',
            'description' => 'required',
            'photo' => 'required'
        ];

        $messages = [
            'name.required' => '料理名は必須です。',
            'name.unique' => 'すでにその料理名は登録されています。',
            'price.required' => '価格は必須です。',
            'category_id.required' => 'カテゴリーの選択は必須です。',
            'description.required' => '料理の説明文は必須です。',
            'photo.required' => '写真の選択は必須です。',
        ];
         // バリデータの作成
         $validator = Validator::make($request->all(), $rules, $messages);
                 // バリデーションエラー時の処理
                 if ($validator->fails()) {
                     return redirect('menu')
                                 ->withErrors($validator)
                                 ->withInput();
         }

         try{
            DB::beginTransaction();
            // ファイルがアップロードされた場合は保存する
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time().'.'.$image->extension(); // ファイル名を生成
                $image->move(public_path('images'), $imageName); // ファイルを保存
            }
            $category_name = Category::where('id', $request->category_id)->pluck('name');
            $menu = $menu_id;
            $menu->name = $request->input('name');
            $menu->price = $request->input('price');
            $menu->category_id = $request->input('category_id');
            $menu->description = $request->input('description');
            $menu->photo = $imageName;
            $menu->save();
            DB::commit();
            $message = '「'.$menu->name.'」のメニュー内容が変更されました。';
            return redirect()->route('menu.index')->with(['message' => $message, 'type' => 'success']);

         }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Menu Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'メニューの更新に失敗しました');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu_id)
    {
        try{
            DB::beginTransaction();
            $menu = $menu_id;
            $message = '「'.$menu->name.'」が削除されました。';
            $menu->delete();
            DB::commit();
            return redirect()->route('menu.index')->with(['message' => $message, 'type' => 'danger']);
        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Menu Destroy', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'メニューの削除に失敗しました');
        }
    }
}
