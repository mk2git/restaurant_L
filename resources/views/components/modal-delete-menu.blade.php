<div class="modal fade" id="deleteMenuModal{{$menuId}}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteMenuModalLabel"><i class="fa-regular fa-trash-can text-danger"></i> &nbsp;&nbsp;メニュー削除</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
