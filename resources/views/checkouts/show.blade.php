<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => route('checkout.select')],
    ['name' => 'テーブル会計', 'link' => route('checkout.index')],
    ['name' => $table->seat_type . '-' . $table->seat_number, 'link' => '']
  ]" />
  <div class="container my-5">
      @if ($errors->any())
         <x-error-message />
      @endif
      
    <div class="container bg-light p-3 bill-outside">
      <h3 class="text-center my-4"><i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;お会計</h3>
      <div class="bill-inside bg-white px-4 pt-5 pb-3 mb-4">
        <p class="border-bottom border-2 d-flex justify-content-between">
          <span class="h4 ps-3">{{$table_name}}</span> 
          <small class="pt-3">{{$checkoutTime->created_at->format('Y-m-d H:i')}}</small>
        </p>
        
        <x-show-bill :orders="$orders" />

        <p>支払い方法</p>
        <form action="{{route('checkout.updateCheckStatus')}}" method="post">
            @csrf
            @method('put') 
            <x-payment-form />
      </div>
     
      <div class="text-center">
          <input type="hidden" name="table_id" value="{{$table->id}}">
          <button type="submit" class="btn checkout-btn d-block mx-auto mb-2">CheckOut</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>