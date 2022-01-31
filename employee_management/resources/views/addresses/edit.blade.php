@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Address') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addresses.update', $address->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $address->name }}" autofocus required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="unit" class="col-md-4 col-form-label text-md-end">{{ __('Unit') }}</label>
    
                                <div class="col-md-6">
                                    <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ $address->unit }}" required>
    
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('Street') }}</label>
    
                                <div class="col-md-6">
                                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $address->street }}" required>
    
                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="postcode" class="col-md-4 col-form-label text-md-end">{{ __('Postcode') }}</label>
    
                                <div class="col-md-6">
                                    <input id="postcode" type="number" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ $address->postcode }}" required>
    
                                    @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
    
                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $address->country }}" required>
    
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection