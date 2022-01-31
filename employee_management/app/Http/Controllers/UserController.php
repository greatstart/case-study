<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index', 'show', 'removed']]);
        $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //TODO: sorting
        $filter =  $request->input('q');
        $addresses = Address::pluck('name', 'id')->all();

        if($filter!=""){
            $data = User::whereRelation('address', 'id', $filter)
                ->orderBy('name', 'asc')
                ->paginate(5);
            $data->appends(['q' => $filter]);
        }
        else{
            $data = User::orderBy('name', 'asc')->paginate(5);
        }
        
        return view('users.index', compact('data', 'addresses'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function removed(Request $request)
    {
        $data = User::onlyTrashed()->orderBy('name')->paginate(5);

        return view('users.removed', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        $addresses = Address::pluck('name', 'id')->all();
        $selectedID = 0;

        return view('users.create', compact('roles', 'addresses'));
    }

    public function store(Request $request)
    {
        //TODO: Request, unique employee id
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'employee_id' => 'required|unique:users',
            'position' => 'required',
            'address_id' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Employee created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        return view('users.show', compact('user', 'roles'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id')->all();
        $userRoles = $user->roles->pluck('name', 'id')->all();
        $addresses = Address::pluck('name', 'id')->all();

        return view('users.edit', compact('user', 'roles', 'userRoles', 'addresses'));
    }

    public function update(Request $request, $id)
    {
        //TODO: Request, unique employee id
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'employee_id' => 'required|unique:users,employee_id, ' . $id,
            'position' => 'required',
            'address_id' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        // DB::table('model_has_roles')->where('model_id', $id)->delete();
        // $user->assignRole($request->input('roles'));

        $user->syncRoles($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Employee deleted successfully');
    }
}
