<x-app-layout>
  <div class="container mt-5">
    <p class="h3 text-center"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;配膳状況</p>
  </div>

  @if (session('message'))
    <x-alert-message :type="session('type')" :message="session('message')" />
  @endif

  <div class="container w-75 mx-auto mt-5 d-flex flex-wrap">
    @foreach ($order_tables as $order_table)
      <div class="m-4 w-25">
        <x-accordion-serve :order-table-id="$order_table->id" :order-table-name="$order_table->name" :orders="$orders" />
      </div>
    @endforeach
  </div>
</x-app-layout>