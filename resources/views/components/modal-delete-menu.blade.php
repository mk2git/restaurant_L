<script>
  $(document).ready(function() {
      $('.delete-menu').click(function() {
          var menuId = $(this).data('menu-id');
          $.get('/menu/' + menuId, function(data) {
              $('#deleteMenuModal' + menuId).find('.modal-body').html(data);
              $('#deleteMenuModal' + menuId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="deleteMenuModal{{$menuId}}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteMenuModalLabel"><i class="fa-regular fa-trash-can text-danger"></i> &nbsp;&nbsp;メニュー削除</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('menu.destroy', $menuId)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="id" value="{{$menuId}}">
                  <p class="text-center">「 {{$menuName}} 」を削除しますか？</p>

                  <div class="text-center">
                      <button type="submit" class="btn btn-danger text-white w-50">削除</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
