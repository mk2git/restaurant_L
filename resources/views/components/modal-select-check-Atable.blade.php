<script>
  $(document).ready(function() {
      $('.select-Atable').click(function() {
          var AtableId = $(this).data('Atable-id');
          $.get('/order/' + AtableId, function(data) {
              $('#selectCheckTableAModal' + AtableId).find('.modal-body').html(data);
              $('#selectCheckTableAModal' + AtableId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="selectCheckTableAModal{{$atableId}}" tabindex="-1" role="dialog" aria-labelledby="selectCheckTableAModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectCheckTableAModalLabel"><i class="fa-solid fa-cash-register"></i> &nbsp;&nbsp;会計</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{$atableName}} 」の会計をしますか？</p>
              <div class="text-center">
                <a href="{{route('checkout.show', $atableId)}}" class="btn btn-success w-25">
                会計
              </a>
              </div>
              
          </div>
      </div>
  </div>
</div>

