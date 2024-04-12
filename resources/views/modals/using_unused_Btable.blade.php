<script>
  $(document).ready(function() {
      $('.edit-unused-Btable').click(function() {
          var tableId = $(this).data('table-id');
          $.get('/table/' + tableId, function(data) {
              $('#unusedTableBModal' + tableId).find('.modal-body').html(data);
              $('#unusedTableBModal' + tableId).modal('show');
          });
      });
  });
</script>

{{-- 2人席未使用モーダル --}}
<div class="modal fade" id="unusedTableBModal{{$Btable->id}}" tabindex="-1" role="dialog" aria-labelledby="unusedTableBModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unusedTableBModalLabel">座席</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">{{$Btable->name}}を使用しますか？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('table.update', $Btable->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="name" value="{{$Btable->id}}">
            <button type="submit" class="btn btn-danger">使用する</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
      $('.edit-using-Btable').click(function() {
          var tableId = $(this).data('table-id');
          $.get('/table/' + tableId, function(data) {
              $('#usingTableBModal' + tableId).find('.modal-body').html(data);
              $('#usingTableBModal' + tableId).modal('show');
          });
      });
  });
</script>

  {{-- 2人席使用中モーダル --}}
  <div class="modal fade" id="usingTableBModal{{$Btable->id}}" tabindex="-1" role="dialog" aria-labelledby="usingTableBModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="usingTableBModalLabel">座席の変更</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-center">{{$Btable->name}}の使用をやめますか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{route('table.update', $Btable->id)}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="name" value="B-">
                <button type="submit" class="btn btn-danger">使用しない</button>
            </form>
          </div>
        </div>
      </div>
    </div>
