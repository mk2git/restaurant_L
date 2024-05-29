<div class="modal fade" id="deleteReserveModal{{$reserveId}}" tabindex="-1" role="dialog" aria-labelledby="deleteReserveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteReserveModalLabel"><i class="fa-regular fa-trash-can text-danger"></i> &nbsp;&nbsp;予約キャンセル</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('reserve.destroy', $reserveId)}}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="id" value="{{$reserveId}}">
                  <p>{{$reserveName}}&nbsp;&nbsp;様</p>
                  <p>{{$reserveDate}} &nbsp;&nbsp;{{\Carbon\Carbon::parse($reserveTime)->format('H:i')}}</p>
                  <p>大人：{{$reserveAdult}}人&nbsp;&nbsp;&nbsp;&nbsp; 子供：{{$reserveKid}}人</p>
                  <hr>
                  <button type="submit" class="btn btn-danger text-white w-50">キャンセル</button>
              </form>
          </div>
      </div>
  </div>
</div>


