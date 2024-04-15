<script>
  $(document).ready(function() {
      $('.edit-unused-Atable').click(function() {
          var tableId = $(this).data('table-id');
          $.get('/table/' + tableId, function(data) {
              $('#unusedTableAModal' + tableId).find('.modal-body').html(data);
              $('#unusedTableAModal' + tableId).modal('show');
          });
      });
  });
</script>

{{-- 4人席用未使用モーダル --}}
<div class="modal fade" id="unusedTableAModal{{$atableId}}" tabindex="-1" role="dialog" aria-labelledby="unusedTableAModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unusedTableAModalLabel">座席</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">{{$atableName}}を使用しますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('table.update', $atableId)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="name" value="{{$atableId}}">
            <button type="submit" class="btn btn-success">使用する</button>
        </form>
      </div>
    </div>
  </div>
</div>

