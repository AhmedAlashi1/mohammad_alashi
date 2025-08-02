<span class="badge {{ $status ? 'bg-success' : 'bg-danger' }} toggle-status"
      data-id="{{ $id }}"
      data-url="{{ $url }}"
      style="cursor: pointer;">
    {{ $status ? __('dataTable.active') : __('dataTable.inactive') }}
</span>
