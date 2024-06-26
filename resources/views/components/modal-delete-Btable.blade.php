{{-- 2人席モーダル --}}
<div class="modal fade" id="deleteBSeatModal" tabindex="-1" role="dialog" aria-labelledby="deleteBSeatModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteBSeatModalLabel">座席の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">2人席を1つ削除しますか？</p>
      </div>
      <div class="modal-footer">
        <form action="{{route('table.destroy')}}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="seat_type" value="B">
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>