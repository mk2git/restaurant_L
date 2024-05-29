@if (isset($menuName))
    <div class="form-group row mb-2">
      <div class="col-sm-4">
          <label for="name" class=" col-form-label">料理名：</label>
      </div>
      <div class="col-sm-8">
          <input type="text" name="name" id="name" value="{{$menuName}}" class="form-control mb-4 mx-auto">
      </div>
    </div>
    <div class="form-group row mb-2">
      <div class="col-sm-4">
          <label for="price" class=" col-form-label">価格：</label>
      </div>
      <div class="col-sm-8">
          <input type="text" name="price" id="price" value="{{$menuPrice}}" class="form-control mb-4 mx-auto" min="0">
      </div>
    </div>
    <div class="form-group row mb-2">
      <div class="col-sm-4">
          <label class=" col-form-label">カテゴリー：</label>
      </div>
      <div class="col-sm-8">
          <select name="category_id" class="form-control">
            @foreach ($categories as $category)
              <option value="{{$category->id}}"  @if ($category->id == $menuCategoryId) selected @endif>{{$category->name}}</option>
            @endforeach
          </select>
      </div>
    </div>
    <div class="form-group row mb-2">
      <div class="col-sm-4">
          <label class=" col-form-label">説明文：</label>
      </div>
      <div class="col-sm-8">
          <textarea name="description" cols="20" rows="5" class="form-control">{{$menuDescription}}</textarea>
      </div>
    </div>
    <div class="form-group row mb-2">
      <div class="col-sm-4">
          <label for="photo" class=" col-form-label">写真：</label>
      </div>
      <div class="col-sm-8">
          <input type="file" name="photo" id="photo" value="{{$menuPhoto}}" class="form-control">
      </div>
    </div>
    <hr>
    <div class="form-group text-center">
      <button type="submit" class="btn btn-success w-75">更新</button>
    </div>
@else
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
        <input type="number" name="price" id="price" min="1" class="form-control">
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
@endif
