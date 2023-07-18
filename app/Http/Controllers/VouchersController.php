<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Voucher;
use App\Models\VoucherBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class VouchersController extends Controller
{
    public function index()
    {
        $voucher_blocks = VoucherBlock::all();

        return view('vouchers.index', [
            'voucher_blocks' => $voucher_blocks
        ]);
    }

    public function dataTable(Request $request)
    {
        $voucher_blockId = $request->input('voucher_block_id');

        $vouchers = Voucher::with('voucher_block', 'user', 'campaign')
            ->when($voucher_blockId, function ($query, $voucher_blockId) {
                return $query->where('voucher_block_id', $voucher_blockId);
            })
            ->select('id', 'voucher_block_id', 'campaign_id', 'code', 'redeemed_at', 'redeemed_by_user_id');

        return DataTables::of($vouchers)
            ->addColumn('voucher_block_id', function($row){
                return $row->voucher_block->name;
            })
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
        $voucher_blockId = VoucherBlock::pluck('name', 'id');

        return view('vouchers.create', [
           'voucher_blocks' => $voucher_blockId
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
