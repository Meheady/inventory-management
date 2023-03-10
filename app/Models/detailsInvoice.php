<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailsInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo(detailsInvoice::class,'invoice_id','id');
    }
}
