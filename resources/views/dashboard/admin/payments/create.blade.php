@extends('dashboard.layouts.master')
@section('title', 'Add Payment')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
@endsection

@section('content')
    <section id="payment-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Payment</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.examinations.payments.store', $examination->id) }}" method="post">
                            @csrf
                            <div class="row">

                                <!-- Amount -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="amount">Amount</label>
                                        <input type="number" step="0.01" name="amount" id="amount"
                                               class="form-control form-control-sm @error('amount') is-invalid @enderror"
                                               value="{{ old('amount') }}" required>
                                        @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Payment Type -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="payment_type">Payment Type</label>
                                        <select name="payment_type" id="payment_type"
                                                class="form-control form-control-sm @error('payment_type') is-invalid @enderror"
                                                required>
                                            <option value="consultation" {{ old('payment_type') == 'consultation' ? 'selected' : '' }}>Consultation</option>
                                            <option value="glasses" {{ old('payment_type') == 'glasses' ? 'selected' : '' }}>Glasses</option>
                                        </select>
                                        @error('payment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="method">Payment Method</label>
                                        <select name="method" id="method"
                                                class="form-control form-control-sm @error('method') is-invalid @enderror"
                                                required>
                                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>Online</option>
                                        </select>
                                        @error('method')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="notes">Notes</label>
                                        <textarea name="notes" id="notes"
                                                  class="form-control form-control-sm @error('notes') is-invalid @enderror"
                                                  rows="2">{{ old('notes') }}</textarea>
                                        @error('notes')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Payment</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
