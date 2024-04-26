<x-app-layout>
  <div class="mt-3 ms-5">
    <a href="{{route('dashboard')}}" class="text-decoration-none text-black"> <i class="fa-solid fa-house"></i></a>&nbsp; >&nbsp; 会計選択
  </div>
  <div class="container-select mt-5">
    <h3 class="text-center mb-5">どちらの会計を行いますか？</h3>

    <div class=" mt-5 text-center">
      <a href="{{route('checkout.index')}}" class="btn btn-color serve-botton me-5 p-3">
        <i class="fa-solid fa-chair d-block"></i>
        <span class="serve-count">{{$count_checkouts}}</span>
        <span>テーブル</span>
      </a>
      <a href="{{route('takeout-check.index')}}" class="btn btn-color serve-botton p-3 ms-5">
        <i class="fa-solid fa-bag-shopping d-block"></i>
        <span class="serve-count">{{$count_takeout_checkouts}}</span>
        <span>テイクアウト</span>
      </a>
    </div>
  </div>
</x-app-layout>