<x-app-layout>
  <div class="container-takeout">
    <div class="left-half"></div>

    <div class="right-half p-5">
      {{-- エラーメッセージ --}}
          @if ($errors->any())
            <x-error-message />
          @endif
      <div class="form-border border rounded p-3 takeout-form">
        <h3 class="text-center my-4"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;Takeout</h3>
         
        <form action="{{route('takeout.store')}}" method="post">
            @csrf
           <input type="text" name="name" id="name" class="form-control w-75 mx-auto" placeholder="Name">
           <input type="text" name="phone_number" id="phone_number" class="form-control w-75 mx-auto mt-4" placeholder="電話番号">
            
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-success w-50 form-btn">注文へ</button>
            <hr class="w-75 mx-auto">
            <a href="{{route('dashboard')}}" class="btn btn-light d-block mt-3 w-25 mx-auto"><i class="fa-solid fa-house text-secondary"></i></a>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>