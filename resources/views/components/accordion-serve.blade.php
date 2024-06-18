<div class="accordion" id="accordionPanelsStayOpenExample{{$orderTableId}}">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne{{$orderTableId}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne{{$orderTableId}}">
        {{$orderTableSeatType}}-{{$orderTableSeatNumber}}
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne{{$orderTableId}}" class="accordion-collapse collapse show">
      <div class="accordion-body">
        @foreach ($orders as $order)
          @if ($order->table_id == $orderTableId)
            <div class="row mb-1">
                <div class="col-6">
                  <small @if($order->status == config('order.done')) class="text-decoration-line-through" @endif>{{$order->menu->name}}</small>
                </div>
                <div class="col-2">×&nbsp;{{$order->quantity}}</div>
                <div class="col-4">
                  @if ($order->status == config('order.cooking'))
                    <div class="row">
                      <div class="col">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order->id}}" class="btn">
                          <small><i class="fa-solid fa-bell-concierge text-success"></i></small>
                        </button>
                        <x-modal-update-order-status-to-done :order-id="$order->id" :order-menu-name="$order->menu->name" />
                      </div>
                      <div class="col">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#cancelModal{{$order->id}}" class="btn">
                          <small><i class="fa-solid fa-ban text-danger"></i></small>
                        </button>
                         <x-modal-cancel-order :order-id="$order->id" :order-menu-name="$order->menu->name" />
                      </div>
                    </div>                        
                  @else
                    <i class="fa-solid fa-check text-danger"></i>
                  @endif
                </div>
            </div>
          @endif
        @endforeach    
        
        <hr>
        <div class="text-center">
          @foreach ($orders as $order)
            @if ($order->table_id == $orderTableId)
              @php
                 $allDone = $orders->where('table_id', $orderTableId)->every(function ($item) {
                    return $item->status == config('order.done');
                });
              @endphp
              @if ($allDone)
                <form action="{{route('checkout.store')}}" method="post">
                  @csrf
                  <input type="hidden" name="table_id" value="{{$orderTableId}}">
                  <button type="submit" class="btn btn-success text-white w-75">会計へ</button>
                </form>
                
                @break
              @else
                <button type="submit" class="btn btn-success text-white w-75" disabled>会計へ</button>
                @break
              @endif
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>