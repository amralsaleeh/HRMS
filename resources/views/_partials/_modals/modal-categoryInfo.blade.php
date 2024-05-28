@push('custom-css')

@endpush

<div wire:ignore.self class="modal fade" id="categoryInfoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple">
    <div class="card">
      <h5 class="card-header">Treeview</h5>
      <div class="card-body">
        <div id="jstree-basic" class="jstree jstree-1 jstree-default-dark" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j1_1" aria-busy="false"><ul class="jstree-container-ul jstree-children" role="group"><li role="none" data-jstree="{&quot;icon&quot; : &quot;ti ti-folder&quot;}" id="j1_1" class="jstree-node  jstree-closed"><i class="jstree-icon jstree-ocl" role="presentation"></i>
          <a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="false" id="j1_1_anchor"><i class="jstree-icon jstree-themeicon ti ti-folder jstree-themeicon-custom" role="presentation"></i>
          {{ $categoryInfo->name . " (" . count($categoryInfo->subCategory) .")"}}
          </a>
          <ul role="group" class="jstree-children">
          @forelse ($categoryInfo->subCategory as $subCategory)
            <li role="none" data-jstree="{&quot;icon&quot; : &quot;ti ti-folder&quot;}" id="j1_5" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i>
              <a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j1_5_anchor"><i class="jstree-icon jstree-themeicon ti ti-folder jstree-themeicon-custom" role="presentation"></i>
                {{ $subCategory->name }}
              </a>
            </li>
          @empty

          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

@push('custom-scripts')

@endpush
