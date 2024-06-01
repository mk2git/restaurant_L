<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success w-25']) }}>
    {{ $slot }}
</button>
