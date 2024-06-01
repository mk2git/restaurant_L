<x-app-layout>
    <div class="container my-5">
        <h2 class="text-center"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;座席編集</h2>
        @if(session('message'))
            <x-alert-message :type="session('type')" :message="session('message')" />
        @endif

        <div class="container border bg-light w-75 mt-3">
            <div class="row m-5">
                <div class="col-10">
                    <div class="container border bg-white d-flex flex-wrap">
                        @php $hasSeatTypeA = false; @endphp
                        @foreach ($tables as $table)
                            @if ($table->seat_type == 'A')
                                <x-Atable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                                    @php $hasSeatTypeA = true; @endphp
                            @endif
                        @endforeach
                        @if (!$hasSeatTypeA)
                             <p style="height: 100px;">現在4人席の座席はありません。</p>
                        @endif
                    </div>    
                    <div class="container border bg-white d-flex flex-wrap">
                        @php $hasSeatTypeB = false; @endphp
                        @foreach ($tables as $table)
                            @if ($table->seat_type == 'B')
                                <x-Btable-style :seat-type="$table->seat_type" :seat-number="$table->seat_number" />
                                    @php $hasSeatTypeB = true; @endphp
                            @endif
                        @endforeach
                        @if (!$hasSeatTypeB)
                             <p style="height: 100px;">現在2人席の座席はありません。</p>
                        @endif
                    </div>                      
                </div>

                {{-- Aは4人席、Bは2人席用 --}}
                <div class="col-2">
                    <div class="bg-white p-3 border rounded mb-3">
                        <p>4人席</p>
                        <div class="d-flex">
                            <form action="{{route('table.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="seat_type" value="A">
                                <button type="submit" class="btn"><i class="fa-solid fa-plus text-danger"></i></button>
                            </form>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteASeatModal">
                                <i class="fa-solid fa-minus text-primary"></i>
                            </button>
                            <x-modal-delete-Atable :atables="$tables" />
                        </div>
                    </div>

                    <div class="bg-white p-3 border rounded">
                        <p>2人席</p>
                        <div class="d-flex">
                            <form action="{{route('table.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="seat_type" value="B">
                                <button type="submit" class="btn"><i class="fa-solid fa-plus text-danger"></i></button>
                            </form>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteBSeatModal">
                                <i class="fa-solid fa-minus text-primary"></i>
                            </button>
                            <x-modal-delete-Btable :tables="$tables" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>