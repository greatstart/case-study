@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Addresses') }}</div>
                <div class="card-body">
                    <div class="pb-3">
                        <a class="btn btn-success" href="{{ route('addresses.create') }}"> Create New Address</a>
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th width="280px">Action</th>
                        </tr>
                        @if (count($data) == 0)
                            <td colspan="4">No records</td>
                        @endif
                        @foreach ($data as $key => $address)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $address->name }}</td>
                            <td>{{ $address->fullAddress() }}</td>
                            
                            <td>
                                <a class="btn btn-info" href="{{ route('addresses.show',$address->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('addresses.edit',$address->id) }}">Edit</a>
                                {{-- TODO: create model --}}
                                <form action="{{ route('addresses.destroy',$address->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this address')">
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