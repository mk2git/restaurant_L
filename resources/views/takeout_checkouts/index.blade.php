<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => route('checkout.select')],
    ['name' => 'テイクアウト会計', 'link' => '']
  ]" />
  
  <div class="container my-5">
    <h3 class="text-center takeout-font">どのテイクアウトのお会計をしますか？</h3>
  </div>

   @if ($takeout_order_ids->isEmpty())
      <p class="text-center fw-bold mt-5">現在会計できるテイクアウトはありません。</p>
    @endif
  <div class="container d-flex justify-content-md-start justify-content-center flex-wrap my-5 container-serve p-0">
    @foreach ($takeout_order_ids as $takeout_order_id)
      <a href="{{route('takeout-check.show', $takeout_order_id->takeout_id)}}" class="d-block border rounded p-0 m-3 text-decoration-none text-black select-checkout">
          <div class="bill bg-white mx-auto px-4 pt-5 mb-5 w-100">
              <p class="h5"><small>名前：</small><span class="fw-bold">{{$takeout_order_id->takeout->name}}</span> <small>様</small></p>
              
              <hr>
              <table class="table table-borderless">
                  <thead class="border-buttom-black">
                    <tr>
                      <th>料理名</th>
                      <th>数量</th>
                      <th>単価</th>
                    </tr>
                  </thead>
                  <tbody  class="border-bottom">
                    @foreach ($takeout_orders as $order)
                        @if ($takeout_order_id->takeout_id == $order->takeout_id)
                          <tr>
                            <td>{{$order->menu->name}}</td>
                            <td>× {{$order->quantity}}</td>
                            <td>{{number_format($order->menu->price)}}</td>
                          </tr> 
                        @endif
                      @endforeach
                </tbody> 
                  <tfoot>
                    <tr>
                        <td></td>
                        <td>内税</td>
                        <td>
                          @php
                            $sum = 0;
                            $total = 0;
                            $tax = 0.1;
                          @endphp
                          @foreach ($takeout_orders as $order)
                            @if ($takeout_order_id->takeout_id == $order->takeout_id)
                              @php
                                $sum += $order->menu->price * $order->quantity;
                              @endphp
                            @endif
                          @endforeach
                          @php
                            $onlyTax = $sum * $tax;
                          @endphp
                          {{number_format($onlyTax)}}
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="fw-bold">合計</td>
                        <td class="fw-bold">
                          @php
                            $sum = 0;
                            $total = 0;
                            $tax = 0.1;
                          @endphp
                          @foreach ($takeout_orders as $order)
                            @if ($takeout_order_id->takeout_id == $order->takeout_id)
                              @php
                                $sum += $order->menu->price * $order->quantity;
                              @endphp
                            @endif
                          @endforeach
                          @php
                            $total = $sum + ($sum * $tax);
                          @endphp
                          &yen;{{number_format($total)}}
                        </td>
                      </tr>
                  </tfoot>
              </table>
            </div>
        </a>
    @endforeach
  </div>
</x-app-layout>