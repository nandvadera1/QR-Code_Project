<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'name', 'downloaded_at', 'download'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
