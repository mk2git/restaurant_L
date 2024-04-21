<x-app-layout>
  <div class="container mt-5">
    <h3 class="text-center mb-5">{{$takeout->name}} 様のご注文内容</h3>
    {{-- <hr class="w-50 mx-auto"> --}}
    @if (session('message'))
      <x-alert-message :type="session('type')" :message="session('message')" />
    @endif

    <table class="table table-borderless table-hover align-middle w-50 mx-auto mt-5 text-center">
      <thead class="border-bottom">
        <tr>
          <th>料理名</th>
          <th></th>
          <th>数量</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($menus as $menu)
          @foreach ($takeout_orders as $takeout_order)
            @if ($menu->id == $takeout_order->menu_id)
              <tr>
                <td>{{$menu->name}}</td>
                <td>・・・・・</td>               
                <td>
                    <form action="{{route('takeout-order.update', $takeout_order->id)}}" method="post">
                      @csrf
                      @method('put')
                      <select name="quantity" class="form-control">
                        @for ($i=0; $i <= 10; $i++)
                          <option @if ($i == $takeout_order->quantity) selected @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                  </td>
                  <td>
                    <input type="hidden" name="takeout_id" value="{{$takeout_order->takeout_id}}">
                    <button type="submit" class="btn btn-success">更新</button>
                    </form> 
                  </td>
                  <td>
                    <form action="{{route('takeout-order.delete', $takeout_order->id)}}" method="post">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="takeout_id" value="{{$takeout_order->takeout_id}}">
                      <button type="submit" class="btn"><i class="fa-regular fa-trash-can text-danger"></i></button>
                    </form>
                  </td>
              </tr>
            @endif
          @endforeach
        @endforeach
      </tbody>
    </table>
    
  </div>
</x-app-layout>