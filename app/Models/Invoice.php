<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\InvoiceDetail;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['customer', 'detail'];

    public function getTotalPriceAttribute()
    {
        return ($this->total);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detail()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function district()
    {
         return $this->belongsTo(District::class);
    }
}
