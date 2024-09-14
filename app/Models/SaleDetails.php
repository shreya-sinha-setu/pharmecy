<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id','product_id','quantity','rate','price'
    ];
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'id', 'product');
    }
}