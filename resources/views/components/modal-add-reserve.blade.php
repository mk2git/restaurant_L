<!-- モーダル -->
<div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">

              <div class="modal-header">
              <h5 class="modal-title" id="reserveModalLabel">予約確認</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <p><span id="confirmName"></span>&nbsp;様</p>
                  <p class="text-center">日時： <span id="confirmDate"></span>&nbsp;&nbsp;&nbsp;<span id="confirmTime"></span>〜</p>
                  <p class="text-center">人数： &nbsp; 大人: <span id="confirmAdult"></span>人&nbsp;&nbsp;&nbsp;&nbsp;子供: <span id="confirmKid"></span>人</p>
                  <p class="text-center">電話番号：&nbsp;&nbsp; <span id="confirmPhoneNumber"></span></p>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <button type="submit" class="btn btn-success">予約確定</button>
              </div>
          </form>
      </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', (event) => {
      document.querySelector('button[data-target="#reserveModal"]').addEventListener('click', function() {
      // 入力値を取得
      const date = document.getElementById('date').value;
      const time = document.getElementById('time').value;
      const adult = document.getElementById('adult').value;
      const kid = document.getElementById('kid').value;
      const name = document.getElementById('name').value;
      const phoneNumber = document.getElementById('phone_number').value;

      // モーダルに表示
      document.getElementById('confirmDate').textContent = date;
      document.getElementById('confirmTime').textContent = time;
      document.getElementById('confirmAdult').textContent = adult;
      document.getElementById('confirmKid').textContent = kid;
      document.getElementById('confirmName').textContent = name;
      document.getElementById('confirmPhoneNumber').textContent = phoneNumber;
      });
  });
</script>