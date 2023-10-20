@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">{{ $title }}</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      {{ $content }}
    </div>
    <div class="modal-footer">
      {{ $footer }}
    </div>
  </div>
</x-modal>
