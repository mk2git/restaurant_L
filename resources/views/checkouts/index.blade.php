<x-app-layout>
  <div class="container my-5 text-center">
    <h3><i class="fa-solid fa-cash-register"></i>&nbsp;&nbsp;どのテーブルの会計を行いますか？</h3>
  </div>

  <div class="container border bg-light p-5 mb-5 w-75">
    <div class="row bg-white">
      <div class="col-10 d-flex justify-content-between flex-wrap">
        @foreach ($Atables as $Atable)
          @foreach ($checkoutTables as $checkoutTable)
            @if ($Atable->id == $checkoutTable->table_id && $checkoutTable->check_status == 'not yet')
              <button type="button" class="btn select-Atable" data-bs-toggle="modal" data-bs-target="#selectCheckTableAModal{{$Atable->id}}" data-Atable-id="{{ $Atable->id }}">
                 <div class="m-3 check-table">
                    <x-Atable-style :atable-name="$Atable->name" />
                  </div>
              </button>
              <x-modal-select-check-Atable :atable-id="$Atable->id" :atable-name="$Atable->name" />
            @else
              <div class="m-3">
                <x-Atable-style :atable-name="$Atable->name" />
              </div>
            @endif
          @endforeach
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
        @foreach ($Btables as $Btable)
          @foreach ($checkoutTables as $checkoutTable)
            @if ($Btable->id == $checkoutTable->table_id && $checkoutTable->check_status == 'not yet')
              <button type="button" class="btn select-Btable" data-bs-toggle="modal" data-bs-target="#selectCheckTableAModal{{$Btable->id}}" data-Btable-id="{{ $Btable->id }}">
                 <div class="m-3 check-table">
                    <x-Btable-style :btable-name="$Btable->name" />
                  </div>
              </button>
              <x-modal-select-check-Btable :btable-id="$Btable->id" :btable-name="$Btable->name" />
            @else
              <div class="m-3">
                <x-Btable-style :btable-name="$Btable->name" />
              </div>
            @endif
          @endforeach
        @endforeach
      </div>
      <div class="col-2 border d-flex align-items-center justify-content-center">
        <span>厨房</span>
    </div>
    </div>
  </div>
</x-app-layout>