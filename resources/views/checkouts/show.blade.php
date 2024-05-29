<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => route('checkout.select')],
    ['name' => 'テーブル会計', 'link' => route('checkout.index')],
    ['name' => $table->seat_type . '-' . $table->seat_number, 'link' => '']
  ]" />
  <div class="container mt-5 w-75">
      @if ($errors->any())
         <x-error-message />
      @endif
      
    <div class="container bg-light p-5">
      <h3 class="text-center mb-4"><i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;お会計</h3>

      <div class="bill bg-white w-50 mx-auto px-4 pt-5 pb-3 mb-5">
        <p class="h4">テーブル：{{$table->name}}<small class="float-end h6 pt-3">{{$checkoutTime->created_at->format('Y-m-d H:i')}}</small></p>
        
        <hr>
        <x-show-bill :orders="$orders" />

        <p>支払い方法</p>
        <form action="{{route('checkout.updateCheckStatus')}}" method="post">
            @csrf
            @method('put') 
            <x-payment-form />
      </div>
     
      <div class="text-center">
          <input type="hidden" name="table_id" value="{{$table->id}}">
          <button type="submit" class="btn btn-success w-25">CheckOut</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>