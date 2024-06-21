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

  <div class="container-menu rounded p-3 my-5">
    <div class="menu-paper p-4 p-md-5">
       <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;Menu</p>
       <form action="{{route('orders.store')}}" method="post">
          @csrf
          <x-menu :categories="$categories" :menus="$menus" />
          <input type="hidden" name="table_id" value="{{$table->id}}" class="w-100">
          <div class="text-center mt-5">
            <button type="submit" class="btn btn-success w-50">注文確認へ</button>
          </div>
        </form>
     </div>
  </div>
</x-app-layout>