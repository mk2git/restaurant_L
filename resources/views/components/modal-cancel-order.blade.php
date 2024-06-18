<div class="modal fade" id="cancelModal{{$orderId}}" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cancelModalLabel"><i class="fa-solid fa-bell-concierge text-danger"></i>&nbsp;&nbsp;キャンセル確認</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <p>「&nbsp;&nbsp;<span class="fw-bold">{{$orderMenuName}}</span>&nbsp;&nbsp;」をキャンセルしますか？</p> 
       <div>
         <form action="{{route('serve.destroy')}}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="order_id" value="{{$orderId}}">
            <button type="submit" class="btn btn-danger text-white">キャンセル</button>
        </form>
       </div>
      </div>
    </div>
  </div>
</div>