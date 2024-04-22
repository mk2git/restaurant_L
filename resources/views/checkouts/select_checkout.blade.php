<x-app-layout>
  <div class="container-select mt-5">
    <h3 class="text-center mb-5">どちらの会計を行いますか？</h3>

    <div class=" mt-5 text-center">
      <a href="{{route('checkout.index')}}" class="btn btn-color me-5 p-3">
        <i class="fa-solid fa-chair d-block"></i>
        <span>テーブル</span>
      </a>
      <a href="{{route('takeout-check.index')}}" class="btn btn-color p-3 ms-5">
        <i class="fa-solid fa-bag-shopping d-block"></i>
        <span>テイクアウト</span>
      </a>
    </div>
  </div>
</x-app-layout>