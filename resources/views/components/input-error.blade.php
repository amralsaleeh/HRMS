@props(['for'])

@error($for)
  <span {{ $attributes->merge(['class' => 'invalid-feedback']) }} role="alert">
    <span class="fw-medium">{{ $message }}</span>
  </span>
@enderror
