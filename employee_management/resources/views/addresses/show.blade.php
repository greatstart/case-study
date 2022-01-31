@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Address') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Name:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $address->name }}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Unit:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $address->unit }}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Street:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $address->street }}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Postcode:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $address->postcode }}</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $address->country }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection