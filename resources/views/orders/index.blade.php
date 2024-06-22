<x-app-layout>
    <x-breadcrumb :list="[
            ['name' => '注文テーブル選択', 'link' => ''],
        ]"
    />

    <h3 class="text-center my-5 table-title"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;どのテーブルの注文を受け付けますか？</h3>
    
    <div class="my-5 mx-0 mx-auto table-container">
        <div class="bg-light p-2">
            <div class="row bg-white m-2 mb-1">              
                <div class="col-10 d-flex justify-content-start flex-wrap px-0">
                    @foreach ($tables as $table)
                        @if ($table->seat_type == 'A' && $table->status == config('table.未使用'))
                            <button class="btn p-0 btn-Atable">
                               <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" /> 
                            </button>                          
                        @elseif($table->seat_type == 'A' && $table->status == config('table.使用中'))
                            <button type="button" class="btn p-0 btn-Atable" data-bs-toggle="modal" data-bs-target="#selectTableAModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                            </button>
                            <x-modal-select-order-Atable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                        @endif
                    @endforeach
                </div>
                <div class="col-2">
                    <div class="mt-3">
                        <i class="fa-solid fa-restroom border-secondary border rounded p-1 p-md-2"></i>
                    </div>
                </div>
            </div>

            <div class="row bg-white m-2 mt-0">
                <div class="col-10 d-flex justify-content-between flex-wrap px-0">
                    @foreach ($tables as $table)
                        @if ($table->seat_type == 'B' && $table->status == config('table.未使用'))
                            <button class="btn p-0 btn-Btable">
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                            </button>
                            
                        @elseif($table->seat_type == 'B' && $table->status == config('table.使用中'))
                            <button type="button" class="btn p-0 btn-Btable" data-bs-toggle="modal" data-bs-target="#selectTableBModal{{$table->id}}" data-table-id="{{ $table->id }}">
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" class="using-table" />
                            </button>
                            <x-modal-select-order-Btable :table-id="$table->id" :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
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