<x-app-layout>
    <div class="mt-3 ms-5">
        <a href="{{route('dashboard')}}" class="text-decoration-none text-black"> <i class="fa-solid fa-house"></i></a>&nbsp; > 予約
    </div>
    <div class="container mt-5 w-50">
        {{-- エラーメッセージ --}}
        @if ($errors->any())
          <x-error-message />
        @endif

        {{-- 予約確定メッセージ --}}
        @if (session('message'))
           <x-alert-message :type="session('type')" :message="session('message')" />
        @endif
        
        <x-card-reserve />
        <x-modal-add-reserve />
    </div>

    <div class="my-5 d-flex justify-content-center aline-center">
       <hr class="w-75">
    </div>

    <div class="container mb-5">
        <h2 class="text-center mb-3">予約一覧</h2>

        <form action="{{route('reserve.getDate')}}" method="post">
            @csrf
            <div class="w-25 mb-3 mx-auto">
                <select name="date" class="form-control" onchange="this.form.submit()">
                    <option value="" disabled @if(!isset($selectedDates) || !isset($selectedAllDates)) selected @endif>日付指定可能</option>
                    @foreach ($dates as $date)
                        <option value="{{$date}}" @if ($date == $selectedDate) selected @endif>{{$date}}</option>
                    @endforeach
                    <option value="all" @if (isset($selectedAllDates)) selected @endif>全ての予約</option>
                </select>
            </div>
        </form>
        <table class="table table-hover w-75 mx-auto">
            <thead>
                <tr class="table-active text-center">
                    <th>日付</th>
                    <th>時間</th>
                    <th>氏名</th>
                    <th>人数</th>
                    <th>電話番号</th>
                    <th>編集</th>
                    <th>キャンセル</th>
                </tr>
            </thead>
            <tbody>
                @if (!isset($selectedDates) || isset($selectedAllDates))
                    @foreach ($reserves as $reserve)
                        <tr class="text-center">
                            <td>
                                {{Carbon\Carbon::createFromFormat('Y-m-d', $reserve->date)->format('n月j日')}}
                            </td>
                            <td>
                                {{Carbon\Carbon::createFromFormat('H:i:s', $reserve->time)->format('H:i')}}
                            </td>
                            <td>{{$reserve->name}}</td>
                            <td>大人：{{$reserve->adult}}人 &nbsp;&nbsp;子供：{{$reserve->kid}}人</td>
                            <td>{{$reserve->phone_number}}</td>
                            <td>
                                <button type="button" class="btn edit-reserve" data-toggle="modal" data-target="#editReserveModal{{$reserve->id}}" data-reserve-id="{{ $reserve->id }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <x-modal-edit-reserve :reserve-id="$reserve->id"  :reserve-name="$reserve->name" :reserve-date="$reserve->date" :reserve-time="$reserve->time" :reserve-adult="$reserve->adult" :reserve-kid="$reserve->kid" :reserve-phone-number="$reserve->phone_number" />
                            </td>
                            <td>
                                <button type="button" class="btn" data-toggle="modal" data-target="#deleteReserveModal{{$reserve->id}}" data-reserve-id="{{ $reserve->id }}">
                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                </button>
                                <x-modal-delete-reserve :reserve-id="$reserve->id" :reserve-name="$reserve->name" :reserve-date="$reserve->date" :reserve-time="$reserve->time" :reserve-adult="$reserve->adult" :reserve-kid="$reserve->kid" />
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($selectedDates as $selectedDate)
                        @foreach ($reserves as $reserve)
                            @if ($reserve->date == $selectedDate->date)
                                <tr class="text-center">
                                    <td>{{ \Carbon\Carbon::parse($reserve->date)->format('n月j日') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reserve->time)->format('H:i') }}</td>
                                    <td>{{ $reserve->name }}</td>
                                    <td>大人：{{ $reserve->adult }}人 &nbsp;&nbsp;子供：{{ $reserve->kid }}人</td>
                                    <td>{{ $reserve->phone_number }}</td>
                                    <td>
                                        <button type="button" class="btn edit-reserve" data-toggle="modal" data-target="#editReserveModal{{$reserve->id}}" data-reserve-id="{{ $reserve->id }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <x-modal-edit-reserve :reserve-id="$reserve->id"  :reserve-name="$reserve->name" :reserve-date="$reserve->date" :reserve-time="$reserve->time" :reserve-adult="$reserve->adult" :reserve-kid="$reserve->kid" :reserve-phone-number="$reserve->phone_number" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#deleteReserveModal{{$reserve->id}}" data-reserve-id="{{ $reserve->id }}">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </button>
                                        <x-modal-delete-reserve :reserve-id="$reserve->id" :reserve-name="$reserve->name" :reserve-date="$reserve->date" :reserve-time="$reserve->time" :reserve-adult="$reserve->adult" :reserve-kid="$reserve->kid" />
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                        @break
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>


