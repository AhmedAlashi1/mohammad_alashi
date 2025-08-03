@extends('dashboard.layouts.master')
@section('title', 'Edit Inventory Item')
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
                        <h4 class="card-title">Edit Inventory Item</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.inventories.update', $inventory->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Description -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="description">Description</label>
                                        <input
                                            value="{{ old('description', $inventory->description) }}"
                                            name="description"
                                            type="text"
                                            id="description"
                                            class="form-control form-control-sm @error('description') is-invalid @else {{ old('description') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Item description"
                                            required
                                        />
                                        @error('description')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Code -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="code">Item Code</label>
                                        <input
                                            value="{{ old('code', $inventory->code) }}"
                                            name="code"
                                            type="text"
                                            id="code"
                                            class="form-control form-control-sm @error('code') is-invalid @else {{ old('code') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Unique item code"
                                            required
                                        />
                                        @error('code')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Purchase Price -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="purchase_price">Purchase Price</label>
                                        <input
                                            value="{{ old('purchase_price', $inventory->purchase_price) }}"
                                            name="purchase_price"
                                            type="number"
                                            step="0.01"
                                            id="purchase_price"
                                            class="form-control form-control-sm @error('purchase_price') is-invalid @else {{ old('purchase_price') ? 'is-valid' : '' }} @enderror"
                                            placeholder="0.00"
                                            required
                                        />
                                        @error('purchase_price')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="col-form-label-sm" for="quantity">Quantity</label>
                                        <input
                                            value="{{ old('quantity', $inventory->quantity) }}"
                                            name="quantity"
                                            type="number"
                                            id="quantity"
                                            class="form-control form-control-sm @error('quantity') is-invalid @else {{ old('quantity') ? 'is-valid' : '' }} @enderror"
                                            placeholder="Quantity"
                                            readonly
                                        />
                                        @error('quantity')
                                        <span class="col-form-label-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Item</button>
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
