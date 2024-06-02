<div class="card">
  <div class="card-header">
      <h2 class="text-center"><i class="fa-solid fa-phone h4"></i> 予約受付</h2>
  </div>
  <div class="card-body">
       <form action="{{route('reserve.store')}}" method="POST">
          @csrf
      <div class="mb-2">
          <div class="row">
              <div class="col-6">
                  <label for="date">日付</label>
                  <input type="date" name="date" id="date" class="form-control">
              </div>
              <div class="col-6">
                  <label for="time">時間</label>
                   <input type="time" name="time" id="time" class="form-control">
              </div>
          </div>
      </div>

      <div class="mb-2">
          <div class="row">
              <div class="col-6">
                  <label for="adult">大人</label>
                  <input type="number" name="adult" id="adult" class="form-control" value="0" min="0">
              </div>
              <div class="col-6">
                  <label for="kid">子供</label>
                  <input type="number" name="kid" id="kid" class="form-control" value="0" min="0">
              </div>
          </div>
      </div>
      <div class="mb-2">
          <div class="row">
              <div class="col-6">
                  <label for="name">名前</label>
                  <input type="text" name="name" id="name"class="form-control">
              </div>
              <div class="col-6">
                  <label for="phone_number">電話番号</label>
                  <input type="text" name="phone_number" id="phone_number"class="form-control">
              </div>
          </div>
      </div>
      <div class="mt-3 d-flex justify-content-center">
        <button type="button" class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#reserveModal">
            予約
         </button>
      </div>
  </div>
</div>