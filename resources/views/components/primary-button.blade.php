<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary mr-2']) }}>
    {{ $slot }}
</button>
