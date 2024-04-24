<x-app-layout>
  <div class="container mt-5 w-75">
      @if ($errors->any())
         <x-error-message />
      @endif
      
    <div class="container bg-light p-5">
      <h3 class="text-center mb-4"><i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;お会計</h3>

      <div class="bill bg-white w-50 mx-auto px-4 pt-5 pb-3 mb-5">
        <p class="h4">テーブル：{{$table->name}}<small class="float-end h6 pt-3">{{$checkoutTime->created_at->format('Y-m-d H:i')}}</small></p>
        
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

        <p>支払い方法</p>
        <form action="{{route('checkout.updateCheckStatus')}}" method="post">
            @csrf
            @method('put') 
            <div class="form-check">
              <input type="radio" name="payment" id="cash" value="cash" class="form-check-input">
              <label class="form-check-label" for="cash">現金</label>
            </div>
            <div class="form-check">
              <input type="radio" name="payment" id="card" value="card" class="form-check-input">
              <label class="form-check-label" for="card">クレジットカード</label>
            </div>
      </div>
     
      <div class="text-center">
          <input type="hidden" name="table_id" value="{{$table->id}}">
          <button type="submit" class="btn btn-success w-25">CheckOut</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>