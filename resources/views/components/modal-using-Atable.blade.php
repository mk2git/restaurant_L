<script>
  $(document).ready(function() {
      $('.edit-using-Atable').click(function() {
          var tableId = $(this).data('table-id');
          $.get('/table/' + tableId, function(data) {
              $('#usingTableAModal' + tableId).find('.modal-body').html(data);
              $('#usingTableAModal' + tableId).modal('show');
          });
      });
  });
</script>

{{-- 4人席用使用中モーダル --}}
<div class="modal fade" id="usingTableAModal{{$tableId}}" tabindex="-1" role="dialog" aria-labelledby="usingTableAModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usingTableAModalLabel">座席の変更</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">{{ $seatType }}-{{$seatNumber}}の使用をやめますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{route('table.update', $tableId)}}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-danger">使用しない</button>
        </form>
      </div>
    </div>
  </div>
</div>
