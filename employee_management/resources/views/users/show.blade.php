@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Name:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $user->name }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{{ $user->email }}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Employee ID:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{!! isset($user->employee_id) ? $user->employee_id : '-' !!}</label>
                            </div>
                        </div>
                   
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Position:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{!! isset($user->position) ? $user->position : '-' !!}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Address:') }}</label>

                            <div class="col-md-6">
                                <label class="col-md-6 col-form-label text-md">{!! isset($user->address->name) ? $user->address->name : '-' !!}</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Role:') }}</label>

                            <div class="col-md-6">
                                @if(!empty($roles))
                                    @foreach($roles as $v)
                                        <label class="col-md-6 col-form-label text-md">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection