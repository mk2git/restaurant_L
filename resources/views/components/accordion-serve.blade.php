<div class="accordion" id="accordionPanelsStayOpenExample{{$orderTableId}}">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne{{$orderTableId}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne{{$orderTableId}}">
        {{$orderTableName}}
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne{{$orderTableId}}" class="accordion-collapse collapse show">
      <div class="accordion-body">
        @foreach ($orders as $order)
          @if ($order->table_id == $orderTableId)
            <div class="row mb-3">
                <div class="col-sm-7"><small>{{$order->menu->name}}</small></div>
                <div class="col-sm-2">×&nbsp;{{$order->quantity}}</div>
                <div class="col-sm-3">
                  @if ($order->status == 'cooking')
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal{{$order->id}}"><i class="fa-solid fa-bell-concierge text-success"></i></button>
                    <x-modal-update-order-status-to-done :order-id="$order->id" :order-menu-name="$order->menu->name" />
                  @else
                    <i class="fa-solid fa-check text-danger"></i>
                  @endif
                </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>