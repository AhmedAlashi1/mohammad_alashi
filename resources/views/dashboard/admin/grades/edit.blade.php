@extends('dashboard.layouts.master')
@section('title', __('Update grades') )
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
                        <h4 class="card-title">{{__('general.Update grades')}} </h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.grades.update', $grade->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <!-- Name Arabic -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_ar">{{__('general.Name in Arabic')}}</label>
                                        <input
                                            value="{{ old('name_ar', $grade->name_ar) }}"
                                            name="name_ar"
                                            type="text"
                                            id="name_ar"
                                            class="form-control form-control-sm @error('name_ar') is-invalid @else {{ old('name_ar', $grade->name_ar) ? 'is-valid' : '' }} @enderror"
                                            placeholder="اسم المدرسة"
                                            required
                                        />
                                        @error('name_ar') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name_en">{{__('general.Name in English')}}</label>
                                        <input
                                            value="{{ old('name_en', $grade->name_en) }}"
                                            name="name_en"
                                            type="text"
                                            id="name_en"
                                            class="form-control form-control-sm @error('name_en') is-invalid @else {{ old('name_en', $grade->name_en) ? 'is-valid' : '' }} @enderror"
                                            placeholder="School Name"
                                            required
                                        />
                                        @error('name_en') <span class="col-form-label-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="all_materials_price">{{ __('general.All Materials Price') }}</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="all_materials_price"
                                            id="all_materials_price"
                                            value="{{ old('all_materials_price', $grade->all_materials_price ?? '') }}"
                                            class="form-control form-control-sm @error('all_materials_price') is-invalid @enderror"
                                        >
                                        @error('all_materials_price')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="icon_number">{{ __('general.icon_number') }}</label>
                                        <input
                                            type="number"
                                            name="icon_number"
                                            id="icon_number"
                                            value="{{ old('icon_number', $grade->icon_number ?? '') }}"
                                            class="form-control form-control-sm @error('icon_number') is-invalid @enderror"
                                        >
                                        @error('icon_number')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="status">{{__('general.Status')}}</label>
                                        <select
                                            name="status"
                                            id="status"
                                            class="form-control form-control-sm @error('status') is-invalid @else {{ old('status') ? 'is-valid' : '' }} @enderror"
                                            required
                                        >
                                            <option value="1" {{ old('status', $grade->status ?? '') == true ? 'selected' : '' }}>{{ __('general.Active') }}</option>
                                            <option value="0" {{ old('status', $grade->status ?? '') == false ? 'selected' : '' }}>{{ __('general.Inactive') }}</option>
                                        </select>
                                        @error('status')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Submit -->
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
    <script>
        document.getElementById('customFile').addEventListener('change', function (e) {
            // Get the selected file name
            var fileName = e.target.files[0] ? e.target.files[0].name : '{{__('general.Choose file')}} ';
            // Update the label text
            e.target.nextElementSibling.textContent = fileName;
        });
    </script>

@stop
@section('js')

@endsection

