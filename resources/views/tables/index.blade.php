<x-app-layout>
    <x-breadcrumb :list="[
        ['name' => '座席指定', 'link' => '']
        ]" />
{{-- 座席を簡易的なレストラン図に並べる --}}
    <h3 class="text-center my-5"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;座席</h3>
    <div class="my-5 mx-0 mx-auto table-container">
        <div class="bg-light p-2">
            <div class="row bg-white m-2 mb-1">
                <div class="col-10 d-flex justify-content-start flex-wrap px-0">
                    @foreach ($tables as $table)
                        @if ($table->seat_type == 'A' && $table->status == config('table.未使用'))
                            <button type="button" class="btn p-0 btn-Atable" data-bs-toggle="modal" data-bs-target="#unusedTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                            </button>
                            <x-modal-unused-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />                           
                        @elseif(($table->seat_type == 'A' && $table->status == config('table.使用中')))
                            <button type="button" class="btn p-0 btn-Atable" data-bs-toggle="modal" data-bs-target="#usingTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" colorA="blue" />
                            </button>
                            <x-modal-using-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @endif
                  @endforeach
                </div>
                <div class="col-2">
                    <div class="mt-3">
                        <i class="fa-solid fa-restroom border-secondary border rounded p-1 p-md-2"></i>
                    </div>
                </div>
            </div>
            {{-- <hr> --}}
            <div class="row bg-white m-2 mt-0">
                <div class="col-10 d-flex justify-content-between flex-wrap px-0">
                    @foreach ($tables as $table)
                        @if ($table->seat_type == 'B' && $table->status == config('table.未使用'))
                            <button type="button" class="btn p-0 btn-Btable" data-bs-toggle="modal" data-bs-target="#unusedTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                            </button>
                            <x-modal-unused-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @elseif($table->seat_type == 'B' && $table->status == config('table.使用中'))
                            <button type="button" class="btn p-0 btn-Btable" data-bs-toggle="modal" data-bs-target="#usingTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                            </button>
                            <x-modal-using-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @endif
                   @endforeach
                </div>
                <div class="col-2 border d-flex align-items-center justify-content-center">
                    <span class="kitchen-size">厨房</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
