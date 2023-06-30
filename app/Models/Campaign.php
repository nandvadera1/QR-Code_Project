<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'is_enabled', 'name', 'start_at', 'end_at', 'amount'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function campaignProducts()
    {
        return $this->hasMany(CampaignProduct::class, 'campaign_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_products');
    }

    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }
}
