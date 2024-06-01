{{-- 2人席未使用モーダル --}}
<div class="modal fade" id="unusedTableBModal{{$tableId}}" tabindex="-1" role="dialog" aria-labelledby="unusedTableBModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unusedTableBModalLabel">座席</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">{{ $seatType }}-{{$seatNumber}}を使用しますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{route('table.update', $tableId)}}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-success">使用する</button>
        </form>
      </div>
    </div>
  </div>
</div>