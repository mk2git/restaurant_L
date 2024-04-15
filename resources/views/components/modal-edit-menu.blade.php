<script>
  $(document).ready(function() {
      $('.edit-menu').click(function() {
          var menuId = $(this).data('menu-id');
          $.get('/menu/' + menuId, function(data) {
              $('#editMenuModal' + menuId).find('.modal-body').html(data);
              $('#editMenuModal' + menuId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="editMenuModal{{$menuId}}" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editMenuModalLabel"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;メニュー編集</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              {{-- @dd($menu) --}}
              <form action="{{route('menu.update', $menuId)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="id" value="{{$menuId}}">
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
                               @if ($category->id == $menuCategoryId)
                                  <option value="{{$category->id}}" selected>{{$category->name}}</option>
                               @else
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                               @endif

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
              </form>
          </div>
      </div>
  </div>
</div>