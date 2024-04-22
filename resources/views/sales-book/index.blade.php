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
        <section class="border rounded p-4 mb-3">
            <h3 class="text-center"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;個別料理ランキング&nbsp;&nbsp;<i class="fa-solid fa-utensils"></i></h3>


        </section>

        <section class="border rounded p-4 mb-3">
          <h3 class="mb-4 text-center">前日比</h3>
          <div class="row">
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-info text-white">昨日</span>
            </div>
            <div class="col-sm-2 text-center">
               @php
                  $gap = 0;
                  $lastMonthTotal = 0;
                @endphp
                @foreach ($lastMonthOrders as $lastMonthOrder)
                  @php
                    $lastMonthTotal += $lastMonthOrder->quantity * $lastMonthOrder->menu->price
                  @endphp
                @endforeach

                @php
                  $thisMonthTotal = 0;
                @endphp
                @foreach ($thisMonthOrders as $thisMonthOrder)
                  @php
                    $thisMonthTotal += $thisMonthOrder->quantity * $thisMonthOrder->menu->price
                  @endphp
                @endforeach

                @if ($lastMonthTotal = $thisMonthTotal || $lastMonthOrders->isEmpty())
                  <span>±0</span> 
                @endif
                @if ($lastMonthTotal > $thisMonthTotal)
                  @php
                    $gap = $lastMonthTotal - $thisMonthTotal;
                  @endphp
                  <span class="text-primary">-{{number_format($gap)}}</span> 
                @elseif ($lastMonthTotal < $thisMonthTotal)
                  @php
                    $gap = $thisMonthTotal - $lastMonthTotal;
                  @endphp
                  <span class="text-danger">+{{number_format($gap)}}</span>
                @endif
            </div>
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-success">今日</span> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 h3 text-center">
              @if ($lastMonthOrders->isEmpty())
                <span class="h5">昨日の売り上げなし</span>
              @else
                @php
                  $lastMonthTotal = 0;
                @endphp
                @foreach ($lastMonthOrders as $lastMonthOrder)
                  @php
                    $lastMonthTotal += $lastMonthOrder->quantity * $lastMonthOrder->menu->price
                  @endphp
                @endforeach
                &yen;{{number_format($lastMonthTotal)}}
              @endif
            </div>
            <div class="col-sm-2 h1 text-center"><i class="fa-solid fa-right-long"></i></div>
            <div class="col-sm-5 h3 text-center">
              @php
                $thisMonthTotal = 0;
              @endphp
              @foreach ($thisMonthOrders as $thisMonthOrder)
                @php
                  $thisMonthTotal += $thisMonthOrder->quantity * $thisMonthOrder->menu->price
                @endphp
              @endforeach
              &yen;{{number_format($thisMonthTotal)}}
            </div>
          </div>
        </section>
        
        <section class="border rounded p-4 mb-3">
          <h3 class="mb-4 text-center">前月比</h3>
          <div class="row">
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-info text-white">先月</span>
            </div>
            <div class="col-sm-2 text-center">
               @php
                  $gap = 0;
                  $lastMonthTotal = 0;
                @endphp
                @foreach ($lastMonthOrders as $lastMonthOrder)
                  @php
                    $lastMonthTotal += $lastMonthOrder->quantity * $lastMonthOrder->menu->price
                  @endphp
                @endforeach

                @php
                  $thisMonthTotal = 0;
                @endphp
                @foreach ($thisMonthOrders as $thisMonthOrder)
                  @php
                    $thisMonthTotal += $thisMonthOrder->quantity * $thisMonthOrder->menu->price
                  @endphp
                @endforeach

                @if ($lastMonthTotal = $thisMonthTotal || $lastMonthOrders->isEmpty())
                  <span>±0</span> 
                @endif
                @if ($lastMonthTotal > $thisMonthTotal)
                  @php
                    $gap = $lastMonthTotal - $thisMonthTotal;
                  @endphp
                  <span class="text-primary">-{{number_format($gap)}}</span> 
                @elseif ($lastMonthTotal < $thisMonthTotal)
                  @php
                    $gap = $thisMonthTotal - $lastMonthTotal;
                  @endphp
                  <span class="text-danger">+{{number_format($gap)}}</span>
                @endif
            </div>
            <div class="col-sm-5">
              <span class="badge rounded-pill text-bg-success">今月</span> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-5 h3 text-center">
              @if ($lastMonthOrders->isEmpty())
                <span class="h5">先月の売り上げなし</span>
              @else
                @php
                  $lastMonthTotal = 0;
                @endphp
                @foreach ($lastMonthOrders as $lastMonthOrder)
                  @php
                    $lastMonthTotal += $lastMonthOrder->quantity * $lastMonthOrder->menu->price
                  @endphp
                @endforeach
                &yen;{{number_format($lastMonthTotal)}}
              @endif
            </div>
            <div class="col-sm-2 h1 text-center"><i class="fa-solid fa-right-long"></i></div>
            <div class="col-sm-5 h3 text-center">
              @php
                $thisMonthTotal = 0;
              @endphp
              @foreach ($thisMonthOrders as $thisMonthOrder)
                @php
                  $thisMonthTotal += $thisMonthOrder->quantity * $thisMonthOrder->menu->price
                @endphp
              @endforeach
              &yen;{{number_format($thisMonthTotal)}}
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>