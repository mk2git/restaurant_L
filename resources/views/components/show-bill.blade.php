<table class="table table-borderless text-center">
  <thead class="border-buttom-black">
    <tr>
      <th>料理名</th>
      <th>数量</th>
      <th>単価</th>
    </tr>
  </thead>
  <tbody  class="border-bottom">
     @foreach ($orders as $order)
        <tr>
          <td>{{$order->menu->name}}</td>
          <td>× {{$order->quantity}}</td>
          <td>{{number_format($order->menu->price)}}</td>
        </tr>
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
            @foreach ($orders as $order)
              @php
                $sum += $order->menu->price * $order->quantity;
              @endphp
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
            @foreach ($orders as $order)
              @php
                $sum += $order->menu->price * $order->quantity;
              @endphp
            @endforeach
            @php
              $total = $sum + ($sum * $tax);
            @endphp
            &yen;{{number_format($total)}}
          </td>
        </tr>
    </tfoot>
</table>