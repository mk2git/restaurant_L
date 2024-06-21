<x-app-layout>
    <div class="container text-center my-5">
        @if ($errors->any())
           <x-error-message />
        @endif

        {{-- 確認メッセージ --}}
        @if (session('message'))
            <x-alert-message :type="session('type')" :message="session('message')" />
        @endif

        <div class="row">
            <div class="col-12 col-md-5">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3>カテゴリー追加</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="mb-3">
                                  <input type="text" name="name" id="category" class="form-control w-75 mx-auto" placeholder="カテゴリー名">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-50">追加</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p>＜ 現在使われているカテゴリー＞</p>
                <div class="mb-5 d-flex justify-content-center flex-wrap">
                    @foreach ($categories as $category)
                    <button type="button" class="btn category-btn btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}">
                        {{$category->name}}
                    </button>
                        <x-modal-edit-delete-category :category-id="$category->id" :category-name="$category->name" />
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h3>メニュー追加</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <x-menu-form :categories="$categories" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
