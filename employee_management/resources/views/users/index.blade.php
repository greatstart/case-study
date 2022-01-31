@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>
                <div class="card-body">
                    <form action="">
                    <div class="row pb-3">
                        <div class="col-md-6">
                            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Employee</a>
                            <a class="btn btn-primary" href="{{ route('users.removed') }}"> View Removed Employees</a>
                        </div>
                        
                        <div class="col-md-4">
                            <select id="q" class="form-control" name="q">
                                <option value="">Select Address</option>
                                <option value="">Show All</option>
                                @foreach ($addresses as $key => $value)
                                    <option value="{{ $key }}"> 
                                        {{ $value }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Filter Address"/>
                        </div>
                        
                    </div>
                </form>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Action</th>
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
                                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                {{-- TODO: create model --}}
                                <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this employee')">
                                        Delete
                                </button>
                                </form>
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