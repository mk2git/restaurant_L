<x-app-layout>
    <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => route('checkout.select')],
    ['name' => 'テイクアウト会計', 'link' => route('takeout-check.index')],
    ['name' => $takeout->name . '様', 'link' => '']
  ]" />
  
  <div class="container my-5 w-75">
    @if ($errors->any())
      <x-error-message />
    @endif
    
    <div class="container bg-light p-5">
      <h3 class="text-center mb-4"><i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;お会計</h3>

      <div class="bill bg-white w-50 mx-auto px-4 pt-5 pb-2 mb-5">
        <p class="h4"><small>名前：</small>{{$takeout->name}} <small>様</small><small class="float-end h6 pt-3">{{$checkoutTime->created_at->format('Y-m-d H:i')}}</small></p>
        
        <hr>
        <x-show-bill :orders="$takeout_orders" />

        <p>支払い方法</p>
         <form action="{{route('takeout-check.updateCheckStatus')}}" method="post">
            @csrf
            @method('put')
            <x-payment-form />
      </div>
     
      <div class="text-center">
          <input type="hidden" name="takeout_id" value="{{$takeout->id}}">
          <button type="submit" class="btn btn-success w-25">CheckOut</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>