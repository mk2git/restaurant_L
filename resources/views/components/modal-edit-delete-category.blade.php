<script>
  $(document).ready(function() {
      $('.edit-category').click(function() {
          var categoryId = $(this).data('category-id');
          $.get('/category/' + categoryId, function(data) {
              $('#editCategoryModal' + categoryId).find('.modal-body').html(data);
              $('#editCategoryModal' + categoryId).modal('show');
          });
      });
  });
</script>


<div class="modal fade" id="editCategoryModal{{$categoryId}}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editCategoryModalLabel"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;カテゴリー編集</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('category.update', $categoryId)}}" method="post">
                  @csrf
                  @method('put')
                  <input type="hidden" name="id" value="{{$categoryId}}">
                  <input type="text" name="name" id="name" value="{{$categoryName}}" class="form-control w-50 mb-4 mx-auto">
                  <button type="submit" class="btn btn-success w-25">更新</button>
              </form>
          </div>
          <div class="modal-footer">
              <form action="{{route('category.destroy', $categoryId)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="category_id" value="{{$categoryId}}">
                  <button type="submit" class="btn btn-danger text-white"><i class="fa-regular fa-trash-can"></i>&nbsp;&nbsp;削除</button>
              </form>
          </div>
      </div>
  </div>
</div>



