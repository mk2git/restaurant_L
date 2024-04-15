<x-app-layout>
    <div class="container my-5">
        <h2 class="text-center"><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;座席編集</h2>
        @if(session('message'))
            <x-alert-message :type="session('type')" :message="session('message')" />
        @endif

        <div class="container border bg-light w-75 mt-3">
            <div class="row m-5">
                <div class="col-10">
                    {{-- ここにAとBを作成順にとりあえず並べる --}}
                    {{-- seat --}}
                    @if ($Atables->isEmpty())
                        <div class="container border bg-white" style="height: 200px;">
                            <p>現在4人席の座席はありません。</p>
                        </div>
                    @else
                        <div class="container border bg-white d-flex flex-wrap">
                        @foreach ($Atables as $Atable)
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
                        @endforeach
                        </div>
                    @endif

                    @if ($Btables->isEmpty())
                        <div class="container border bg-white mt-2 pt-2">
                            <p>現在2人席の座席はありません。</p>
                        </div>
                    @else
                        <div class="container border bg-white d-flex flex-wrap mt-2">
                        @foreach ($Btables as $Btable)
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
                        @endforeach
                        </div>
                    @endif
                </div>

                {{-- Aは4人席、Bは2人席用 --}}
                <div class="col-2">
                    <div class="bg-white p-3 border rounded mb-3">
                        <p>4人席</p>
                        <div class="d-flex">
                            <form action="{{route('table.store', count($Atables))}}" method="post">
                                @csrf
                                <input type="hidden" name="name" value="A-">
                                <button type="submit" class="btn"><i class="fa-solid fa-plus text-danger"></i></button>
                            </form>
                            <button type="submit" class="btn" data-toggle="modal" data-target="#deleteASeatModal"><i class="fa-solid fa-minus text-primary"></i></button>
                            <x-modal-delete-Atable :atables="$Atables" />
                        </div>
                    </div>

                    <div class="bg-white p-3 border rounded">
                        <p>2人席</p>
                        <div class="d-flex">
                            <form action="{{route('table.store' , count($Btables))}}" method="post">
                                @csrf
                                <input type="hidden" name="name" value="B-">
                                <button type="submit" class="btn"><i class="fa-solid fa-plus text-danger"></i></button>
                            </form>
                            <button type="submit" class="btn" data-toggle="modal" data-target="#deleteBSeatModal"><i class="fa-solid fa-minus text-primary"></i></button>
                            <x-modal-delete-Btable :btables="$Btables" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>