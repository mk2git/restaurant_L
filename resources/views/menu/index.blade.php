<x-admin-layout>
    <div class="container mt-5">

        @if (session('message'))
           <x-alert-message :type="session('type')" :message="session('message')" />
        @endif
        @if ($errors->any())
           <x-error-message />
        @endif
        
        <form action="{{route('category.getCategory')}}" method="post">
            @csrf
            <div class="w-25 mb-3 mx-auto">
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
        <div class="container-menu rounded mt-5 w-75 mx-auto p-3 mb-5">
            <h2 class="my-4 pt-4 text-center"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;&nbsp;&nbsp;メニュー&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-utensils"></i></h2>
            @if (!isset($selectedCategories) || isset($selectedAllCategories))
                @foreach ($categories as $category)
                    <h5 class="text-start fw-bold ps-5">{{$category->name}}</h5>
                    <hr class="w-25">
                    <ul class="mb-5">
                    @foreach ($menus as $menu)
                        @if ($category->menus->isEmpty())
                            <p>該当するカテゴリーの料理はまだ登録されていません。</p>
                         @break
                        @endif
                        @if ($category->id == $menu->category_id)
                            <x-menu-edit :menu-id="$menu->id" :menu-name="$menu->name" :menu-photo="$menu->photo" :menu-price="$menu->price" :menu-description="$menu->description" :menu-category-id="$menu->category_id" :categories="$categories" />
                        @endif
                    @endforeach
                </ul>
                @endforeach
            @elseif (isset($noMenu))
                @foreach ($noMenu as $menu)
                    <h5 class="text-start fw-bold ps-5">{{$menu->name}}</h5>
                    <hr class="w-25">
                    <ul class="mb-5">
                        <p>該当する料理はまだ登録されていません。</p>
                    </ul>
                @endforeach
            @else
                @foreach ($selectedCategories as $selectedCategory)
                    @foreach ($categories as $category)
                        @if ($selectedCategory->category_id == $category->id)
                            <h5 class="text-start fw-bold ps-5">{{$category->name}}</h5>
                            <hr class="w-25">
                            <ul class="mb-5">
                                @foreach ($menus as $menu)
                                    @if ($menu->category_id == $category->id)
                                        <x-menu-edit :menu-id="$menu->id" :menu-name="$menu->name" :menu-photo="$menu->photo" :menu-price="$menu->price" :menu-description="$menu->description" :menu-category-id="$menu->category_id" :categories="$categories" />
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                    @break
                @endforeach
            @endif
        </div>
    </div>
</x-admin-layout>
