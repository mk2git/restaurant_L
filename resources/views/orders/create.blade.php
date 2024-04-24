<x-app-layout>
  <div class="container mt-5">
    <p class="h3">テーブル名：{{$table->name}}</p>
  </div>

  <div class="container-menu mt-3 rounded w-50 mx-auto p-5 mb-5">
    <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;メニュー</p>

    {{-- <form action="{{route('orders.store', $table->id)}}" method="post">
       @csrf --}}
       <form action="{{route('orders.store')}}" method="post">
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
                      <select name="quantity[{{$menu->id}}]" class="form-control">
                        @for ($i=0; $i <= 10 ; $i++)
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
        <input type="hidden" name="table_id" value="{{$table->id}}">
        <div class="text-center mt-5">
           <button type="submit" class="btn btn-success w-25">注文確認へ</button>
        </div>
      </form>
    {{-- @foreach ($categories as $category)
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
              <div class="col-2">
                
                  <input type="hidden" name="menu_id" value="{{$menu->id}}">
                  <input type="hidden" name="table_id" value="{{$table->id}}">
                  <select name="quantity" class="form-control">
                    <option value="" disabled selected>0</option>
                    @for ($i=1; $i <= 10 ; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                  </select>
              </div>
              <div class="col-2">
                <button type="submit" class="btn btn-success rounded"><i class="fa-solid fa-utensils"></i></button>
              </form>
              </div>
            </div>
          </li>
          @endif
        @endforeach
      </ul>
    @endforeach --}}
  </div>

  {{-- <div class="w-50 mx-auto mb-5 text-center">
    <a href="{{route('orders.edit', $table->id)}}" class="btn btn-success w-50">注文確認</a>
  </div> --}}
</x-app-layout>