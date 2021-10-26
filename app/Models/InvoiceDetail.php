<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\invoice;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSubTotalAttribute()
    {
        return number_format($this->qty * $this->price);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
