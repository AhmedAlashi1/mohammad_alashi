<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>
    <ul class="dropdown-menu">
        {{-- Edit --}}
        @if(!empty($routeEdit))
            <li>
                <a class="dropdown-item text-primary" href="{{ route($routeEdit, $routeParams ?? [$nameUrl => $id]) }}">
                    <i class="bi bi-pencil-fill"></i> Edit
                </a>
            </li>
        @endif

        {{-- Delete --}}
        @if(!empty($routeDelete))
            <li>
                <button type="button"
                        class="dropdown-item text-danger delete-btn"
                        data-url="{{ route($routeDelete, $routeParams ?? [$nameUrl => $id]) }}"
                        data-name="{{ $name ?? 'Examination' }}">
                    <i class="bi bi-trash-fill"></i> Delete
                </button>
            </li>
        @endif

        {{-- View --}}
        @if(!empty($routeShow))
            <li>
                <a class="dropdown-item text-warning" href="{{ route($routeShow, $routeParams ?? [$nameUrl => $id]) }}">
                    <i class="bi bi-eye-fill"></i> View
                </a>
            </li>
        @endif
        @if(!empty($routePrescription))
            <li>
                <a class="dropdown-item text-warning" href="{{ route($routePrescription, $routeParams ?? [$nameUrl => $id]) }}">
                    <i class="bi bi-eyeglasses"></i> View Prescription
                </a>
            </li>
        @endif

        @if(!empty($routePayments))
            <li>
                <a class="dropdown-item text-success" href="{{ route($routePayments, $routeParams ) }}">
                    <i class="bi bi-cash-stack"></i> Payments
                </a>
            </li>
        @endif


    </ul>

</div>
