<div {{ $attributes->merge(['class' => 'm-2 m-md-3'])}}>
  <div class="d-flex">
      <div class="bg-light border rounded-circle ms-2 seat"></div>
  </div>

  <div class="bg-light border d-flex align-items-center justify-content-center seat-Btable">
      <span>{{ $seatType }}-{{$seatNumber}}</span>
  </div>
  <div class="d-flex">
      <div class="bg-light border rounded-circle ms-2 seat"></div>
  </div>
</div>