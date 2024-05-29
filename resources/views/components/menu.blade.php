@foreach ($categories as $category)
    <h5 class="text-start fw-bold ps-5">{{$category->name}}</h5>
    <hr class="w-25">
      @foreach ($menus as $menu)
        @if($category->id == $menu->category_id)
          <div class="row">
            <div class="col-4">
              <button type="button" class="btn menu-img" data-bs-toggle="modal" data-bs-target="#menuModal{{$menu->id}}" data-menu-id="{{ $menu->id }}">
                <p>{{$menu->name}}</p>
            </button>
            <x-modal-select-menu-img :menu-id="$menu->id" :menu-name="$menu->name" :menu-img="asset('images/'. $menu->photo)" />
            </div>
            <div class="col-2">・・・・・</div>
            <div class="col-3">
              <span>{{number_format($menu->price)}}円</span>
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