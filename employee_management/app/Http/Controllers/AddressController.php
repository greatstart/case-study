<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:address-list|address-create|address-edit|address-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:address-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:address-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:address-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Address::latest()->paginate(5);
        return view('addresses.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|unique:addresses',
            'unit' => 'required:max:255',
            'street' => 'required',
            'postcode' => 'required|digits:5',
            'country' => 'required',
        ]);

        Address::create($request->all());

        return redirect()->route('addresses.index')
            ->with('success', 'Address created successfully.');
    }

    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }
 
    public function update(Request $request, Address $address)
    {
        request()->validate([
            'name' => 'required|unique:addresses,name, ' . $address->id,
            'unit' => 'required:max:255',
            'street' => 'required',
            'postcode' => 'required|digits:5',
            'country' => 'required',
        ]);

        $address->update($request->all());

        return redirect()->route('addresses.index')
            ->with('success', 'Address updated successfully');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('addresses.index')
            ->with('success', 'Address deleted successfully');
    }
}
