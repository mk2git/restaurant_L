<x-app-layout>
    <div class="container text-center mt-5">
        @if ($errors->any())
           <x-error-message />
        @endif

        {{-- 確認メッセージ --}}
        @if (session('message'))
            <x-alert-message :type="session('type')" :message="session('message')" />
        @endif

        <div class="row">
            <div class="col-5">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3>カテゴリー追加</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="category" class="col-form-label">カテゴリー：</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="category" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success w-100">追加</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mb-5 d-flex flex-wrap">
                    @foreach ($categories as $category)
                    <button type="button" class="btn category-btn btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}">
                        {{$category->name}}
                    </button>
                        <x-modal-edit-delete-category :category-id="$category->id" :category-name="$category->name" />
                    @endforeach
                </div>
            </div>

            <div class="col-7">
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
