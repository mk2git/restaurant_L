<x-app-layout>
  <div class="container mt-5">
    <p class="h4"><span class="fw-bold">{{$takeout->name}}</span>&nbsp;&nbsp;様</p>

    <div class="container-menu mt-3 rounded w-75 mx-auto p-5 mb-5">
      <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;メニュー</p>
  
      <form action="" method="post">
        @csrf
        @foreach ($categories as $category)
          <h5 class="text-start fw-bold ps-5">{{$category->name}}</h5>
          <hr class="w-25">
          <ul>
            @foreach ($menus as $menu)
              @if($category->id == $menu->category_id)
              <li class="mb-2">
                <div class="row">
                  <div class="col-3">
                    <p>{{$menu->name}}</p>
                  </div>
                  <div class="col-2">・・・・・</div>
                  <div class="col-3">
                    <span>{{number_format($menu->price)}}円</span>
                  </div>
                  <div class="col-4">
                      <input type="hidden" name="menu_id" value="{{$menu->id}}">
                      <select name="quantity" class="form-control">
                        <option value="" disabled selected>0</option>
                        @for ($i=1; $i <= 10 ; $i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                  </div>
                </div>
              </li>
              @endif
            @endforeach
          </ul>
        @endforeach
        <input type="hidden" name="takeout_id" value="{{$takeout->id}}">
        <button type="submit" class="btn btn-success">注文確認へ</button>
      </form>
    </div>
  </div>
</x-app-layout>