<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '配膳状況一覧', 'link' => '']
  ]" />

  @if (session('message'))
    <x-alert-message :type="session('type')" :message="session('message')" />
  @endif
  <div class="container mt-5">
    <p class="h3 text-center"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;配膳状況</p>
    <hr class="w-75 mx-auto">
  </div>

  <div class="container w-75 mx-auto mt-5 d-flex flex-wrap">
    @if ($orders->isEmpty())
      <p class="text-center">テーブルの注文はありません。</p>
    @else
      @foreach ($order_tables as $order_table)
        <div class="m-4 w-serve">
          <x-accordion-serve :order-table-id="$order_table->id" :order-table-seat-type="$order_table->seat_type" :order-table-seat-number="$order_table->seat_number" :orders="$orders" />
        </div>
      @endforeach
    @endif
    
  </div>

  <div class="container mt-5">
    <p class="h3 text-center"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;テイクアウトの状況</p>
    <hr class="w-75 mx-auto">
  </div>

  <div class="container w-75 mx-auto my-5 d-flex flex-wrap">
    @if ($takeout_orders->isEmpty())
      <p class="text-center">テイクアウトの注文はありません。</p>
    @else
      @foreach ($takeout_order_names as $takeout_order_name)
        <div class="m-4 w-serve">
          <x-accordion-takeout-serve :takeout-order-id="$takeout_order_name->id" :takeout-order-name="$takeout_order_name->name" :takeout-orders="$takeout_orders" />
        </div>
      @endforeach
    @endif
   
  </div>
</x-app-layout>