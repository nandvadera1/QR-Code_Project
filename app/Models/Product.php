<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
  
    protected $attributes = [
        'category_id' => null,
    ];
}
