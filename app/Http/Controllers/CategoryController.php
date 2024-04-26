<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $selectedCategory = null; // 使ってる？ by candy

        return view('menu.add_category_menu', compact('categories', 'selectedCategory'));
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

    public function show($category_id){ // これは？ by candy
        $category = Category::find($category_id);

        return response()->json($category);
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

        // トランザクションをかけたほうがよい by candy
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        $message = '「'.$category->name.'」カテゴリーが追加されました';

        return redirect()->route('menu.add')->with(['message' => $message, 'type' => 'success']);
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

        $category = Category::find($request->id);
        $category->name = $request->input('name');
        $category->save();

        return to_route('menu.add')->with(['message' => 'カテゴリー名が更新されました。', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id) // 引数の中でCategoryモデルを使うとfindの必要がなくなる by candy
    {
        $category = Category::find($category_id);
        $message = 'カテゴリー：「'.$category->name.'」が削除されました。';
        $category->delete();

        return redirect()->route('menu.add')->with(['message'=> $message, 'type' => 'danger']);
    }
}
