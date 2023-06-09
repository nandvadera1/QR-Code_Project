<?php

namespace App\Http\Controllers;

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
            'ID',
            'Type',
            'Name',
            'Email',
            ['label' => 'Edit', 'no-export' => true, 'width' => 5],
            ['label' => 'Delete', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => url('admin/users/dataTable'),
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'type.type', 'name' => 'type.type'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'edit', 'name' => 'edit', 'orderable' => false, 'searchable' => false],
                ['data' => 'delete', 'name' => 'delete', 'orderable' => false, 'searchable' => false],
            ]
        ];
        return view('users.index', compact('heads', 'config'));
    }

    public function create()
    {
        $type = UserType::pluck('type', 'id');
        return view('users.create', compact('type'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255',
            'user_type_id' => 'required'
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        User::create($attributes);

        return redirect('/admin/users')->with('success', 'User Added Successfully!!');
    }

    public function edit(User $user)
    {
        $type = UserType::pluck('type', 'id');
        return view('users.edit', [
            'type' => $type,
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'required|min:7|max:255',
            'user_type_id' => 'required',
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        $user->update($attributes);

        return back()->with('success', 'User Updated Successfully!!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function dataTable()
    {
        $users = User::with('type')->select('id','user_type_id', 'name', 'email')->get();

        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                $btn = '<a href="/admin/users/' . $user->id . '/edit" class="btn btn-primary btn-sm">Edit</a>';
                return $btn;
            })
            ->addColumn('delete', function ($user) {
                $btn = '<button class="btn btn-danger btn-sm btn_delete " data-id="' . $user->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
    }
}
