
@php
    $routeParams = $routeParams ?? [$nameUrl => $id];

    if (!empty($userId)) {
        $routeParams['user'] = $userId;
    }

    if (!empty($subjectId)) {
        $routeParams['subject'] = $subjectId;
    }
@endphp

@if(!empty($routeEdit))
    <a href="{{ route($routeEdit, $routeParams) }}"
       class="btn btn-info btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-pencil-fill"></i>
    </a>
@endif

@if(!empty($routeDelete))
    <button type="button"
            class="btn btn-danger btn-sm delete-btn rounded rounded-2 mb-2"
            data-url="{{ route($routeDelete, $routeParams) }}"
            data-name="{{ $name }}">
        <i class="bi bi-trash-fill"></i>
    </button>
@endif



@if(!empty($routeExaminations))
    <a href="{{ route($routeExaminations, $id) }}" type="button" class="btn btn-secondary btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-journal-medical"></i>
    </a>
@endif

@if(!empty($routePrescription))
    <a href="{{ route($routePrescription, $routeParams ?? [$nameUrl => $id]) }}"
       type="button"
       class="btn btn-warning btn-sm rounded rounded-2 mb-2 mr-2">
        <i class="bi bi-eye-fill"></i>
    </a>
@endif




