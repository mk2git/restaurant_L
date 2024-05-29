<x-app-layout>
  <x-breadcrumb :list="[
    ['name' => '会計選択', 'link' => route('checkout.select')],
    ['name' => 'テーブル会計', 'link' => '']
  ]" />
  <div class="container my-5 text-center w-75">
    <h3 class="mb-5"><i class="fa-solid fa-cash-register"></i>&nbsp;&nbsp;どのテーブルの会計を行いますか？</h3>
  
    <div class="container-table border bg-light p-5 mb-5">
      <div class="row bg-white">
        <div class="col-10 d-flex justify-content-between flex-wrap">
          @foreach ($tables as $table)
            @foreach ($checkoutTables as $checkoutTable)
                @if($table->seat_type == 'A' && $table->id == $checkoutTable->table_id)
                    <button type="button" class="btn select-Atable" data-bs-toggle="modal" data-bs-target="#selectCheckTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                        <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="check-table" />
                    </button>
                    <x-modal-select-check-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" /> 
                @endif
              @endforeach
              @if ($table->seat_type == 'A' && $table->status == config('table.未使用'))
                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
              @endif
            @endforeach
        </div>
        <div class="col-2">
          <div class="mt-3">
              <i class="fa-solid fa-restroom h3"></i>
          </div>
        </div>
      </div>

      <hr class="w-75 m-0">

      <div class="row bg-white">
        <div class="col-10 d-flex justify-content-between flex-wrap">
          @foreach ($tables as $table)
            @foreach ($checkoutTables as $checkoutTable)
                @if($table->seat_type == 'B' && $table->id == $checkoutTable->table_id)
                    <button type="button" class="btn select-Btable" data-bs-toggle="modal" data-bs-target="#selectCheckTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                        <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="check-table" />
                    </button>
                    <x-modal-select-check-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" /> 
                @endif
              @endforeach
              @if ($table->seat_type == 'B' && $table->status == config('table.未使用'))
                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
              @endif
            @endforeach
        </div>
        <div class="col-2 border d-flex align-items-center justify-content-center">
          <span>厨房</span>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>