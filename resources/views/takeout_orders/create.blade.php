<x-app-layout>
  <div class="container mt-5">
    <p class="h4"><span class="fw-bold">{{$takeout->name}}</span>&nbsp;&nbsp;様</p>

    <div class="container-menu rounded p-3 my-5">
      <div class="menu-paper p-4 p-md-5">
        <p class="text-center h2"><i class="fa-solid fa-utensils"></i>&nbsp;&nbsp;Menu</p>
    
        <form action="{{route('takeout-order.store')}}" method="post">
          @csrf
          <x-menu :categories="$categories" :menus="$menus" />
          <input type="hidden" name="takeout_id" value="{{$takeout->id}}">
          <div class="text-center mt-5">
            <button type="submit" class="btn btn-success w-50">注文確認へ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>