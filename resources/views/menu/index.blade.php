<x-app-layout>
    <div class="container mt-5">

        @if (session('message'))
           <x-alert-message :type="session('type')" :message="session('message')" />
        @endif
        @if ($errors->any())
           <x-error-message />
        @endif
        
        <form action="{{route('category.getCategory')}}" method="post">
            @csrf
            <div class="select-category mb-3">
                <select name="category_id" class="form-control" onchange="this.form.submit()">
                    <option value="" disabled @if (!isset($selectedCategories) || !isset($selectedAllCategories)) selected @endif>カテゴリーを選択</option>
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}" @if($selectedCategoryId == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                    <option value="all" @if(isset($selectedAllCategories)) selected @endif>全てのメニュー</option>
                </select>
            </div>
        </form>

        {{-- 一覧 --}}
        <div class="container-menu rounded my-5 p-3">
            <div class="menu-paper py-2 px-3">
            <h2 class="pt-4 text-center"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;&nbsp;&nbsp;メニュー&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-utensils"></i></h2>
            @if (!isset($selectedCategories) || isset($selectedAllCategories))
                @foreach ($categories as $category)
                <div class="mb-3">
                    <h5 class="text-start fw-bold ps-5 border-bottom custom-text-size">{{$category->name}}</h5>
                    @foreach ($menus as $menu)
                        @if ($category->menus->isEmpty())
                            <p class="custom-text-size">該当するカテゴリーの料理はまだ登録されていません。</p>
                         @break
                        @endif
                        @if ($category->id == $menu->category_id)
                            <x-menu-edit :menu-id="$menu->id" :menu-name="$menu->name" :menu-photo="$menu->photo" :menu-price="$menu->price" :menu-description="$menu->description" :menu-category-id="$menu->category_id" :categories="$categories" />
                        @endif
                    @endforeach
             </div>
                @endforeach
            @elseif (isset($noMenu))
                @foreach ($noMenu as $menu)
                    <h5 class="text-start fw-bold ps-5">{{$menu->name}}</h5>
                    <p class="mb-5 custom-text-size">該当する料理はまだ登録されていません。</p>
                @endforeach
            @else
                @foreach ($selectedCategories as $selectedCategory)
                    @foreach ($categories as $category)
                        <div class="mb-3">
                            @if ($selectedCategory->category_id == $category->id)
                                <h5 class="text-start fw-bold ps-5 custom-text-size">{{$category->name}}</h5>
                                <hr class="w-25">
                                    @foreach ($menus as $menu)
                                        @if ($menu->category_id == $category->id)
                                            <x-menu-edit :menu-id="$menu->id" :menu-name="$menu->name" :menu-photo="$menu->photo" :menu-price="$menu->price" :menu-description="$menu->description" :menu-category-id="$menu->category_id" :categories="$categories" />
                                        @endif
                                    @endforeach
                            @endif
                        </div>
                    @endforeach
                    @break
                @endforeach
            @endif
        </div>
        </div>
    </div>
</x-app-layout>
