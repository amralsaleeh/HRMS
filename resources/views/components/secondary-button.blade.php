<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-label-secondary text-uppercase']) }}>
  {{ $slot }}
</button>
