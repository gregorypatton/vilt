<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class APInvoice extends Model implements Auditable
{
    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = ['seller_id', 'supplier_id', 'amount', 'invoice_date', 'due_date', 'status'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(PaymentInvoice::class, 'ap_invoice_id');
    }
}
