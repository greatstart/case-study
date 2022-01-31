@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Removed Employees') }}</div>
                <div class="card-body">
                   
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Deleted Date</th>
                        </tr>
                        @if (count($data) == 0)
                            <td colspan="6">No records</td>
                        @endif
                        @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{!! isset($user->employee_id) ? $user->employee_id : '-' !!}</td>
                            <td>{!! isset($user->position) ? $user->position : '-' !!}</td>
                            <td>
                                {!! isset($user->address->name) ? $user->address->name : '-' !!}
                            </td>
                            <td>
                                {{ $user->deleted_at }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $data->links() !!}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection