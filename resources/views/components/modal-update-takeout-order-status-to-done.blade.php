<div class="modal fade" id="exampleTakeoutModal{{$takeoutOrderId}}" tabindex="-1" aria-labelledby="exampleTakeoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleTakeoutModalLabel"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;調理確認</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <p>{{$takeoutOrderMenuName}}は完成しましたか？</p> 
       <div>
         <form action="{{route('takeout-order.updateStatusDone', $takeoutOrderId)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="takeout_order_id" value="{{$takeoutOrderId}}">
            <button type="submit" class="btn btn-success">調理済み</button>
        </form>
       </div>
      </div>
    </div>
  </div>
</div>