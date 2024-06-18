<ul class="my-5">
  @if (isset($orders))
      @foreach ($orders as $order)
        <li class="mb-3">
          <div class="row">
            <div class="col-3">
              {{$order->menu->name}}
            </div>
            <div class="col-3">・・・・・</div>
            <div class="col-2">
                <form action="{{route('orders.update', $order->id)}}" method="post">
                @csrf
                @method('put')
                <select name="quantity" class="form-control">
                  @for ($i=1; $i <= 10; $i++)
                    <option value="{{$i}}" @if($order->quantity == $i) selected @endif>{{$i}}</option>
                  @endfor
                </select>
            </div>
            <div class="col-2 d-flex justify-content-center">
              <button type="submit" class="btn"><i class="fa-solid fa-arrows-rotate text-success"></i></button>
              </form>
            </div>
            <div class="col-2">
                <form action="{{route('orders.destroy', $order->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="table_id" value="{{$order->table_id}}">       
                  <button type="submit" class="btn w-50"><i class="fa-regular fa-trash-can text-danger"></i></button>
                </form>
            </div>
          </div>
        </li>
      @endforeach
  @else
    @foreach ($takeoutOrders as $order)
      <li class="mb-3">
        <div class="row">
          <div class="col-3">
            {{$order->menu->name}}
          </div>
          <div class="col-3">・・・・・</div>
          <div class="col-2">
              <form action="{{route('takeout-order.update', $order->id)}}" method="post">
              @csrf
              @method('put')
              <select name="quantity" class="form-control">
                @for ($i=1; $i <= 10; $i++)
                  <option value="{{$i}}" @if($order->quantity == $i) selected @endif>{{$i}}</option>
                @endfor
              </select>
          </div>
          <div class="col-2 d-flex justify-content-center">
            <button type="submit" class="btn"><i class="fa-solid fa-arrows-rotate text-success"></i></button>
            </form>
          </div>
          <div class="col-2">
              <form action="{{route('takeout-order.delete', $order->id)}}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="takeout_id" value="{{$order->takeout_id}}">          
                <button type="submit" class="btn w-50"><i class="fa-regular fa-trash-can text-danger"></i></button>
              </form>
          </div>
        </div>
      </li>
    @endforeach
  @endif
</ul>