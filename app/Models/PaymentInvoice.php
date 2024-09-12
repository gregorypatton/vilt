<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInvoice extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['seller_id', 'payment_id', 'ap_invoice_id', 'ar_invoice_id', 'payment_amount'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function apInvoice()
    {
        return $this->belongsTo(ApInvoice::class, 'ap_invoice_id');
    }

    public function arInvoice()
    {
        return $this->belongsTo(ArInvoice::class, 'ar_invoice_id');
    }

}
