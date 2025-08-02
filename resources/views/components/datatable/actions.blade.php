@if(isset($subjectId))
    {{-- Routes that require subjectId --}}
    <a href="{{ route($routeEdit, ['subject' => $subjectId, $nameUrl => $id ]) }}"
       class="btn btn-info btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-pencil-fill"></i>
    </a>

    <button type="button"
            class="btn btn-danger btn-sm delete-btn rounded rounded-2 mb-2"
            data-url="{{ route($routeDelete, ['subject' => $subjectId, $nameUrl => $id ]) }}"
            data-name="{{ $name }}">
        <i class="bi bi-trash-fill"></i>
    </button>
@else
    {{-- Routes that do not require subjectId --}}
    @if(!empty($routeEdit))
        <a href="{{ route($routeEdit, $id) }}" type="button" class="btn btn-info btn-sm rounded rounded-2 mb-2 mr-2">
            <i class="bi bi-pencil-fill"></i>
        </a>
    @endif

    @if(!empty($routeDelete))
        <button type="button" class="btn rounded rounded-2 btn-danger btn-sm delete-btn mb-2"
                data-url="{{ route($routeDelete, $id) }}"
                data-name="{{ $name }}">
            <i class="bi bi-trash-fill"></i>
        </button>
    @endif
@endif

@if(!empty($routeAddress))
    <a href="{{ route($routeAddress, $id) }}" type="button" class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-geo-alt-fill"></i>
    </a>
@endif
@if(!empty($ServiceDetails))
    <a href="{{ route($ServiceDetails, $id )}}" type="button" class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-credit-card-2-front"></i>
    </a>
@endif

@if(!empty($routeSoftwareSolutionServices))
    <a href="{{ route($routeSoftwareSolutionServices, $id )}}" type="button" class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-credit-card-2-front"></i>
    </a>
@endif

@if(!empty($routeRegion))
    <a href="{{ route($routeRegion, $id )}}" type="button" class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-credit-card-2-front"></i>
    </a>
@endif

@if(!empty($routeChangeStatus))
    <a href="#"
{{--       class="btn btn-sm btn-outline-warning change-status-btn"--}}
       class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2 change-status-btn"
       data-id="{{ $id }}"
       data-name="{{ $name }}"
       data-url="{{ route($routeChangeStatus, $id) }}"
       title="{{ __('تغيير الحالة') }}">
        <i class="bi bi-arrow-repeat"></i>
    </a>
@endif
@if(isset($extraActions))
    @foreach($extraActions as $action)
        <a href="{{ $action['route'] }}" class="{{$action['btn']}} btn-sm rounded rounded-2 mb-2 mr-2" title="{{ $action['title'] }}">
            <i class="{{ $action['icon'] }}"></i>
        </a>
    @endforeach
@endif





