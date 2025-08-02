@extends('dashboard.layouts.master')
@section('title', __('Update Semester') )

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
@endsection

@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('general.Update Semester') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.semesters.update', $semester->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <!-- Name Arabic -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_ar">{{ __('general.Name in Arabic') }}</label>
                                        <input
                                            value="{{ old('name_ar', $semester->name_ar) }}"
                                            name="name_ar"
                                            type="text"
                                            id="name_ar"
                                            class="form-control form-control-sm @error('name_ar') is-invalid @else {{ old('name_ar', $semester->name_ar) ? 'is-valid' : '' }} @enderror"
                                            placeholder="اسم الفصل"
                                            required
                                        />
                                        @error('name_ar') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_en">{{ __('general.Name in English') }}</label>
                                        <input
                                            value="{{ old('name_en', $semester->name_en) }}"
                                            name="name_en"
                                            type="text"
                                            id="name_en"
                                            class="form-control form-control-sm @error('name_en') is-invalid @else {{ old('name_en', $semester->name_en) ? 'is-valid' : '' }} @enderror"
                                            placeholder="Semester Name"
                                            required
                                        />
                                        @error('name_en') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="status">{{ __('general.Status') }}</label>
                                        <select
                                            name="status"
                                            id="status"
                                            class="form-control form-control-sm @error('status') is-invalid @else {{ old('status') !== null ? 'is-valid' : '' }} @enderror"
                                            required
                                        >
                                            <option value="1" {{ old('status', $semester->status) == true ? 'selected' : '' }}>{{ __('general.Active') }}</option>
                                            <option value="0" {{ old('status', $semester->status) == false ? 'selected' : '' }}>{{ __('general.Inactive') }}</option>
                                        </select>
                                        @error('status') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('general.Update') }}</button>
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
    {{-- No custom JS --}}
@endsection
