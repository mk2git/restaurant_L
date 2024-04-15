<x-app-layout>
{{-- 座席を簡易的なレストラン図に並べる --}}
    <div class="container w-75 mx-auto my-5">
        <h3 class="text-center mb-5"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;座席</h3>

        <div class="container border bg-light p-5 mb-5">
            <div class="row bg-white">
                <div class="col-10 d-flex justify-content-between flex-wrap">
                    @foreach ($Atables as $Atable)
                      @if ($Atable->status == '未使用')
                        <button type="button" class="btn edit-unused-Atable" data-bs-toggle="modal" data-bs-target="#unusedTableAModal{{$Atable->id}}" data-table-id="{{ $Atable->id }}">
                            <div class="m-3">
                                <div class="d-flex">
                                    <div class="bg-light border rounded-circle ms-1 seat1" style="height: 25px; width: 25px;"></div>
                                    <div class="bg-light border rounded-circle ms-3 seat2" style="height: 25px; width: 25px;"></div>
                                </div>

                                <div class="bg-light border d-flex align-items-center justify-content-center" style="height: 70px; width: 70px;">
                                    <span>{{$Atable->name}}</span>
                                </div>
                                <div class="d-flex">
                                    <div class="bg-light border rounded-circle ms-1 seat1" style="height: 25px; width: 25px;"></div>
                                    <div class="bg-light border rounded-circle ms-3 seat2" style="height: 25px; width: 25px;"></div>
                                </div>
                            </div>
                        </button>
                        <x-modal-unused-Atable :atable-id="$Atable->id" :atable-name="$Atable->name" />
                      @else
                      <button type="button" class="btn edit-using-Atable" data-bs-toggle="modal" data-bs-target="#usingTableAModal{{$Atable->id}}" data-table-id="{{ $Atable->id }}">
                            <div class="m-3 using-table">
                            <div class="d-flex">
                                <div class="border rounded-circle ms-1 seat1" style="height: 25px; width: 25px;"></div>
                                <div class="border rounded-circle ms-3 seat2" style="height: 25px; width: 25px;"></div>
                            </div>

                            <div class="border d-flex align-items-center justify-content-center" style="height: 70px; width: 70px;">
                                <span>{{$Atable->name}}</span>
                            </div>
                            <div class="d-flex">
                                <div class="border rounded-circle ms-1 seat1" style="height: 25px; width: 25px;"></div>
                                <div class="border rounded-circle ms-3 seat2" style="height: 25px; width: 25px;"></div>
                            </div>
                        </div>
                      </button>
                    <x-modal-using-Atable :atable-id="$Atable->id" :atable-name="$Atable->name" />
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
                        <button type="button" class="btn edit-unused-Btable" data-bs-toggle="modal" data-bs-target="#unusedTableBModal{{$Btable->id}}" data-table-id="{{ $Btable->id }}">
                            <div class="m-3">
                                <div class="d-flex">
                                    <div class="bg-light border rounded-circle ms-3 seat1" style="height: 25px; width: 25px;"></div>
                                </div>

                                <div class="bg-light border d-flex align-items-center justify-content-center" style="height: 70px; width: 50px;">
                                    <span>{{$Btable->name}}</span>
                                </div>
                                <div class="d-flex">
                                    <div class="bg-light border rounded-circle ms-3 seat1" style="height: 25px; width: 25px;"></div>
                                </div>
                            </div>
                        </button>
                        <x-modal-unused-Btable :btable-id="$Btable->id" :btable-name="$Btable->name" />
                        @else
                        <button type="button" class="btn edit-using-Btable" data-bs-toggle="modal" data-bs-target="#usingTableBModal{{$Btable->id}}" data-table-id="{{ $Btable->id }}">
                             <div class="m-3 using-table">
                                <div class="d-flex">
                                    <div class="border rounded-circle ms-3 seat1" style="height: 25px; width: 25px;"></div>
                                </div>

                                <div class="border d-flex align-items-center justify-content-center" style="height: 70px; width: 50px;">
                                    <span>{{$Btable->name}}</span>
                                </div>
                                <div class="d-flex">
                                    <div class="border rounded-circle ms-3 seat1" style="height: 25px; width: 25px;"></div>
                                </div>
                            </div>
                        </button>
                        <x-modal-using-Btable :btable-id="$Btable->id" :btable-name="$Btable->name" />
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
