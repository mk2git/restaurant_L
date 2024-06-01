{{-- 4人席用モーダル --}}
<div class="modal fade" id="deleteASeatModal" tabindex="-1" role="dialog" aria-labelledby="deleteASeatModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteASeatModalLabel">座席の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">4人席を1つ削除しますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('table.destroy')}}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="seat_type" value="A">
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>


