<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => 'テーブル選択', 'link' => route('order.index')],
    ['name' => $table->seat_type . '-' . $table->seat_number . 'の注文', 'link' => '']
  ]" />
  @if ($errors->any())
      <x-error-message />
    @endif
  <div class="container mt-5">
    <p class="h3">テーブル名：{{$table->seat_type}}-{{$table->seat_number}}</p>
  </div>

  <div class="container-menu mt-3 rounded w-50 mx-auto p-5 mb-5">
    <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;メニュー</p>
       <form action="{{route('orders.store')}}" method="post">
        @csrf
        <x-menu :categories="$categories" :menus="$menus" />
        <input type="hidden" name="table_id" value="{{$table->id}}">
        <div class="text-center mt-5">
           <button type="submit" class="btn btn-success w-25">注文確認へ</button>
        </div>
      </form>
  </div>
</x-app-layout>