<x-app-layout>
    @section('background-class', 'top-bg')
    @if (session('message'))
        <div class="alert alert-{{ session('type') }} text-center">
            {{ session('message') }}
        </div>
    @endif

    <x-button-link :total-orders="$total_orders" :total-checkouts="$total_checkouts" />

    <div class="container-reserve rounded bg-light p-4 mb-5 float-end me-5">
        <p class=""><i class="fa-solid fa-chair"></i>&nbsp;&nbsp;空席状況</p>
        @if ($totalSeats == 0)
            <p>座席が作成されていません。</p>
        @elseif ($unusedSeats == 0)
            <p class="text-danger">只今満席</p>
        @else
            {{$usingSeats}} / {{$totalSeats}}席 &nbsp;&nbsp;&nbsp;<span class="text-danger">残り{{$unusedSeats}}席</span>
        @endif


        <hr>

        @if ($todayReserves->isEmpty())
          <p>本日の予約</p>
          <p>本日の予約はありません。</p>
        @else
        {{-- 予約数が多い場合はaccordionを2つ作り午前と午後に分けても良いかも --}}
          <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">本日の予約</button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="text-center table table-hover">
                            <thead>
                                <tr>
                                    <th>✔️</th>
                                    <th>時間</th>
                                    <th>氏名</th>
                                    <th>人数</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayReserves as $reserve)
                                    @if ($reserve->status !== 'arrived')
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="change-reserve-status" data-reserve-id="{{$reserve->id}}" data-toggle="modal" data-target="#changeReserveModal{{$reserve->id}}">
                                                <x-modal-check-reserve :reserve-id="$reserve->id" :reserve-name="$reserve->name" />
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($reserve->time)->format('H:i')}}</td>
                                            <td>{{$reserve->name}}</td>
                                            <td>大人：{{$reserve->adult}}人&nbsp;&nbsp;子供：{{$reserve->kid}}人</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
        @endif
    </div>
</x-app-layout>

