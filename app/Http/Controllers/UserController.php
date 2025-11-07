<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index()
    {
        $heads = [
            'Type',
            'Name',
            'Phone Number',
            'Email',
            'Verified',
            ['label' => 'Points', 'no-export' => true, 'width' => 5],
            ['label' => 'Edit', 'no-export' => true, 'width' => 5],
            ['label' => 'Delete', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => url('admin/users/dataTable'),
            'columns' => [
                ['data' => 'type.type', 'name' => 'type.type'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'verified', 'name' => 'verified'],
                ['data' => 'Points', 'name' => 'Points'],
                ['data' => 'edit', 'name' => 'edit', 'orderable' => false, 'searchable' => false],
                ['data' => 'delete', 'name' => 'delete', 'orderable' => false, 'searchable' => false],
            ]
        ];
        return view('users.index', compact('heads', 'config'));
    }

    public function create()
    {
        $type = UserType::pluck('type', 'id');
        $newUser = true;
        return view('users.create', compact('type', 'newUser'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
            'user_type_id' => 'required',
            'verified' => 'required',
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        User::create($attributes);

        return redirect('/admin/users')->with('success', 'User Added Successfully!!');
    }

    public function edit(User $user)
    {
        $type = UserType::pluck('type', 'id');
        if (!empty($user->email_verified_at)) {
            $user->email_verified = 1;
        } else {
            $user->email_verified = 0;
        }
        return view('users.edit', [
            'type' => $type,
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'user_type_id' => 'required',
            'verified' => 'required',
            'email_verified' => 'nullable',
        ]);

        if(!empty($request->password)){
            $attributes['password'] = Hash::make($request->password);
        }

        if(!empty($attributes['email_verified'])){
            if(empty($user->email_verified_at)){
                $attributes['email_verified_at'] = now();
            }
        } else {
            $attributes['email_verified_at'] = null;
        }

        $user->update($attributes);

        return redirect('/admin/users')->with('success', 'User Updated Successfully!!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 'Success';
    }

    public function dataTable()
    {
        $users = User::with('type')->select('id','user_type_id', 'name', 'phone_number', 'email', 'verified')->get();

        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                $btn = '<a href="/admin/users/' . $user->id . '/edit" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('delete', function ($user) {
                $btn = '<button class="btn btn-danger btn-sm btn_delete " data-id="' . $user->id . '">Delete</button>';
                return $btn;
            })
            ->addColumn('Points', function ($user) {
                $points = Transaction::where('user_id', $user->id)->sum('points');
                return $points;
            })
            ->rawColumns(['edit','delete','Points'])
            ->make(true);
    }
}
