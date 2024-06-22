<div {{ $attributes->merge(['class' => 'm-2 m-md-3']) }}>

    <div class="d-flex">
        <div class="bg-light border rounded-circle ms-1 seat"></div>
        <div class="bg-light border rounded-circle ms-1 ms-md-3 seat"></div>
    </div>

    <div class="bg-light border d-flex align-items-center justify-content-center seat-Atable">
        <span>{{ $seatType }}-{{$seatNumber}}</span>
    </div>
    <div class="d-flex">
        <div class="bg-light border rounded-circle ms-1 ms-md-1 seat"></div>
        <div class="bg-light border rounded-circle ms-1 ms-md-3 seat"></div>
    </div>

</div>
