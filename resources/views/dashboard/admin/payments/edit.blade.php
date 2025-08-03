@extends('dashboard.layouts.master')
@section('title', 'Edit Examination')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Examination</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.users.examinations.update', [$user->id ,$examination->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Exam Date -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="exam_date">Examination Date</label>
                                        <input type="date" name="exam_date" id="exam_date" class="form-control form-control-sm @error('exam_date') is-invalid @enderror"
                                               value="{{ old('exam_date', $examination->exam_date) }}" required>
                                        @error('exam_date')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Exam Type -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="exam_type">Examination Type</label>
                                        <select name="exam_type" id="exam_type" class="form-control form-control-sm @error('exam_type') is-invalid @enderror" required>
                                            <option value="consultation" {{ old('exam_type', $examination->exam_type) == 'consultation' ? 'selected' : '' }}>Consultation</option>
                                            <option value="consultation_with_glasses" {{ old('exam_type', $examination->exam_type) == 'consultation_with_glasses' ? 'selected' : '' }}>Consultation with Glasses</option>
                                        </select>
                                        @error('exam_type')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div id="glasses-prescription-fields" style="display: none;">
                                    <div class="row">

                                        <!-- Right Eye -->
                                        <div class="col-12">
                                            <h6 class="text-primary">Right Eye (OD)</h6>
                                        </div>
                                        @foreach(['sph_od', 'cyl_od', 'axis_od', 'add_od', 'prism_od', 'sci_od'] as $field)
                                            <div class="col-md-2 col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="{{ $field }}">{{ strtoupper(str_replace('_', ' ', $field)) }}</label>
                                                    <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm"
                                                           value="{{ old($field, optional($examination->glassesPrescription)->$field) }}">
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Left Eye -->
                                        <div class="col-12 mt-1">
                                            <h6 class="text-primary">Left Eye (OS)</h6>
                                        </div>
                                        @foreach(['sph_os', 'cyl_os', 'axis_os', 'add_os', 'prism_os', 'sci_os'] as $field)
                                            <div class="col-md-2 col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="{{ $field }}">{{ strtoupper(str_replace('_', ' ', $field)) }}</label>
                                                    <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm"
                                                           value="{{ old($field, optional($examination->glassesPrescription)->$field) }}">
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- IPD -->
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="ipd">IPD</label>
                                                <input type="text" name="ipd" id="ipd" class="form-control form-control-sm @error('ipd') is-invalid @enderror"
                                                       value="{{ old('ipd', optional($examination->glassesPrescription)->ipd) }}">
                                                @error('ipd')
                                                <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Inventory -->
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="inventory_id">Inventory</label>
                                                <select name="inventory_id" id="inventory_id" class="form-control form-control-sm select2 @error('inventory_id') is-invalid @enderror">
                                                    <option value="">Select Inventory</option>
                                                    @foreach($inventories as $inventory)
                                                        <option value="{{ $inventory->id }}" {{ old('inventory_id', optional($examination->glassesPrescription)->inventory_id) == $inventory->id ? 'selected' : '' }}>
                                                            {{ $inventory->description }} ({{ $inventory->code }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('inventory_id')
                                                <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Notes -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="notes">Notes</label>
                                                <textarea name="notes" id="notes" rows="2" class="form-control form-control-sm @error('notes') is-invalid @enderror">{{ old('notes', $examination->notes) }}</textarea>
                                                @error('notes')
                                                <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Pricing -->
                                        @foreach(['lens_type', 'lens_purchase_price', 'lens_selling_price', 'frame_price', 'other_costs', 'consultation_cost'] as $field)
                                            <div class="col-md-6 col-6">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                    <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm"
                                                           value="{{ old($field, optional($examination->glassesPrescription)->$field) }}">
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Total Cost -->
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="col-form-label-sm" for="total_cost">Total Cost</label>
                                                <input type="text" name="total_cost" id="total_cost" class="form-control form-control-sm" readonly
                                                       value="{{ old('total_cost', optional($examination->glassesPrescription)->total_cost) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Examination</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function togglePrescriptionFields() {
            let examType = document.getElementById('exam_type').value;
            let prescriptionFields = document.getElementById('glasses-prescription-fields');
            if (examType === 'consultation_with_glasses') {
                prescriptionFields.style.display = 'block';
                calculateTotal();
            } else {
                prescriptionFields.style.display = 'none';
            }
        }

        function calculateTotal() {
            let lens = parseFloat(document.getElementById('lens_selling_price').value) || 0;
            let frame = parseFloat(document.getElementById('frame_price').value) || 0;
            let other = parseFloat(document.getElementById('other_costs').value) || 0;
            let consult = parseFloat(document.getElementById('consultation_cost').value) || 0;
            document.getElementById('total_cost').value = (lens + frame + other + consult).toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function () {
            togglePrescriptionFields();
            document.getElementById('exam_type').addEventListener('change', togglePrescriptionFields);
            document.querySelectorAll('#lens_selling_price, #frame_price, #other_costs, #consultation_cost').forEach(function (el) {
                el.addEventListener('input', calculateTotal);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#inventory_id').select2({
                placeholder: "Select Inventory",
                allowClear: true
            });
        });
    </script>
@endsection
