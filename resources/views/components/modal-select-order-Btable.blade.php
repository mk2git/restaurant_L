<div class="modal fade" id="selectTableBModal{{$tableId}}" tabindex="-1" role="dialog" aria-labelledby="selectTableBModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="selectTableBModalLabel"><i class="fa-solid fa-utensils"></i> &nbsp;&nbsp;注文</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p class="text-center">「 {{ $seatType }}-{{$seatNumber}} 」の注文を始めますか？</p>
              <div class="text-center">
                <a href="{{route('orders.create', $tableId)}}" class="btn btn-success">
                注文を始める
              </a>
              </div>
          </div>
      </div>
  </div>
</div>
