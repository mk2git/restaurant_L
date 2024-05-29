<x-app-layout>
  <div class="container-takeout">
    <div class="left-half"></div>

    <div class="right-half p-5">
      {{-- エラーメッセージ --}}
          @if ($errors->any())
            <x-error-message />
          @endif
      <div class="form-border border rounded w-75 p-5 mx-auto">
        <h3 class="text-center mt-4"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;Takeout</h3>
        <hr class="w-75 mx-auto">
         
        <form action="{{route('takeout.store')}}" method="post">
            @csrf
            <div class="row mt-5">
              <div class="col-4">
                <label for="name" class="col-form-label">名前</label>
              </div>
              <div class="col-8">
                <input type="text" name="name" id="name" class="form-control">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-4">
                 <label for="phone_number" class="col-form-label">携帯電話</label>
              </div>
              <div class="col-8">
                  <input type="text" name="phone_number" id="phone_number" class="form-control">
              </div>
            </div>
            
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-success w-50 form-btn">注文へ</button>
            <hr class="w-75 mx-auto">
            <a href="{{route('dashboard')}}" class="btn btn-light d-block mt-3 w-50 mx-auto">ホームへ戻る</a>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</x-app-layout>