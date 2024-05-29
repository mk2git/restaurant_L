<script>
  $(document).ready(function() {
      $('.select-Btable').click(function() {
          var tableId = $(this).data('table-id');
          $.get('/order/' + tableId, function(data) {
              $('#selectCheckTableBModal' + tableId).find('.modal-body').html(data);
              $('#selectCheckTableBModal' + tableId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="selectCheckTableBModal{{$tableId}}" tabindex="-1" role="dialog" aria-labelledby="selectCheckTablebModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectCheckTablebModalLabel"><i class="fa-solid fa-cash-register"></i> &nbsp;&nbsp;会計</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{$seatType}}-{{$seatNumber}} 」の会計をしますか？</p>
              <div class="text-center">
                <a href="{{route('checkout.show', $tableId)}}" class="btn btn-success w-25">
                会計
              </a>
              </div>
              
          </div>
      </div>
  </div>
</div>

