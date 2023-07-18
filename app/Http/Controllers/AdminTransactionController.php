<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $heads = [
            'User',
            'Points',
            'Description',
            'Created At'
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => [
                'url' => url('admin/transactions/dataTable'),
            ],
            'order' => [
                ['3', 'desc']
            ],
            'columns' => [
                ['data' => 'user_id', 'name' => 'user.name'],
                ['data' => 'points', 'name' => 'points'],
                ['data' => 'description', 'name' => 'description'],
                ['data' => 'created_at_formatted', 'name' => 'created_at'],
            ]
        ];

        $users = User::all();

        return view('Admin_transactions.index', compact('heads', 'config', 'users'));
    }

    public function dataTable(Request $request)
    {
        $userId = $request->input('user_id');

        $transactions = Transaction::with('user')
            ->when($userId, function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->select('user_id', 'points', 'description', 'created_at');

        return DataTables::of($transactions)
            ->addColumn('created_at_formatted', function ($transaction) {
                return $transaction->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('user_id', function($row){
                return $row->user->name;
            })
            ->make(true);
    }

    public function create()
    {
        $userId = User::pluck('name', 'id');

        return view('Admin_transactions.create', [
            'userId' => $userId
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => 'required',
            'points' => 'required',
            'description' => 'required'
        ]);

        $availablePoints = Transaction::where('user_id', $attributes['user_id'])
            ->sum('points');

        if($availablePoints < $attributes['points']){
            return back()->with('fail', "Sorry, the entered points exceed the user`s available balance.");
        }

        if($attributes['points'] % 10 != 0){
            return back()->with('fail', "Sorry, the points should be multiple of ten");
        }

        Transaction::create([
            'user_id' => $attributes['user_id'],
            'points' => -($attributes['points']),
            'description' => $attributes['description']
        ]);

        return redirect('/admin/transactions')->with('success', 'Transaction successful');

    }

    public function points($user)
    {
        $points = Transaction::where('user_id', $user)
            ->sum('points');

        return $points;
    }

}
