<x-app-layout>
    <x-breadcrumb :list="[
            ['name' => '注文テーブル選択', 'link' => ''],
        ]"
    />

    <div class="container w-75 mx-auto my-5">
        <h3 class="text-center mb-5"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;どのテーブルの注文を受け付けますか？</h3>

        <div class="container border bg-light p-5 mb-5">
            <div class="row bg-white">
                <div class="col-10 d-flex justify-content-between flex-wrap">
                    @foreach ($tables as $table)
                        @if ($table->seat_type == 'A' && $table->status == config('table.未使用'))
                            <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @elseif($table->seat_type == 'A' && $table->status == config('table.使用中'))
                        <button type="button" class="btn p-0 select-Atable" data-bs-toggle="modal" data-bs-target="#selectTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                             <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                        </button>
                        <x-modal-select-order-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
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
                        @if ($table->seat_type == 'B' && $table->status == config('table.未使用'))
                             <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @elseif($table->seat_type == 'B' && $table->status == config('table.使用中'))
                            <button type="button" class="btn p-0 select-Btable" data-bs-toggle="modal" data-bs-target="#selectTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                            </button>
                            <x-modal-select-order-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
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