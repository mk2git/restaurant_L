<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $selectedCategory = null;

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

    public function show($category_id){
        $category = Category::find($category_id);

        return response()->json($category);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required|unique:categories'
        ]);

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
        $request->validate([
            'name' => 'required'
        ]);
        
        $category = Category::find($request->id);
        $category->name = $request->input('name');
        $category->save();

        return to_route('menu.add')->with(['message' => 'カテゴリー名が更新されました。', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        $message = 'カテゴリー：「'.$category->name.'」が削除されました。';
        $category->delete();

        return redirect()->route('menu.add')->with(['message'=> $message, 'type' => 'danger']);
    }
}
