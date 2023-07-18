<?php

namespace App\Http\Controllers;

use App\Exports\VouchersExport;
use App\Models\Campaign;
use App\Models\Voucher;
use App\Models\VoucherBlock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class VoucherBlockController extends Controller
{
    public function index(Request $request)
    {
        $heads = [
            'Name',
            'Campaign',
            'Downloaded At',
            ['label' => 'Download', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'processing' => true,
            'serverSide' => true,
            'ajax' => [
                'url' => url('admin/voucher_blocks/dataTable'),
            ],
            'columns' => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'campaign_id', 'name' => 'campaign_id'],
                ['data' => 'downloaded_at', 'name' => 'downloaded_at'],
                ['data' => 'download', 'name' => 'download', 'orderable' => false, 'searchable' => false],
            ]
        ];

        $downloaded = VoucherBlock::pluck('id', 'download');

        return view('voucher_blocks.index', compact('heads', 'config', 'downloaded'));
    }

    public function dataTable(Request $request)
    {
        $voucher_blocks = VoucherBlock::with('campaign')
            ->select('id', 'name', 'campaign_id', 'downloaded_at', 'download')
            ->get();

        return DataTables::of($voucher_blocks)
            ->addColumn('campaign_id', function($row){
                return $row->campaign->name;
            })
            ->addColumn('download', function ($voucher_block) {
                $btn = '<button class="btn btn-warning btn-sm btn_download" data-id="'. $voucher_block->id .'"  data-download="'. $voucher_block->download .'">Download</button>';
//                $btn = '<a href="/admin/pdf/view/' . $voucher_block->id . '" class="btn btn-warning btn-sm">Display</a>';
                return $btn;
            })
            ->rawColumns(['download'])
            ->make(true);
    }

    public function create()
    {
        $campaignId = Campaign::pluck('name', 'id');

        return view('voucher_blocks.create', [
            'campaignId' => $campaignId
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'campaign_id' => 'required',
            'name' => 'required',
            'amount' => 'required'
        ]);

        $voucher_block = VoucherBlock::create([
            'name' => $attributes['name'],
            'campaign_id' => $attributes['campaign_id'],
        ]);

        $voucher_blockId = $voucher_block->id;

        $numberOfVouchers = $attributes['amount'];

        $campaignID = $attributes['campaign_id'];

        DB::select("CALL generate_vouchers($campaignID, $voucher_blockId, $numberOfVouchers)");

        $vouchers = Voucher::where('voucher_block_id', $voucher_blockId)->get();

        foreach ($vouchers as $voucher) {
            $imageName = 'qr_code_' . $voucher->id . '.png';

            $qrCode = QrCode::format('png')
                ->size(200)
                ->generate($voucher->code, public_path('images/' . $imageName));

        }

        return redirect('admin/voucher_blocks')->with('success', 'Voucher Block created successfully');
    }

}
