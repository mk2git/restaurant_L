<div class="modal fade" id="cancelTakeoutModal{{$takeoutOrderId}}" tabindex="-1" aria-labelledby="cancelTakeoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cancelTakeoutModalLabel"><i class="fa-solid fa-bell-concierge text-danger"></i>&nbsp;&nbsp;キャンセル確認</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <p>「&nbsp;&nbsp;<span class="fw-bold">{{$takeoutOrderMenuName}}</span>&nbsp;&nbsp;」をキャンセルしますか？</p> 
       <div>
         <form action="{{route('takeout-order.cancel')}}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="takeout_order_id" value="{{$takeoutOrderId}}">
            <button type="submit" class="btn btn-danger">キャンセル</button>
        </form>
       </div>
      </div>
    </div>
  </div>
</div>