<?php
namespace App\Http\Controllers;

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
        $users = User::select('id', 'name', 'email')->get();

        return DataTables::of($users)
            ->addColumn('action', function ($row) {
                $btn = '<a href="/admin/users/' . $row->id . '/edit" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm btn_delete" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

//    public function index()
//    {
//        $data = User::select('id', 'name', 'email')->get();
//
//        return view('users', compact('data'));
//    }


    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255',
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        User::create($attributes);

        return redirect('/admin/users');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'required|min:7|max:255'
        ]);

        $attributes['password'] = Hash::make($attributes['password']);

        $user->update($attributes);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();

    }

}
