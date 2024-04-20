<div class="container-dash">
  <a href="{{route('reserve.index')}}"class="circle "><i class="fa-solid fa-phone"></i>
      <span>予約</span></a>
  <a href="{{route('table.index')}}"class="circle"><i class="fa-solid fa-chair"></i>
      <span>座席</span></a>
  <a href="{{route('order.index')}}"class="circle"><i class="fa-solid fa-utensils"></i>
      <span>注文</span></a>
  <a href="" class="circle"><i class="fa-regular fa-clipboard"></i>
      <span>Takeout</span></a>
  <a href="{{route('serve.index')}}" class="circle serve-botton"><i class="fa-solid fa-bell-concierge"></i>
     @if ($orders)
          <span class="serve-count">{{count($orders)}}</span>
     @else
        <span class="serve-count">0</span>
     @endif
      <span>配膳状況</span></a>
  <a href="{{route('checkout.index')}}"class="circle serve-botton"><i class="fa-solid fa-cash-register"></i>
    @if ($checkouts)
          <span class="serve-count">{{count($checkouts)}}</span>
     @else
        <span class="serve-count">0</span>
     @endif
      <span>会計</span></a>
</div>