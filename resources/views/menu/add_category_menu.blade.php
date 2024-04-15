<x-app-layout>
    <div class="container text-center mt-5">
        @if ($errors->any())
            <div class="alert alert-danger w-50 mx-auto p-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 確認メッセージ --}}
        @if (session('message'))
            <div class="alert alert-{{session('type')}} w-50 mx-auto p-2 mb-4 text-center" role="alert">{{session('message')}}</div>
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
                        <button type="button" class="btn category-btn btn-success edit-category me-2 mb-2" data-toggle="modal" data-target="#editCategoryModal{{$category->id}}" data-category-id="{{ $category->id }}">{{$category->name}}</button>
                        @include('modals.edit_delete_category')
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
                            <div class="form-group row mb-3">
                                <div class="col-sm-3">
                                    <label for="name" class="col-form-label">料理名：</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-3">
                                    <label for="price" class="col-form-label">価格：</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" name="price" id="price" min="0" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-3">
                                    <label class="col-form-label">カテゴリー</label>
                                </div>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        <option value="" selected disabled>選択してください</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-sm-3">
                                    <label for="description" class="col-form-label">説明：</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" cols="20" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-3">
                                    <label for="photo" class="col-form-label">写真：</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" name="photo" id="photo" class="form-control-file">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-50">追加</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
