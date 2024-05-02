<x-app-layout>
    @if (session('message'))
      <x-alert-message :type="session('type')" :message="session('message')" />
    @endif

  <div class="container mt-5 w-50">
    <h3 class="text-center mb-5">{{$takeout->name}} 様のご注文内容</h3>
    <hr>
    <x-confirm-order :takeout-orders="$takeout_orders" />
    <hr>
    <div class="mt-5 text-center">
      <form action="{{route('takeout-order.sendMessage')}}" method="get">
        @csrf
        <button type="submit" class="btn btn-success w-25">注文確定</button>
      </form>
    </div>

    <div class="mt-5">
      <a href="{{route('takeout-order.create', $takeout->id)}}" class="btn bg-light">
        <i class="fa-solid fa-angles-left"></i>
        <span>注文画面へ戻る</span>
      </a>
    </div>
    
  </div>
</x-app-layout>