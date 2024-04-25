<script>
  $(document).ready(function() {
      $('.menu-img').click(function() {
          var menuId = $(this).data('menu-id');
          $.get('/order/create/' + menuId, function(data) {
              $('#menuModal' + menuId).find('.modal-body').html(data);
              $('#menuModal' + menuId).modal('show');
          });
      });
  });
</script>

<div class="modal fade" id="menuModal{{$menuId}}" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="menuModalLabel">{{$menuName}}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="{{$menuImg}}" alt="イメージ写真" class="img-fluid mx-auto">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

