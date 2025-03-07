<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-success mr-2']) }}>
    {{ $slot }}
</button>