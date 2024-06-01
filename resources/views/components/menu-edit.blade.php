<li class="mb-3">
  <div class="row me-4">
      <div class="col-3">
          <button type="button" class="btn menu-img" data-bs-toggle="modal" data-bs-target="#menuModal{{$menuId}}" data-menu-id="{{ $menuId }}">
              <p>{{$menuName}}</p>
           </button>
           <x-modal-select-menu-img :menu-id="$menuId" :menu-name="$menuName" :menu-img="asset('images/'. $menuPhoto)" :menu-desc="$menuDescription" />
      </div>
      <div class="col-2">・・・・・</div>
      <div class="col-3">
          <span>{{number_format($menuPrice)}}円</span>
      </div>
      <div class="col-2">
          <button type="button" class="btn edit-menu" data-toggle="modal" data-target="#editMenuModal{{$menuId}}" data-menu-id="{{ $menuId }}">
              <i class="fa-solid fa-pencil"></i>
          </button>
          <x-modal-edit-menu :menu-id="$menuId" :menu-name="$menuName" :menu-price="$menuPrice" :menu-description="$menuDescription" :menu-photo="$menuPhoto" :menu-category-id="$menuCategoryId" :categories="$categories" />
      </div>
      <div class="col-2">
          <button type="button" data-toggle="modal" data-target="#deleteMenuModal{{$menuId}}" data-menu-id="{{ $menuId }}" class="btn delete-menu">
              <i class="fa-regular fa-trash-can text-danger"></i>
          </button>
          <x-modal-delete-menu :menu-id="$menuId" :menu-name="$menuName" />
      </div>
  </div>
</li>