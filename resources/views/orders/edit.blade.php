<x-app-layout>
  @if (session('message'))
    <x-alert-message :type="session('type')" :message="session('message')" />
  @endif

  <div class="container mt-5 w-75">
    <h2 class=""><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;注文確認</h2>
    <hr>
    <ul class="my-5">
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
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <input type="hidden" name="table_id" value="{{$order->table_id}}">
                <select name="quantity" class="form-control">
                  @for ($i=1; $i <= 10; $i++)
                    <option value="{{$i}}" @if($order->quantity == $i) selected @endif>{{$i}}</option>
                  @endfor
                </select>
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-success w-50">更新</button>
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
    </ul>

    <hr>

    <div class="mt-5 text-center">
      <a href="{{route('dashboard', ['message' => '注文が確定しました', 'type' => 'success'])}}" class="btn btn-success w-50">注文確定</a>
    </div>

    <div class="mt-5">
      <a href="{{route('orders.create', $order->table_id)}}" class="btn btn-primary">
        <i class="fa-solid fa-angles-left"></i>
        <span>注文画面へ戻る</span>
      </a>
    </div>
    
  </div>
</x-app-layout>
