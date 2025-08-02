@extends('dashboard.layouts.master')
@section('title', $type == 'lesson' ? __('general.Add Lesson') : __('general.Add Note'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h4 class="card-title">{{$type == 'lesson' ?  __('general.Add Lesson') : __('general.Add Note')  }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.subjects.materials.store', [$subject->id, 'type' => $type]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            <input type="hidden" name="type" value="{{ $type }}">


                            <div class="row">
                                <!-- Section Select -->


                                <!-- Name Arabic -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_ar" class="col-form-label-sm">{{ __('general.Name in Arabic') }}</label>
                                        <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}"
                                               class="form-control form-control-sm @error('name_ar') is-invalid @enderror" required>
                                        @error('name_ar')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Name English -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name_en" class="col-form-label-sm">{{ __('general.Name in English') }}</label>
                                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                                               class="form-control form-control-sm @error('name_en') is-invalid @enderror" required>
                                        @error('name_en')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="lesson_section_id">{{ __('general.lesson_sections') }}</label>
                                        <select name="lesson_section_id" id="lesson_section_id" class="form-control form-control-sm @error('lesson_section_id') is-invalid @enderror" required>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ old('lesson_section_id') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('lesson_section_id')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Duration -->
{{--                                <div class="col-md-6 col-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="duration" class="col-form-label-sm">{{ __('general.Duration') }}</label>--}}
{{--                                        <input type="text" name="duration" id="duration" value="{{ old('duration') }}"--}}
{{--                                               class="form-control form-control-sm @error('duration') is-invalid @enderror" required>--}}
{{--                                        @error('duration')--}}
{{--                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="status">{{__('general.is_free')}}</label>
                                        <select
                                            name="is_free"
                                            id="is_free"
                                            class="form-control form-control-sm @error('is_free') is-invalid @else {{ old('is_free') ? 'is-valid' : '' }} @enderror"
                                            required
                                        >
                                            <option value="1" >{{ __('general.Active') }}</option>
                                            <option value="0" >{{ __('general.Inactive') }}</option>
                                        </select>
                                        @error('status')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Video -->
                                @if($type == 'lesson' )
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="video" class="col-form-label-sm">{{ __('general.Video File') }}</label>
                                        <input type="file" name="video" id="video" value="{{ old('video') }}"
                                               accept="video/mp4, video/avi, video/mpeg, video/quicktime"
                                               class="form-control form-control-sm @error('video') is-invalid @enderror">
                                        @error('video')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @else
                                <!-- File Upload -->
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="file" class="col-form-label-sm">{{ __('general.Upload File') }}</label>
                                        <input type="file" name="file" id="file"
                                               class="form-control form-control-sm @error('file') is-invalid @enderror">
                                        @error('file')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif




                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('general.Save') }}</button>
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
@endsection
