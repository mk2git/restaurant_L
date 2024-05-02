<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('menu.add_category_menu', compact('categories'));
    }

    public function getCategory(Request $request){
        $menus = Menu::all();
        $categories = Category::all();

        $selectedCategoryId = $request->input('category_id');

        $selectedAllCategories = null;
        if($selectedCategoryId == 'all'){
            $selectedAllCategories = $categories;
        }
        $selectedCategories = Menu::where('category_id', $selectedCategoryId)->get();
        // dump($selectedCategories);
        $noMenu = null;
        if($selectedCategories->isEmpty()){
            $noMenu = Category::where('id', $selectedCategoryId)->get();
        }
//   dd($noMenu);
        return view('menu.index', compact('categories', 'selectedAllCategories', 'selectedCategories', 'selectedCategoryId', 'menus', 'noMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|unique:categories'
        ];

        $messages = [
            'name.required' => 'カテゴリー名を入力してください。',
            'name.unique' => 'すでにそのカテゴリー名は登録されています。'
        ];
         // バリデータの作成
         $validator = Validator::make($request->all(), $rules, $messages);
                 // バリデーションエラー時の処理
                 if ($validator->fails()) {
                     return redirect('menu/add')
                                 ->withErrors($validator)
                                 ->withInput();
         }

        try {
            DB::beginTransaction();
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
            DB::commit();
            $message = '「'.$category->name.'」カテゴリーが追加されました';
            return redirect()->route('menu.add')->with(['message' => $message, 'type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger('Error Category Store', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'カテゴリー追加に失敗しました');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rule = [
            'name' => 'required'
        ];

        $message = [
            'name.required' => 'カテゴリー名は必須です。'
        ];
         // バリデータの作成
         $validator = Validator::make($request->all(), $rule, $message);
                 // バリデーションエラー時の処理
                 if ($validator->fails()) {
                     return redirect('menu/add')
                                 ->withErrors($validator)
                                 ->withInput();
         }

         try{
            DB::beginTransaction();
            $category = Category::find($request->id);
            $category->name = $request->input('name');
            $category->save();
            DB::commit();
            return to_route('menu.add')->with(['message' => 'カテゴリー名が更新されました。', 'type' => 'success']);
         }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Category Update', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'カテゴリーの更新に失敗しました');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) // 引数の中でCategoryモデルを使うとfindの必要がなくなる by candy
    {
        try{
            DB::beginTransaction();
            $category->delete();
            DB::commit();
            $message = 'カテゴリー：「'.$category->name.'」が削除されました。';
            return redirect()->route('menu.add')->with(['message'=> $message, 'type' => 'danger']);

        }catch(\Throwable $th){
            DB::rollBack();
            logger('Error Category Destroy', ['message' => $th->getMessage()]);
            return redirect()->back()->with('error', 'カテゴリーの削除に失敗しました');
        }
    }
}
