<x-app-layout>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <section class="border rounded p-3 mb-3">
          <h3 class="text-center">本日の売り上げ金額</h3>
          <p class="text-center">
           <span class="border-bottom h1"> &yen;{{number_format($todayTotal)}}<small class="font-small d-block mt-3">（ テイクアウト：&yen;{{number_format($today_takeout_total)}} ）</small></span>
          </p>
        </section>
        <div class="text-center mb-2">
          <i class="fa-solid fa-angles-down h5"></i>
        </div>
        <section class="border rounded px-5 py-4 mb-5">
          <h3 class="text-center mb-3">本日の注文詳細</h3>
          {{-- 売り上げの詳細 --}}
          @foreach ($categories as $category)
            <p class="fw-bold border-bottom mt-3">{{$category->name}}</p>
            @php
                $foundCategoryMenu = false;
            @endphp

            @foreach ($menus as $menu)
                @if ($category->id == $menu->category_id) 
                    <div class="row mb-2">
                        <div class="col-sm-7">{{$menu->name}}（&yen;{{number_format($menu->price)}}）</div>
                        <div class="col-sm-2">
                          @php
                             $menuTableQuantity = 0;
                             $menuTakeoutQuantity = 0;
                             $totalQuantity = 0;
                          @endphp
                            @foreach ($todayOrders as $todayOrder)
                              @if ($todayOrder->menu_id == $menu->id)
                                @php
                                  $menuTableQuantity += $todayOrder->quantity; 
                                @endphp                             
                              @endif
                            @endforeach
                            @foreach ($todayTakeoutOrders as $todayTakeoutOrder)
                            {{-- @dump($todayTakeoutOrder) --}}
                              @if ($todayTakeoutOrder->menu_id == $menu->id)
                                @php
                                  $menuTakeoutQuantity += $todayTakeoutOrder->quantity; 
                                @endphp                             
                              @endif
                            @endforeach
                            @php
                              $totalQuantity = $menuTableQuantity + $menuTakeoutQuantity;
                            @endphp
                             × {{$totalQuantity}}
                        </div>
                        <div class="col-sm-3">
                          @php
                            $tableTotal = 0;
                            $takeoutTotal = 0;
                            $total = 0;
                          @endphp
                          @foreach ($todayOrders as $todayOrder)
                            @if ($todayOrder->menu_id == $menu->id)
                              @php
                                $tableTotal += $todayOrder->quantity * $todayOrder->menu->price; 
                              @endphp                             
                            @endif
                        @endforeach
                        @foreach ($todayTakeoutOrders as $todayTakeoutOrder)
                            @if ($todayTakeoutOrder->menu_id == $menu->id)
                              @php
                                $takeoutTotal += $todayTakeoutOrder->quantity * $todayTakeoutOrder->menu->price; 
                              @endphp                             
                            @endif
                        @endforeach
                        @php
                          $total = $tableTotal + $takeoutTotal;
                        @endphp
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
        <section class="border rounded p-4 mb-3">
          <p class="h5 text-center"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;注文数によるランキング</p>
            @if ($table_top_three_orders_q->isEmpty())               
              <x-ranking-no-data-table ranking-name="レストラン" class="bg-success" />
            @else
              <x-ranking-table ranking-name="レストラン" class="bg-success" :table-top-three-orders-q="$table_top_three_orders_q" />
            @endif 
            @if ($takeout_top_three_orders_q->isEmpty())  
              <x-ranking-no-data-table ranking-name="テイクアウト" class="bg-warning" />
            @else
              <x-ranking-table ranking-name="テイクアウト" class="bg-warning" :table-top-three-orders-q="$takeout_top_three_orders_q" />
            @endif
        </section>
        <section class="border rounded p-4 mb-3">
          <p class="h5 text-center"><i class="fa-solid fa-sack-dollar"></i>&nbsp;&nbsp;合計金額によるランキング</p>
          @if ($table_top_three_prices->isEmpty()) 
              <x-ranking-no-data-table ranking-name="レストラン" class="bg-success" />
          @else
            <x-ranking-table ranking-name="レストラン" class="bg-success" :table-top-three-orders-q="$table_top_three_prices" />
          @endif
          @if ($takeout_top_three_prices->isEmpty()) 
              <x-ranking-no-data-table ranking-name="テイクアウト" class="bg-warning" />
          @else
            <x-ranking-table ranking-name="テイクアウト" class="bg-warning" :table-top-three-orders-q="$takeout_top_three_prices" />
           @endif
        </section>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col">
         <section class="border rounded p-4 mb-3">
          <h3 class="mb-4 text-center">前日比</h3>
          <div class="row">
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-info text-white">昨日</span>
            </div>
            <div class="col-sm-2 text-center">
               @php
                  $gap = 0;
                @endphp
                @if ($yesterdayTotal > $todayTotal)
                  @php
                    $gap = $yesterdayTotal - $todayTotal;
                  @endphp
                  <span class="text-primary">-{{number_format($gap)}}</span> 
                @elseif ($yesterdayTotal < $todayTotal)
                  @php
                    $gap = $todayTotal - $yesterdayTotal;
                  @endphp
                  <span class="text-danger">+{{number_format($gap)}}</span>
                @else
                  <span>±0</span> 
                @endif
            </div>
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-success">今日</span> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 h3 text-center">
              @if ($yesterdayTotal !== true)
                &yen;{{number_format($yesterdayTotal)}}
              @else
                <span class="h5">昨日の売り上げなし</span>
              @endif
            </div>
            <div class="col-sm-2 h1 text-center"><i class="fa-solid fa-right-long"></i></div>
            <div class="col-sm-5 h3 text-center">
              @if ($todayTotal !== true)
                &yen;{{number_format($todayTotal)}}
              @else
                <span class="h5">今日の売り上げなし</span>
              @endif
            </div>
          </div>
        </section>
      </div>
      <div class="col">
         <section class="border rounded p-4 mb-3">
          <h3 class="mb-4 text-center">前月比</h3>
          <div class="row">
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-info text-white">先月</span>
            </div>
            <div class="col-sm-2 text-center">
               @php
                  $gap = 0;
               @endphp

                @if ($lastMonthTotalOrders > $thisMonthTotalOrders)
                  @php
                    $gap = $lastMonthTotalOrders - $thisMonthTotalOrders;
                  @endphp
                  <span class="text-primary">-{{number_format($gap)}}</span> 
                @elseif ($lastMonthTotalOrders < $thisMonthTotalOrders)
                  @php
                    $gap = $thisMonthTotalOrders - $lastMonthTotalOrders;
                  @endphp
                  <span class="text-danger">+{{number_format($gap)}}</span>
                @else
                  <span>±0</span>
                @endif
            </div>
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-success">今月</span> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 h3 text-center">
              @if ($lastMonthTotalOrders !== true)
                &yen;{{number_format($lastMonthTotalOrders)}}
              @else
                <span class="h5">先月の売り上げなし</span>
              @endif
            </div>
            <div class="col-sm-2 h1 text-center"><i class="fa-solid fa-right-long"></i></div>
            <div class="col-sm-5 h3 text-center">
              @if ($thisMonthTotalOrders !== true)
                &yen;{{number_format($thisMonthTotalOrders)}}
              @else
                <span class="h5">今月の売り上げなし</span>
              @endif
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>