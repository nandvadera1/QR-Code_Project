<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherBlock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
//use PDF;

class PDFController extends Controller
{
    public function pdfView(VoucherBlock $voucherBlock){
        $voucher_blockId = $voucherBlock->id;

        $query = Voucher::query()
            ->select(['id', 'voucher_block_id', 'campaign_id', 'code', 'redeemed_at', 'redeemed_by_user_id'])
            ->where('voucher_block_id', $voucher_blockId);

        $vouchers = $query->get();

        $voucherBlock->update([
            'downloaded_at' => now(),
            'download' => 1
        ]);


        return view('Pdf.pdf_view',[
            'vouchers' => $vouchers,
            'voucher_blockId' => $voucher_blockId
        ]);
    }

    public function pdfGenerate(VoucherBlock $voucherBlock){
        $voucher_blockId = $voucherBlock->id;

        $query = Voucher::query()
            ->select(['id', 'voucher_block_id', 'campaign_id', 'code', 'redeemed_at', 'redeemed_by_user_id'])
            ->where('voucher_block_id', $voucher_blockId);

        $vouchers = $query->get();
        $data = ['title' => "KK"];
        $pdf_view = PDF::loadView('Pdf.pdf_convert', compact('vouchers', 'voucher_blockId'));

        return $pdf_view->download('mypdf.pdf');
    }
}
