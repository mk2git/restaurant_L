<div class="modal fade" id="exampleModal{{$orderId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;配膳</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
       <p>「<span class="fw-bold">&nbsp;{{$orderMenuName}}&nbsp;</span>」を配膳しましたか？</p> 
       <div>
         <form action="{{route('serve.update')}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="order_id" value="{{$orderId}}">
            <button type="submit" class="btn btn-success">配膳済み</button>
        </form>
       </div>
      </div>
    </div>
  </div>
</div>