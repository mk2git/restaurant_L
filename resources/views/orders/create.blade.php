<x-app-layout>
  <div class="mt-3 ms-5">
    <a href="{{route('dashboard')}}" class="text-decoration-none text-black"><i class="fa-solid fa-house"></i></a> > <a href="{{route('order.index')}}" class="text-black">テーブル選択</a> > {{$table->seat_type}}-{{$table->seat_number}}の注文
  </div>
  <div class="container mt-5">
    <p class="h3">テーブル名：{{$table->seat_type}}-{{$table->seat_number}}</p>
  </div>

  <div class="container-menu mt-3 rounded w-50 mx-auto p-5 mb-5">
    <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;メニュー</p>

       <form action="{{route('orders.store')}}" method="post">
        @csrf
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
        <input type="hidden" name="table_id" value="{{$table->id}}">
        <div class="text-center mt-5">
           <button type="submit" class="btn btn-success w-25">注文確認へ</button>
        </div>
      </form>
  </div>
</x-app-layout>