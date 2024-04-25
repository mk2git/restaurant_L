<script>
  $(document).ready(function() {
      $('.select-Btable').click(function() {
          var BtableId = $(this).data('Btable-id');
          $.get('/order/' + BtableId, function(data) {
              $('#selectTableBModal' + BtableId).find('.modal-body').html(data);
              $('#selectTableBModal' + BtableId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="selectTableBModal{{$btableId}}" tabindex="-1" role="dialog" aria-labelledby="selectTableBModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectTableBModalLabel"><i class="fa-solid fa-utensils"></i> &nbsp;&nbsp;注文</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{$btableName}} 」の注文を始めますか？</p>
              <div class="text-center">
                <a href="{{route('orders.create', $btableId)}}" class="btn btn-success">
                注文を始める
              </a>
              </div>
          </div>
      </div>
  </div>
</div>
