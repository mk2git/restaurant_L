<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success custom-button']) }}>
    {{ $slot }}
</button>
