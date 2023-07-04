<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserTransactionController extends Controller
{
    public function index(Request $request)
    {
        $heads = [
            'Points',
            'Description',
            'Created At'
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => [
                'url' => url('user/transactions/dataTable'),
            ],
            'order' => [
                ['2', 'desc']
            ],
            'columns' => [
                ['data' => 'points', 'name' => 'points'],
                ['data' => 'description', 'name' => 'description'],
                ['data' => 'created_at_formatted', 'name' => 'created_at'],
            ]
        ];

        return view('User_transactions.index', compact('heads', 'config'));
    }

    public function dataTable(Request $request)
    {
        $userId= Auth::id();

        $transactions = Transaction::with('user')
            ->when($userId, function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->select('user_id', 'points', 'description', 'created_at');

        return DataTables::of($transactions)
            ->addColumn('created_at_formatted', function ($transactions) {
                return $transactions->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }

    public function create()
    {
        return view('User_transactions.create');
    }

    public function store(Request $request, Voucher $voucher, Campaign $campaign)
    {
        $attributes = $request->validate([
            'description' => 'required'
        ]);

        $code = $attributes['description'];

        $matched = $voucher->where('code', $code)->first();

        if($matched == null){
            return back()->with('fail', 'No QR Code Found.');
        }

        if($matched->redeemed_at === null){
            $campaign_id = $matched->campaign_id;

            $amount = $campaign->where('id', $campaign_id)->first();
            $points = $amount->amount;
            $userId = Auth::id();

            Transaction::create([
                'user_id' => $userId,
                'points' => $points,
                'description' => $attributes['description'],
            ]);

            $redeemed_at = $matched->redeemed_at = date('Y-m-d H:i:s', strtotime('now'));

            $matched->update(['redeemed_by_user_id' => $userId, 'redeemed_at' => $redeemed_at]);

            return back()->with('success', 'Qr Code scanned successfully');
        }

        return back()->with('fail', 'Qr Code already scanned');
    }


}
