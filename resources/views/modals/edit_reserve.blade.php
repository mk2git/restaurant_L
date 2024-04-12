<script>
    $(document).ready(function() {
        $('.edit-reserve').click(function() {
            var reserveId = $(this).data('reserve-id');
            $.get('/reserve/' + reserveId, function(data) {
                $('#editReserveModal' + reserveId).find('.modal-body').html(data);
                $('#editReserveModal' + reserveId).modal('show');
            });
        });
    });
</script>


<div class="modal fade" id="editReserveModal{{$reserve->id}}" tabindex="-1" role="dialog" aria-labelledby="editReserveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReserveModalLabel"><i class="fa-solid fa-pencil"></i> 予約編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('reserve.update', $reserve->id)}}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$reserve->id}}">
                    <div class="form-group row mb-2">
                        <div class="col-sm-2">
                            <label for="name" class=" col-form-label">氏名：</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" value="{{$reserve->name}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <div class="col-sm-2">
                            <label class="col-form-label">日時：</label>
                        </div>
                        <div class="col-sm-5">
                                <input type="date" name="date" value="{{$reserve->date}}" class="form-control">
                        </div>
                        <div class="col-sm-5">
                            <input type="time" name="time" value="{{$reserve->time}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <div class="col-sm-2">
                            <label class="col-form-label">大人：</label>
                        </div>
                        <div class="col-sm-10">
                             <input type="number" name="adult" value="{{$reserve->adult}}" class="form-control w-50" min="0">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-sm-2">
                            <label class="col-form-label">子供：</label>
                        </div>
                        <div class="col-sm-10">
                             <input type="number" name="kid" value="{{$reserve->kid}}" class="form-control w-50" min="0">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-sm-2">
                            <label for="" class="col-form-label h5"><small>電話番号</small></label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="phone_number" value="{{$reserve->phone_number}}" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-50">更新</button>
                </form>
            </div>
        </div>
    </div>
</div>


