<x-app-layout>
    <div class="mt-3 ms-5">
        <a href="{{route('dashboard')}}" class="text-decoration-none text-black"><i class="fa-solid fa-house"></i></a> &nbsp;> 座席指定
    </div>
{{-- 座席を簡易的なレストラン図に並べる --}}
    <div class="container w-75 mx-auto my-5">
        <h3 class="text-center mb-5"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;座席</h3>

        <div class="container border bg-light p-5 mb-5">
            <div class="row bg-white">
                <div class="col-10 d-flex justify-content-between flex-wrap">
                    @foreach ($tables as $table)
                      @if ($table->seat_type == 'A' && $table->status == 1)
                            <button type="button" class="btn edit-unused-Atable" data-bs-toggle="modal" data-bs-target="#unusedTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                            </button>
                            <x-modal-unused-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                      @elseif(($table->seat_type == 'A' && $table->status == 2))
                            <button type="button" class="btn edit-using-Atable" data-bs-toggle="modal" data-bs-target="#usingTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" colorA="blue" />
                            </button>
                            <x-modal-using-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
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
                        @if ($table->seat_type == 'B' && $table->status == 1)
                            <button type="button" class="btn edit-unused-Btable" data-bs-toggle="modal" data-bs-target="#unusedTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                 <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                            </button>
                            <x-modal-unused-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @elseif($table->seat_type == 'B' && $table->status == 2)
                            <button type="button" class="btn edit-using-Btable" data-bs-toggle="modal" data-bs-target="#usingTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                 <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                            </button>
                            <x-modal-using-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
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
