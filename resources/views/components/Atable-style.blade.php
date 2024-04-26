<div {{ $attributes->merge(['class' => 'm-3']) }}>

    <div class="d-flex">
        <div class="bg-light border rounded-circle ms-1 seat"></div>
        <div class="bg-light border rounded-circle ms-3 seat"></div>
    </div>

    <div class="bg-light border d-flex align-items-center justify-content-center seat-Atable">
        <span>{{ $tableName }}</span>
    </div>
    <div class="d-flex">
        <div class="bg-light border rounded-circle ms-1 seat"></div>
        <div class="bg-light border rounded-circle ms-3 seat"></div>
    </div>

</div>
