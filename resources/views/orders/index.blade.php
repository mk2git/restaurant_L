<x-app-layout>

    <x-breadcrumb :list="[
            ['name' => '注文受付', 'link' => route('order.index')],
            ['name' => 'A1', 'link' => '']
        ]"
    />

    <div class="container w-75 mx-auto my-5">
        <h3 class="text-center mb-5"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;どのテーブルの注文を受け付けますか？</h3>

        <div class="container border bg-light p-5 mb-5">
            <div class="row bg-white">
                <div class="col-10 d-flex justify-content-between flex-wrap">
                    @foreach ($Atables as $Atable)
                        @if ($Atable->status == '未使用')
                            <div class="m-3">
                                <x-Atable-style :atable-name="$Atable->name" />
                            </div>
                            
                        @else
                        <button type="button" class="btn select-Atable" data-bs-toggle="modal" data-bs-target="#selectTableAModal{{$Atable->id}}" data-Atable-id="{{ $Atable->id }}">
                            <div class="m-3 using-table">
                                <x-Atable-style :atable-name="$Atable->name" />
                        </div>
                        </button>
                        <x-modal-select-order-Atable :atable-id="$Atable->id" :atable-name="$Atable->name" />
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
                    @foreach ($Btables as $Btable)
                    {{-- @dd($Btable) --}}
                        @if ($Btable->status == '未使用')
                            <div class="m-3">
                                <x-Btable-style :btable-name="$Btable->name" />
                            </div>
                        @else
                            <button type="button" class="btn select-Btable" data-bs-toggle="modal" data-bs-target="#selectTableBModal{{$Btable->id}}" data-Btable-id="{{ $Btable->id }}">
                                <div class="m-3 using-table">
                                    <x-Btable-style :btable-name="$Btable->name" />
                                </div>
                            </button>
                            <x-modal-select-order-Btable :btable-id="$Btable->id" :btable-name="$Btable->name" />
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