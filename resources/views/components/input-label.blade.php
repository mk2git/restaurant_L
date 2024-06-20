@props(['value'])

<label {{ $attributes->merge(['class' => 'h5 font-weight-medium text-gray-700 me-3 custom-text-size d-block ']) }}>
    {{ $value ?? $slot }}
</label>
