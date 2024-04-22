<div class="accordion accordion-flush" id="accordionFlushExample{{$takeoutOrderId}}">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$takeoutOrderId}}" aria-expanded="false" aria-controls="flush-collapseOne{{$takeoutOrderId}}">
        {{$takeoutOrderName}}
      </button>
    </h2>
    <div id="flush-collapseOne{{$takeoutOrderId}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        @foreach ($takeoutOrders as $takeoutOrder)
        {{-- @dd($takeoutOrder) --}}
          @if ($takeoutOrder->takeout_id == $takeoutOrderId)
          
            <div class="row mb-3">
                <div class="col-sm-7">
                  <small @if($takeoutOrder->status == 'done') class="text-decoration-line-through" @endif>{{$takeoutOrder->menu->name}}</small>
                </div>
                <div class="col-sm-2">×&nbsp;{{$takeoutOrder->quantity}}</div>
                <div class="col-sm-3">
                  @if ($takeoutOrder->status == 'cooking')
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleTakeoutModal{{$takeoutOrder->id}}"><i class="fa-solid fa-bell-concierge text-success"></i></button>
                    <x-modal-update-takeout-order-status-to-done :takeout-order-id="$takeoutOrder->id" :takeout-order-menu-name="$takeoutOrder->menu->name" />
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
                  @if ($takeoutOrder->status != 'done')
                      @php
                          $allDone = false;
                      @endphp
                      <button type="submit" class="btn btn-success text-white w-50" disabled>会計へ</button>
                      @break
                  @endif
              @endif
          @endforeach
          @if ($allDone)
              <form action="{{ route('checkout.store') }}" method="post">
                  @csrf
                  <input type="hidden" name="takeout_id" value="{{ $takeoutOrderId }}">
                  <button type="submit" class="btn btn-success text-white w-50">会計へ</button>
              </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>