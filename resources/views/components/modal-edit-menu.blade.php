<div class="modal fade" id="editMenuModal{{$menuId}}" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editMenuModalLabel"><i class="fa-solid fa-pencil"></i>&nbsp;&nbsp;メニュー編集</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{route('menu.update', $menuId)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <x-menu-form :categories="$categories" :menu-name="$menuName" :menu-price="$menuPrice" :menu-description="$menuDescription" :menu-photo="$menuPhoto" :menu-category-id="$menuCategoryId" />
              </form>
          </div>
      </div>
  </div>
</div>