<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VouchersController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();

        return view('vouchers.index', [
            'campaigns' => $campaigns
        ]);
    }

    public function dataTable(Request $request)
    {
        $campaignID = $request->input('campaign_id');

        $vouchers = Voucher::with('campaign', 'user')
            ->when($campaignID, function ($query, $campaignID) {
                return $query->where('campaign_id', $campaignID);
            })
            ->select('id', 'campaign_id', 'code', 'redeemed_at', 'redeemed_by_user_id');

        return DataTables::of($vouchers)
            ->addColumn('campaign_id', function($row){
                return $row->campaign->name;
            })
            ->addColumn('redeemed_by_user_id', function($row){
                return $row->user->name ?? '';
            })
            ->make(true);
    }

    public function create()
    {
        $campaignId = Campaign::pluck('name', 'id');

        return view('vouchers.create', [
           'campaignId' => $campaignId
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|integer|min:1',
        ]);

        $campaignId = $validatedData['campaign_id'];
        $numberOfVouchers = $validatedData['amount'];

        DB::select("CALL generate_vouchers($campaignId, $numberOfVouchers)");

        return redirect('/admin/vouchers')->with('success', 'Vouchers created Successfully');
    }

}
