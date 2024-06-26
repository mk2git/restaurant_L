<div class="accordion" id="accordionPanelsStayOpenTakeOut{{$takeoutOrderId}}">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpenTakeOut-collapseOne{{$takeoutOrderId}}" aria-expanded="true" aria-controls="panelsStayOpenTakeOut-collapseOne{{$takeoutOrderId}}">
        {{$takeoutOrderName}}&nbsp;<small>様</small>
      </button>
    </h2>
    <div id="panelsStayOpenTakeOut-collapseOne{{$takeoutOrderId}}" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body px-3">
        @foreach ($takeoutOrders as $takeoutOrder)
          @if ($takeoutOrder->takeout_id == $takeoutOrderId)     
            <div class="row mb-1 text-center">
                <div class="col-6">
                  <small @if($takeoutOrder->status == config('takeout_order.done')) class="text-decoration-line-through" @endif class="menu-name-font">{{$takeoutOrder->menu->name}}</small>
                </div>
                <div class="col-2">
                  <small>×&nbsp;{{$takeoutOrder->quantity}}</small>
                </div>
                <div class="col-4">
                  @if ($takeoutOrder->status == config('takeout_order.cooking'))
                      <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleTakeoutModal{{$takeoutOrder->id}}" class="btn p-0 p-lg-1">
                        <i class="fa-solid fa-bell-concierge text-success"></i>
                      </button>
                      <x-modal-update-takeout-order-status-to-done :takeout-order-id="$takeoutOrder->id" :takeout-order-menu-name="$takeoutOrder->menu->name" />
                      <button type="submit" data-bs-toggle="modal" data-bs-target="#cancelTakeoutModal{{$takeoutOrder->id}}" class="btn p-0 p-lg-1">
                        <i class="fa-solid fa-ban text-danger"></i>
                      </button>
                      <x-modal-cancel-takeout :takeout-order-id="$takeoutOrder->id" :takeout-order-menu-name="$takeoutOrder->menu->name" />
                  @else
                    <i class="fa-solid fa-check text-danger"></i>
                  @endif
                </div>
            </div>
          @endif
        @endforeach    
        
        <hr>
        <div class="text-center">
          @php
             $allDone = true;
          @endphp

          @foreach ($takeoutOrders as $takeoutOrder)
              @if ($takeoutOrder->takeout_id == $takeoutOrderId)
                  @if ($takeoutOrder->status != config('takeout_order.done'))
                      @php
                          $allDone = false;
                      @endphp
                      <button type="submit" class="btn btn-success text-white w-75" disabled>会計へ</button>
                      @break
                  @endif
              @endif
          @endforeach
          @if ($allDone)
              <form action="{{ route('takeout-check.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="takeout_id" value="{{ $takeoutOrderId }}">
                  <button type="submit" class="btn btn-success text-white w-75">会計へ</button>
              </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>