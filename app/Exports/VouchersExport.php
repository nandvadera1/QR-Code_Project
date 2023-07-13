<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VouchersExport implements FromCollection, WithHeadings
{
    protected $vouchers;

    public function __construct($vouchers)
    {
        $this->vouchers = $vouchers;
    }

    public function collection()
    {
        return $this->vouchers;
    }

    public function headings(): array
    {
        return [
            'Voucher Block',
            'Campaign',
            'Voucher Code',
            'Redeemed At',
            'Redeemed By User ID',
        ];
    }

}
