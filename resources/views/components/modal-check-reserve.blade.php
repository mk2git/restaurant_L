<script>
    $(document).ready(function() {
      $('.change-reserve-status').click(function() {
            // チェックされたらモーダルを表示
            if ($(this).is(':checked')) {
                var reserveId = $(this).data('reserve-id');
                $('#changeReserveModal' + reserveId).modal('show');
            }
     });
    });
    // モーダル閉じたらチェックボタンのチェックなくす設定
    $(document).ready(function() {
        $('.modal').on('hidden.bs.modal', function (e) {
            var reserveId = $(this).attr('id').replace('changeReserveModal', '');
            $('input.change-reserve-status[data-reserve-id="' + reserveId + '"]').prop('checked', false);
        });
    });
</script>

<div class="modal fade" id="changeReserveModal{{$reserveId}}" tabindex="-1"  aria-labelledby="changeReserveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"><i class="fa-solid fa-people-group"></i>&nbsp;&nbsp;来店確認</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p class="text-center"><span class="fw-bold text-decoration-underline">{{$reserveName}}</span> 様が来店されましたか？</p>
              <form action="{{route('reserve.changeStatus', $reserveId)}}" method="post">
                  @csrf
                  @method('put')
                  <input type="hidden" name="reserve_id" value="{{$reserveId}}">
                  <button type="submit" class="btn btn-success">来店</button>
              </form>
          </div>

      </div>
  </div>
</div>
