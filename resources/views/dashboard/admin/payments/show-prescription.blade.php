@extends('dashboard.layouts.master')
@section('title', 'Glasses Prescription Details')

@section('content')
    <style>
        .prescription-box {
            border: 2px solid #000;
            padding: 20px;
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            direction: ltr;
        }
        .prescription-box h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: center;
        }
        .details-row {
            margin-bottom: 15px;
        }
    </style>

    <div class="prescription-box">
        <h3>Glasses Prescription</h3>

        <div class="row mb-2">
            <div class="col-md-6">
                <strong>Day:</strong> {{ $examination->day }}
            </div>
            <div class="col-md-6">
                <strong>Date:</strong> {{ \Carbon\Carbon::parse($examination->exam_date)->format('Y-m-d') }}
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <strong>Name:</strong> {{ $examination->user->name ?? '-' }}
            </div>
            <div class="col-md-6">
                <strong>Age:</strong> {{ $examination->user->date_of_birth ? \Carbon\Carbon::parse($examination->user->date_of_birth)->age . ' yrs' : '-' }}
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Sph</th>
                <th>Cyl</th>
                <th>Axis</th>
                <th>Add</th>
                <th>Prism</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>OD (Right)</strong></td>
                <td>{{ $prescription->sph_od }}</td>
                <td>{{ $prescription->cyl_od }}</td>
                <td>{{ $prescription->axis_od }}</td>
                <td>{{ $prescription->add_od }}</td>
                <td>{{ $prescription->prism_od }}</td>
            </tr>
            <tr>
                <td><strong>OS (Left)</strong></td>
                <td>{{ $prescription->sph_os }}</td>
                <td>{{ $prescription->cyl_os }}</td>
                <td>{{ $prescription->axis_os }}</td>
                <td>{{ $prescription->add_os }}</td>
                <td>{{ $prescription->prism_os }}</td>
            </tr>
            </tbody>
        </table>

        <div class="details-row mt-2"><strong>IPD:</strong> {{ $prescription->ipd }}</div>
        <div class="details-row"><strong>Notes:</strong> {{ $prescription->notes }}</div>
        <div class="details-row"><strong>Lens Type:</strong> {{ $examination->lens_type }}</div>
        <div class="details-row"><strong>Total Price:</strong> {{ $prescription->total_cost }} {{ $currency ?? 'شيكل' }}</div>
{{--        <div class="details-row"><strong>Paid:</strong> {{ $prescription->frame_price }} {{ $currency ?? 'شيكل' }}</div>--}}
{{--        <div class="details-row"><strong>Remaining:</strong> {{ $prescription->total_cost - $prescription->frame_price }} {{ $currency ?? 'شيكل' }}</div>--}}

{{--        <div class="mt-4"><strong>Signature:</strong> ____________________________</div>--}}
    </div>
@endsection
