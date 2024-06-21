<x-app-layout>
  @if (session('message'))
    <x-alert-message :type="session('type')" :message="session('message')" />
  @endif

  <div class="container mt-5 container-confirm">
    <h2 class="mb-4 border-bottom border-3 border-secondary"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;注文確認</h2>
    <x-confirm-order :orders="$orders" />
    <hr>
    <div class="mt-5 text-center">
        <form action="{{route('orders.changeOrderStatus')}}" method="post">
          @csrf
          @method('put')
          <input type="hidden" name="table_id" value="{{$table_id}}">
          <button type="submit" class="btn btn-success w-25">確定</button>
        </form>
    </div>

    <div class="my-5">
      <a href="{{route('orders.create', $table_id)}}" class="btn bg-light">
        <i class="fa-solid fa-angles-left"></i>
        <span>注文画面へ戻る</span>
      </a>
    </div>
    
  </div>
</x-app-layout>
