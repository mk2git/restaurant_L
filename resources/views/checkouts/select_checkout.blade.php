<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => '']
  ]" />
  
  <div class="mt-5">
    <h3 class="text-center mb-5">どちらの会計を行いますか？</h3>

    <div class="d-flex justify-content-center mt-5 text-center container-select">
      <div class="">
         <a href="{{route('checkout.index')}}" class="btn btn-color serve-botton me-4 p-3">
             <i class="fa-solid fa-chair d-block"></i>
             <span class="serve-count">{{$count_checkouts}}</span>
            <span>テーブル</span>
         </a>
      </div>
      <div class="">
        <a href="{{route('takeout-check.index')}}" class="btn btn-color serve-botton p-3 ms-4">
          <i class="fa-solid fa-bag-shopping d-block"></i>
          <span class="serve-count">{{$count_takeout_checkouts}}</span>
          <span>テイクアウト</span>
        </a>
      </div>
    </div>
  </div>
</x-app-layout>