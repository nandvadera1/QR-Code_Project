<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'code', 'redeemed_by_user_id', 'redeemed_at'
    ];
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'redeemed_by_user_id');
    }

    public function voucher_block()
    {
        return $this->belongsTo(VoucherBlock::class);
    }

}
