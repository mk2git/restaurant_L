<div class="row me-4 text-center">
    <div class="col-5 col-md-5">
        <button type="button" class="btn menu-img" data-bs-toggle="modal" data-bs-target="#menuModal{{$menuId}}" data-menu-id="{{ $menuId }}">
            <p class="custom-text-size">{{$menuName}}</p>
          </button>
          <x-modal-select-menu-img :menu-id="$menuId" :menu-name="$menuName" :menu-img="asset('images/'. $menuPhoto)" :menu-desc="$menuDescription" />
    </div>
    <div class="col-3 col-md-3">
        <span class="custom-text-size p-0">{{number_format($menuPrice)}}<small>円</small></span>
    </div>
    <div class="col-2 col-md-2">
      <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#editMenuModal{{$menuId}}">
          <i class="fa-solid fa-pencil"></i>
      </button>
      <x-modal-edit-menu :menu-id="$menuId" :menu-name="$menuName" :menu-price="$menuPrice" :menu-description="$menuDescription" :menu-photo="$menuPhoto" :menu-category-id="$menuCategoryId" :categories="$categories" />
    </div>
    <div class="col-2 col-md-2">
      <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteMenuModal{{$menuId}}">
          <i class="fa-regular fa-trash-can text-danger"></i>
      </button>
        <x-modal-delete-menu :menu-id="$menuId" :menu-name="$menuName" />
    </div>
</div>
