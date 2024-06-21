@foreach ($categories as $category)
    <h5 class="text-start fw-bold ps-5 border-bottom custom-text-size">{{$category->name}}</h5>
      @foreach ($menus as $menu)
        @if($category->id == $menu->category_id)
          <div class="row text-center me-4">
            <div class="col-6">
              <button type="button" class="btn menu-img" data-bs-toggle="modal" data-bs-target="#menuModal{{$menu->id}}" data-menu-id="{{ $menu->id }}">
                <p class="custom-text-size">{{$menu->name}}</p>
            </button>
            <x-modal-select-menu-img :menu-id="$menu->id" :menu-name="$menu->name" :menu-img="asset('images/'. $menu->photo)" :menu-desc="$menu->description" />
            </div>
            <div class="col-3">
              <span>{{number_format($menu->price)}}<small>円</small></span>
            </div>
            <div class="col-3">
                <input type="hidden" name="menu_id" value="{{$menu->id}}">
                <select name="quantity[{{$menu->id}}]" class="form-control">
                  @for ($i=0; $i <= 10 ; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
            </div>
          </div>
        @endif
      @endforeach
@endforeach