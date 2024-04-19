<x-app-layout>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <section class="border rounded p-3 mb-3">
          <h3 class="text-center">本日の売り上げ金額</h3>
          <p class="text-center h1">
            @php
              $total = 0;
            @endphp
            @foreach ($todayOrders as $todayOrder)
              @php
                $total += $todayOrder->quantity * $todayOrder->menu->price;
              @endphp
            @endforeach
           <span class="border-bottom"> &yen;{{number_format($total)}}</span>
          </p>
        </section>
        <section class="border rounded p-5 mb-5">
          <h3 class="text-center mb-3">本日の注文詳細</h3>
          {{-- 売り上げの詳細 --}}
          @foreach ($categories as $category)
            <p class="fw-bold border-bottom">{{$category->name}}</p>
            @php
                $foundCategoryMenu = false;
            @endphp

            @foreach ($menus as $menu)
                @if ($category->id == $menu->category_id) 
                    <div class="row mb-2">
                        <div class="col-sm-5">{{$menu->name}}</div>
                        <div class="col-sm-3">
                          @php
                             $menuQuantity = 0;
                          @endphp
                            @foreach ($todayOrders as $todayOrder)
                              @if ($todayOrder->menu_id == $menu->id)
                                @php
                                  $menuQuantity += $todayOrder->quantity; 
                                @endphp                             
                              @endif
                            @endforeach
                             × {{$menuQuantity}}
                        </div>
                        <div class="col-sm-4">
                          @php
                            $total = 0;
                          @endphp
                          @foreach ($todayOrders as $todayOrder)
                            @if ($todayOrder->menu_id == $menu->id)
                              @php
                                $total += $todayOrder->quantity * $todayOrder->menu->price; 
                              @endphp                             
                            @endif
                        @endforeach
                        &yen;{{number_format($total)}}
                        </div>
                    </div>
                    @php
                        $foundCategoryMenu = true;
                    @endphp
                @endif
            @endforeach

            @if (!$foundCategoryMenu)
                <p>まだ料理が登録されていません。</p>
            @endif
          @endforeach
        </section>
      </div>
      <div class="col">
        <section>
            <h3></h3>
        </section>
        <section>
          {{-- 前月比 --}}
        </section>
      </div>
    </div>
    
  </div>
</x-app-layout>