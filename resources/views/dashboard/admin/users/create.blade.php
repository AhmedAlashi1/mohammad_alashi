@extends('dashboard.layouts.master')
@section('title', 'Add Patient')
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
                        <h4 class="card-title">Add Patient</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.users.store') }}" method="post">
                            @csrf
                            <div class="row">

                                <!-- Name -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="name">Full Name</label>
                                        <input
                                            value="{{ old('name') }}"
                                            name="name"
                                            type="text"
                                            id="name"
                                            class="form-control form-control-sm @error('name') is-invalid @else {{ old('name') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Patient's Full Name"
                                            required
                                        />
                                        @error('name')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone 1 -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="phone">Phone Number</label>
                                        <input
                                            value="{{ old('phone') }}"
                                            name="phone"
                                            type="text"
                                            id="phone"
                                            class="form-control form-control-sm @error('phone') is-invalid @else {{ old('phone') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Primary Phone Number"
                                            required
                                        />
                                        @error('phone')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone 2 -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="phone2">Alternate Phone</label>
                                        <input
                                            value="{{ old('phone2') }}"
                                            name="phone2"
                                            type="text"
                                            id="phone2"
                                            class="form-control form-control-sm @error('phone2') is-invalid @else {{ old('phone2') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Secondary Phone Number"
                                        />
                                        @error('phone2')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Age -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="age">Age</label>
                                        <input
                                            value="{{ old('age') }}"
                                            name="age"
                                            type="number"
                                            id="age"
                                            class="form-control form-control-sm @error('age') is-invalid @else {{ old('age') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Patient's Age"
                                        />
                                        @error('age')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="date_of_birth">Date of Birth</label>
                                        <input
                                            value="{{ old('date_of_birth') }}"
                                            name="date_of_birth"
                                            type="date"
                                            id="date_of_birth"
                                            class="form-control form-control-sm @error('date_of_birth') is-invalid @else {{ old('date_of_birth') ? 'is-valid' : '' }} @enderror"
                                        />
                                        @error('date_of_birth')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="gender">Gender</label>
                                        <select
                                            name="gender"
                                            id="gender"
                                            class="form-control form-control-sm @error('gender') is-invalid @else {{ old('gender') ? 'is-valid' : '' }} @enderror"
                                            required
                                        >
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Patient</button>
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
