<script>
  $(document).ready(function() {
      $('.select-Btable').click(function() {
          var BtableId = $(this).data('Btable-id');
          $.get('/order/' + BtableId, function(data) {
              $('#selectCheckTableBModal' + BtableId).find('.modal-body').html(data);
              $('#selectCheckTableBModal' + BtableId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="selectCheckTableBModal{{$btableId}}" tabindex="-1" role="dialog" aria-labelledby="selectCheckTablebModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectCheckTablebModalLabel"><i class="fa-solid fa-cash-register"></i> &nbsp;&nbsp;会計</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{$btableName}} 」の会計をしますか？</p>
              <div class="text-center">
                <a href="{{route('checkout.show', $btableId)}}" class="btn btn-success w-25">
                会計
              </a>
              </div>
              
          </div>
      </div>
  </div>
</div>

