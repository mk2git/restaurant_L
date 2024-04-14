<script>
  $(document).ready(function() {
      $('.select-Atable').click(function() {
          var AtableId = $(this).data('Atable-id');
          $.get('/order/' + AtableId, function(data) {
              $('#selectTableAModal' + AtableId).find('.modal-body').html(data);
              $('#selectTableAModal' + AtableId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="selectTableAModal{{$Atable->id}}" tabindex="-1" role="dialog" aria-labelledby="selectTableAModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectTableAModalLabel"><i class="fa-solid fa-utensils"></i> &nbsp;&nbsp;注文</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{$Atable->name}} 」の注文を始めますか？</p>
              <div class="text-center">
                <a href="{{route('order.create', $Atable->id)}}" class="btn btn-success">
                注文を始める
              </a>
              </div>
              
          </div>
      </div>
  </div>
</div>

