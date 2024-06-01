<script>
  $(document).ready(function() {
      $('.change-reserve-status').click(function() {
          if ($(this).is(':checked')) {
              var reserveId = $(this).data('reserve-id');
              $.get('/dashboard/' + reserveId, function(data) {
                  $('#changeReserveModal' + reserveId).find('.modal-body').html(data);
                  $('#changeReserveModal'+ reserveId).modal('show');
              });
          }
      });

      // モーダルを閉じた時にチェックボックスのチェックをなくす設定
      // モーダルが閉じられたときのイベントリスナーを設定（まず.modalクラスを持つすべてのモーダルに対してhidden.bs.modalイベントリスナーを設定）
      $('.modal').on('hidden.bs.modal', function (e) {
          // モーダルに関連付けられたチェックボックスのdata-reserve-idを取得
          var reserveId = $(this).attr('id').replace('changeReserveModal', '');
          // 対応するチェックボックスを検索し、prop('checked', false)を使用してチェックを外す
          $('input.change-reserve-status[data-reserve-id="' + reserveId + '"]').prop('checked', false);
      });
      // モーダルを閉じた時にチェックボックスのチェックをなくす設定が正しく機能するためには、モーダルのIDとチェックボックスのdata-reserve-id属性が正しく設定されている必要がある！
  });
</script>

<div id="changeReserveModal{{$reserveId}}" class="modal fade" tabindex="-1" role="dialog">
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
